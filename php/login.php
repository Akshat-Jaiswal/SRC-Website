	<?php
	// get configuration files
	require_once("./Configurations/DatabaseConfig.php");
	$response=array('code' => '1', 'data' => 'Unable To Connect To Database');
	
	// get parameters
	if(isset($_POST['username'])&& isset($_POST['password'])){
		// Connect to Database
		$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
				die(json_encode($response));
		$user=mysql_fix_string($con,$_POST['username']);
		$pass=mysql_fix_string($con,$_POST['password']);
	
		$sql = "SELECT * FROM `committee members` where Email ='$user' and password ='$pass' and admin=1 LIMIT 0, 30 ";
		// query database
		$result=mysqli_query($con,$sql);
		// count no. of rows in resultset
		$count=mysqli_num_rows($result);
		if($count){
			// in case of successful login start a new session
			session_start();
			$_SESSION['username']=$user;
			// send successful response
			$response=array('code' => '6', 'data' => 'Login Successful');
			exit(json_encode($response));
		}
		else{
			// in case of failed login
			$response=array('code' => '5', 'data' => 'Login Failed');
			exit(json_encode($response));
		}
	}
	else{
	$response=array('code' => '0', 'data' => 'Not Enough Parameters in Call to scripts');
	exit(json_encode($response));
	}
	
	// function for cleaning the input for preventing sql injection
	function mysql_fix_string($link,$string)
	{
	if (get_magic_quotes_gpc()) $string = stripslashes($string);
	return mysqli_real_escape_string($link,$string);
	}
	?>