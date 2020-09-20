<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Progresscount;

class PagesController extends Controller
{
    //

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

    public function tasks(){
       
      return view('tasklist');
      }

      public function enterid(){
        return view('enterid');
      }
    
      public function test(Request $request){
        $id=$request->input('id');
        $url="https://cricapi.com/api/fantasySummary?apikey=S5wcd8HOo8SHjVfwuWIkFXoh2Cw1&unique_id=";
        $url.=$id;
        $txt=file_get_contents($url);
        $myfile=fopen('match.txt','w');
        fwrite($myfile,$txt);
        fclose($myfile);
        return redirect('/cricket');
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
      }

      foreach ($team2 as $player){
        array_push($team2_players,$player["name"]);
      }
      $toshow=$team1_players;
      $data=array(
        'team1'=>$team1,
        'team2'=>$team2,
    );
    //return $team1[0];
      return view('cricketselect')->with($data);
      //return $toshow;
    }
    
    public function getscores(Request $request){
        $team1=$request->input('id1');
        $team2=$request->input('id2[]');
        return $team1.$team2;
    }
    
    public function getiscores(Request $request){
      $team1=$request->input('id1');
      $team2=$request->input('id2');
      $p1=$this->cricketcompute($team1);
      $p2=$this->cricketcompute($team2);
      $p1="TeamA score is".$p1."TeamB score is".$p2;
      return $p1;
    }
    public function cricketcompute($team){
      //$team=$request->input('id');
      $result=file_get_contents("C:\Users\NAVANE\Desktop\match-result.txt");
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
      $points+=$this->computebattingpoints($battingscores,$team);
      $points+=$this->computebowlingpoints($bowlingscores,$team);
      return $points;
    }

    public function computebattingpoints($scores,$players){
      $points=0;
      foreach ($players as $player){
        if(array_key_exists($player,$scores)){
        $score=$scores[$player];
        if($score['R']!=0){
        $points+=$score['R']*0.5;
        if($points>=50 && $points<=99){$points+=4;}
        else if($points>=100){$points+=8;}
        }
        else {$points+=-2;}
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
    }
      }
     
      return $points;
    }

    public function computebowlingpoints($scores,$team){
      $points=0;
      foreach ($team as $player){
        if(array_key_exists($player,$scores)){
        $score=$scores[$player];
        $points+=$score['W']*15;
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
    }
      }
      return $points;
  }

    public function computefieldingpoints($scores,$players){
      $points=0;

      foreach ($players as $player){
        if(array_key_exists($player,$scores)){
        $score=$scores[$player];
        $points+=$score['catch']*4;
        $points+=$score['stumped']*6;
        $points+=$score['runout']*4;
        }
      }

      return $points;
    }
}
