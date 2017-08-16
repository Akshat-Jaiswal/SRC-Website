<?php
// this is the php file for storing the uploaded tracksheet
require_once("../Configurations/DatabaseConfig.php");
$response=array('code' => '1', 'data' => 'Unable To Connect To Database');
session_start();
//verify valid user

if(!isset($_SESSION['username'])){
	// if invalid then return
	$response=array('code' => '3', 'data' => 'Authentication required');
	die(json_encode($response));
}

// get parameters
if(isset($_POST['table']) && isset($_POST['title']) ){
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));
	$title=mysqli_real_escape_string($con,$_POST['title']);
	$table=mysqli_real_escape_string($con,$_POST['table']);
	if(!checkTables($table)){
		$response=array('code' => '3', 'data' => "You are not allowed to access those tables");
		exit(json_encode($response));
	}
	$sql="Delete from `$table` where Title='$title'";
	$result=mysqli_query($con,$sql);
// in case of success 
	if($result){
		$response=array('code' => '6', 'data' => "Affected Rows:".mysqli_affected_rows($con));
		exit(json_encode($response));
	}
	else{
		// in case of failure
		$response=array('code' => '5', 'data' => mysqli_error($con));
		exit(json_encode($response));
	}
	mysqli_close($con);
}
else{
	$response=array('code' => '0', 'data' => 'Not Enough Parameters in Call to scripts');
	exit(json_encode($response));
}
// function for checking tables
	function checkTables($table){
		$allowed=array('posts','aayaam','gallery','workshops','projects','reports');
		foreach($allowed as $item){
			if($item==$table)
				return true;
		}
		return false;
	}

?>
