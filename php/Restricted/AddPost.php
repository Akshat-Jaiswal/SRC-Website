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
if(isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['image'])){
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));
	$title=mysqli_real_escape_string($con,$_POST['title']);
	$desc=mysqli_real_escape_string($con,$_POST['description']);
	$fname=$_FILES['image']['name'];
	$dt=date("Y-m-d H:i:s",strtotime("+330 minutes"));
	//$user="akshatjaiswal1995@gmail.com";
	$user=$_SESSION['username'];
	//get filename
	$fname=$_FILES['image']['name'];
	// get the directory for storing file
	//$root=DirConfig::ROOT;
	$directory="../../".DirConfig::POSTS;
	//get file extension	
	$ext=pathinfo($fname,PATHINFO_EXTENSION);
	if($_FILES['image']['error']>0){
		$response=array('code' => '5', 'data' => 'ERROR while uploading file File not Found');
		die(json_encode($response));
	}
// if folder corresponding to pid does not exist create new using mkdir
// note upload folder is in same folder as this file is in	
	if(!file_exists($directory))
			mkdir($directory,0777,true);
// store file in appropiate folder
	$URL=$directory.$fname;
// and change its name to [date]_[time] format using date method
	move_uploaded_file($_FILES['image']['tmp_name'],$URL);
// after successful upload make its entry in database
// connect to database
	$URL=DirConfig::ROOT.DirConfig::POSTS.$fname;	
// query for inserting into posts table
	$sql = "INSERT INTO `posts`(`Id`, `Title`, `PDate`, `Description`, `PostedBy`, `ImageURL`) VALUES (NULL,'$title','$dt','$desc','$user','$URL')";
	$result=mysqli_query($con,$sql);
// in case of success 
	if($result){
		$response=array('code' => '6', 'data' => 'Posted');
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
