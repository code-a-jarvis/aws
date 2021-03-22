<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Config;
use App\Progresscount;
use App\Score;

class PagesController extends Controller
{
    //
   public $playerwisescores;
   public $pidtoname;
    public function progress()
    {
        $progress=Progresscount::where('id',1)->get();
        $progress=$progress[0];
        $percentage=floor(($progress->presentCount/$progress->targetCount)*100);
        $id=$progress->id;
        $data=array(
            'percentage'=>$percentage,
            'id'=>$id
        );
        // return compact([$percentage,$id]);
         return view('progress')->with($data);
    }

    public function addmore(){
       
      return view('addmore');
    }
    public function checkapi(Request $request){
       return "{
        'associatedApplications': [
          {
            'applicationId': '597cb89b-623f-4be8-a9c8-4e8c39d7c7c4'
          }
        ]
      }";
      $id=$request->input('payload');
      if($id==null){
        $value=DB::table('checkapi')->get();
        var_dump($value);
      }
      else{
        DB::insert('UPDATE `checkapi` SET `payload`=?,`ide`=?',[$id,1]);
      }
    }


    public function tasks(){
       
      return view('tasklist');
      }

      public function enterid(){
        return view('enterid');
      }

      public function choosematch(){
        $url="https://cricapi.com/api/matches?apikey=62RBUPRBexUXXSq4qPsTM4XXpft1";
        $txt=file_get_contents($url);
        $myfile=fopen('matches.txt','w');
        fwrite($myfile,$txt);
        fclose($myfile);
        $result=file_get_contents("matches.txt");
        $teams=array();
        array_push($teams,"Kings XI Punjab");
        array_push($teams,"Royal Challengers Bangalore");
        array_push($teams,"Chennai Super Kings");
        array_push($teams,"Delhi Capitals");
        array_push($teams,"Kolkata Knight Riders");
        array_push($teams,"Sunrisers Hyderabad");
        array_push($teams,"Rajasthan Royals");
        array_push($teams,"Mumbai Indians");
        $result=json_decode($result,true);
       // var_dump($result);
        $matches=$result['matches'] ;
        $tosend=array();
        foreach ($matches as $match){
          if(in_array($match['team-1'], $teams)&&$match['matchStarted']!=false){
            array_push($tosend,$match);
          }
        }
       $data=array(
        "matches"=>array_slice($tosend,0,4),
       );
        return view('selectmatch')->with($data);

      }
    
      public function test(Request $request){
        $id=$request->input('id');
        //return $id;
        $url="https://cricapi.com/api/fantasySummary?apikey=62RBUPRBexUXXSq4qPsTM4XXpft1&unique_id=";
        $url.=$id;
        $txt=file_get_contents($url);
        $myfile=fopen('match.txt','w');
        fwrite($myfile,$txt);
        fclose($myfile);
        return redirect('/cricket');
      } 

      public function addToBirthday(Request $request){
        $name=$request->input('name');
        $date=$request->input('bdate');
        $post = new Birthday;
        $post->name = $name;
        $post->bdate = $date;
        $post->save();
      //  return redirect('/posts')->with('success', 'Post Created');
        return redirect('/home')->with('success', 'Birthday Created');
      } 

    public function cricket(){
      $txt="ty";
      $result=file_get_contents("match.txt");
      $hello="pol";
      $match_data=json_decode($result,true);
      $match_data=$match_data['data'];
      $team_data=$match_data["team"];
      $team1=$team_data[0]["players"];
      $team2=$team_data[1]["players"];

      $team1_players=array('Select the players');
      $team2_players=array('select the players');
      foreach ($team1 as $player){
        array_push($team1_players,$player["name"]);
        $this->pidtoname[$player['pid']]=$player['name'];
        $this->playerwisescores[$player['pid']]=0;
      }

      foreach ($team2 as $player){
        array_push($team2_players,$player["name"]);
        $this->pidtoname[$player['pid']]=$player['name'];
        $this->playerwisescores[$player['pid']]=0;

      }
      $toshow=$team1_players;
      $data=array(
        'team1'=>$team1,
        'team2'=>$team2,
    );
    //return $team1[0];
   // $GLOBALS['ps']=$this->playerwisescores;
     return view('cricketselect')->with($data);
    }
    
    public function getscores(Request $request){

        $teamid1=$_POST['id1'];
        $teamid2=$_POST['id2'];
       // $this->playerwisescores=$GLOBALS['ps'];
        $result=file_get_contents("match.txt");
      $hello="pol";
      $match_data=json_decode($result,true);
      $match_data=$match_data['data'];
      $team_data=$match_data["team"];
      $team1=$team_data[0]["players"];
      $team2=$team_data[1]["players"];

      $team1_players=array('Select the players');
      $team2_players=array('select the players');
      foreach ($team1 as $player){
        array_push($team1_players,$player["name"]);
        $this->pidtoname[$player['pid']]=$player['name'];
        $this->playerwisescores[$player['pid']]=0;
      }

      foreach ($team2 as $player){
        array_push($team2_players,$player["name"]);
        $this->pidtoname[$player['pid']]=$player['name'];
        $this->playerwisescores[$player['pid']]=0;

      }
        $points=$this->getiscores($teamid1,$teamid2);
       $t1points=array();
       $t2points=array();
        foreach ($teamid1 as $player){
          $t2point['name']=$this->pidtoname[$player];
          $t2point['score']=$this->playerwisescores[$player];
          array_push($t1points,$t2point);
        }
        foreach ($teamid2 as $player){
          $t2point['name']=$this->pidtoname[$player];
          $t2point['score']=$this->playerwisescores[$player];
          array_push($t2points,$t2point);
        }
        $data=array(
          "scoreA"=>$points['scoreA'],
          "scoreB"=>$points['scoreB'],
          "t1"=>$t1points,
          "t2"=>$t2points,
        );
        return view('scoreboard')->with($data);
    }
    
    public function getiscores($team1,$team2){
      $p1=$this->cricketcompute($team1);
      $p2=$this->cricketcompute($team2);
     // $p1="TeamA score is".$p1."TeamB score is".$p2;
     $final="Team A score is";
     $final.=$p1;
     $final.=" Team B score is ";
     $final.=$p2;
     $data=array(
       "scoreA"=>$p1,
       "scoreB"=>$p2,
     );
    return $data;
    }
    public function cricketcompute($team){
      //$team=$request->input('id');
      $result=file_get_contents("match.txt");
      $data=json_decode($result,true);
      $batting=$data['data']['batting'];
      $bowling=$data['data']['bowling'];
      $fielding=$data['data']['fielding'];

      $points=0;
      $battingscores=array();
      foreach ($batting[0]["scores"] as $it){
        $battingscores[$it['pid']]=$it;
      }
      foreach ($batting[1]["scores"] as $it){
        $battingscores[$it['pid']]=$it;
      }
    
      $bowlingscores=array();
      foreach ($bowling[0]["scores"] as $it){
        $bowlingscores[$it['pid']]=$it;
      }
      foreach ($bowling[1]["scores"] as $it){
        $bowlingscores[$it['pid']]=$it;
      }

      $fieldingscores=array();
      foreach ($fielding[0]["scores"] as $it){
        $fieldingscores[$it['pid']]=$it;
      }
      foreach ($fielding[1]["scores"] as $it){
        $fieldingscores[$it['pid']]=$it;
      }
      
      $points+=$this->computefieldingpoints($fieldingscores,$team);
      //var_dump($points);
      $points+=$this->computebattingpoints($battingscores,$team);
      //var_dump($points);
      $points+=$this->computebowlingpoints($bowlingscores,$team);
      //var_dump($points);
      return $points;
    }

    public function computebattingpoints($scores,$players){
      $points=0;
      foreach ($players as $player){
       
        if(array_key_exists($player,$scores)){
          $thisplayerpoints=$points;
        $score=$scores[$player];
        if($score['R']!=0){
        $points+=$score['R']*0.5;
        if($score['R']>=50 && $score['R']<=99){$points+=4;}
        else if($score['R']>=100){$points+=8;}
        }
        else if(array_key_exists('dismissal',$score)) {$points+=-2;}
        $points+=$score['4s']*0.5;
        $points+=$score['6s']*1;
      $sr=$score['SR'];
      if($score['B']>=10){
        if($sr<50){
          $points+=-3;
        }
        elseif($sr<60){
          $points+=-2;
        }

        if($sr<70&&$sr>=60){
          $points+=-1;
        }
      }
    $thisplayerpoints=$points-$thisplayerpoints;
    $this->playerwisescores[$player]+=$thisplayerpoints;

    }
      }
     
      return $points;
    }

    public function computebowlingpoints($scores,$team){
      $points=0;
      foreach ($team as $player){
        
        if(array_key_exists($player,$scores)){
          $thisplayerpoints=$points;
        $score=$scores[$player];
        $points+=$score['W']*10;
        $points+=$score['M']*4;
        if($score['W']>=5){
          $points+=8;
        }
        elseif($score['W']>=4){
          $points+=4;
        }
      $econ=$score['Econ'];
      if($score['O']>=2){
      switch($econ){
        case ($econ<4):
        $points+=3;
        break;
        case ($econ<5):
        $points+=2;
        break;
        case ($econ<6):
        $points+=1;
        break;
        case ($econ<9):
        $points+=0;
        break;
        case ($econ<10):
        $points+=-1;
        break;
        case ($econ<11):
        $points+=-2;
        break;
        case ($econ>11):
        $points+=-3;
        break;
        default:
        $points+=0;
      }
      }
     $thisplayerpoints=$points-$thisplayerpoints;
     $this->playerwisescores[$player]+=$thisplayerpoints; 
    }
      }
      return $points;
  }

    public function computefieldingpoints($scores,$players){
      $points=0;

      foreach ($players as $player){
        if(array_key_exists($player,$scores)){
          $thisplayerpoints=$points;
        $score=$scores[$player];
        $points+=$score['catch']*4;
        $points+=$score['stumped']*6;
        $points+=$score['runout']*4;
        $thisplayerpoints=$points-$thisplayerpoints;
        $this->playerwisescores[$player]+=$thisplayerpoints;
        }
      }

      return $points;
    }
}
