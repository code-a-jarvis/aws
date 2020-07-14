<!DOCTYPE html>
<html>
<head>
	<title>Add more</title>
	<link rel="manifest"  href="manifest.webmanifest.json">
		<style type="text/css">

		body{
			background-color: #86867f;
		}

	#formi{
		height:350px;
		width: 350px;
		position: relative;
		left:460px; 
		background-color: #f75746;
		margin-top: 150px;
	}
	#name{
		margin-top: 100px;
		margin-left: 90px;

	}

	#bdate{
		margin-top: -29px;
		margin-left: 90px;
	}
	input{
		height: 30px;
		margin-top: 80px;
		width: 200px;
	}
	#submit{
		margin-top: -28px;
		margin-left: 150px;
	}


		</style>
	</head>
<body>
	<div id='formi'>
<form  action="add.php" method="POST">
	<div id='name'>
	<input type="text" name="name" autofocus="autofocus">
</div>
	<div id='bdate'>
		<input type="date" name="bdate">
	</div>
	<div id='submit'>
		<input type="submit" style="width:60px" name="submit">
	</div>
	</div>
</form>
</body>
</html>