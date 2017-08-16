<?php
// this is the php file for storing the uploaded tracksheet
require_once("../Configurations/DatabaseConfig.php");
require_once("../Configurations/DirectoryConfig.php");
$response=array('code' => '1', 'data' => 'Unable To Connect To Database');
session_start();
//verify valid user
if(!isset($_SESSION['username'])){
	// if invalid then return
	$response=array('code' => '3', 'data' => 'Authentication required');
	die(json_encode($response));
}
// get parameters
if(isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['report']) && isset($_FILES['imageURL'])  ){
	// connect to database
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
		die(json_encode($response));

	$title=mysqli_real_escape_string($con,$_POST['title']);
	$description=mysqli_real_escape_string($con,$_POST['description']);
	$fname=$_FILES['report']['name'];
	$iname=$_FILES['imageURL']['name'];
	$dt=date("20y-m-d");
	//$user='akshatjaiswal1995@gmail.com';
	$user=$_SESSION['username'];
	//get filename
	$fname=$_FILES['report']['name'];
	// get the directory for storing file
	//$root=DirConfig::ROOT;
	$directory="../../".DirConfig::PROJECTS;
	//get file extension	
	$ext=pathinfo($fname,PATHINFO_EXTENSION);
	if($_FILES['report']['error']>0){
		$response=array('code' => '5', 'data' => 'report file ERROR while uploading file File not Found');
		die(json_encode($response));
	}
// if folder corresponding to pid does not exist create new using mkdir
// note upload folder is in same folder as this file is in	
	if(!file_exists($directory))
			mkdir($directory,0777,true);
// store file in appropiate folder
	$URL=$directory.$fname;
// and change its name to [date]_[time] format using date method
	move_uploaded_file($_FILES['report']['tmp_name'],$URL);

// after successful upload make its entry in database
// change its mode to read only
// connect to database
	$ReportURL=DirConfig::ROOT.DirConfig::PROJECTS.$fname;	
	chmod($directory.$fname,0644);
	if($_FILES['imageURL']['error']>0){
		$response=array('code' => '5', 'data' => 'image file ERROR while uploading file File not Found');
		die(json_encode($response));
	}
// if folder corresponding to pid does not exist create new using mkdir
// note upload folder is in same folder as this file is in	
	if(!file_exists($directory))
			mkdir($directory,0777,true);
// store file in appropiate folder
	$imageURL=$directory.$iname;
// and change its name to [date]_[time] format using date method
	move_uploaded_file($_FILES['imageURL']['tmp_name'],$imageURL);
// after successful upload make its entry in database
	$imageURL=DirConfig::ROOT.DirConfig::PROJECTS.$iname;	
// query for inserting into posts table
	$sql = "INSERT INTO `projects`(`Title`, `Description`,`imageURL`, `Report`) VALUES ('$title','$description','$imageURL','$ReportURL')";
	$result=mysqli_query($con,$sql);
// in case of success 
	if($result){
		$response=array('code' => '6', 'data' => 'Report uploaded');
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
?>
