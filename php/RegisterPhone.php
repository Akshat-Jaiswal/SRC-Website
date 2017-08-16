<?php
// get configuration files
require_once("./Configurations/DatabaseConfig.php");
$response=array('code' => '1', 'data' => 'Unable To Connect To Database');

// get parameters
if(isset($_POST['regId']) && isset($_POST['email']) && isset($_POST['name'])){
	// Connect to Database
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));	
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$user=mysqli_real_escape_string($con,$_POST['email']);
	$gcmId=mysqli_real_escape_string($con,$_POST['regId']);
	// check for valid user
	/*if(config::KEY!==$_POST['key']){
		// if key does not match do not add this device
		$response=array('code' => '3', 'data' => 'Authentication Failed');
		die(json_encode($response));
	}
	*/
	// check whether it is a member or a guest
	// modify query according to it
	$sql="INSERT INTO `gcm` (`GCMid`,`Name`,`Id`) VALUES ( '$gcmId','$name','$user');";	
	// query database
	$result=mysqli_query($con,$sql);
	if($result){
		$response=array('code' => '6', 'data' => 'Phone Registered');
		exit(json_encode($response));
	}
	else{
		// in case of failed login
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