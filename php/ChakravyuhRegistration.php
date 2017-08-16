<?php
// get configuration files
require_once("./Configurations/DatabaseConfig.php");
require_once("./Configurations/config.php");
$response=array('code' => '1', 'data' => 'Unable To Connect To Database');

// get parameters
if(isset($_POST['name1']) && isset($_POST['email1']) && isset($_POST['contact1']) && isset($_POST['address1']) && isset($_POST['college1']) &&isset($_POST['teamName'])){
	$user=mysql_fix_string($_POST['name1']);
	$email=mysql_fix_string($_POST['email1']);
	$contact=mysql_fix_string($_POST['contact1']);
	$address=mysql_fix_string($_POST['address1']);
	$college=mysql_fix_string($_POST['college1']);
	$teamName=mysql_fix_string($_POST['teamName']);
//get Todays Date
	$dt=date("20y-m-d");
	// Connect to Database
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));
//First Register Team	
	$sql="INSERT INTO `participatingteams` (`TeamName`,`Event`,`RegistrationDate`) VALUES ( '$teamName' ,'ChakraVyuh','$dt' );";	
	// query database
	$result=mysqli_query($con,$sql);
	if(!$result){	
		// in case of failure
		$response=array('code' => '5', 'data' => mysqli_error($con));
		exit(json_encode($response));
	}
	else{
		$msg="Team Registration Successful For Chakravyuh";
		sendCard($email,$msg);
	}
//now Register Members	
//now register primary member
	$sql="INSERT INTO `participants` (`TeamName`,`Name`,`Email`,`Contact`,`Address`,`College`) VALUES ( '$teamName' ,'$user','$email','$contact','$address','$college');";	
	$result=mysqli_query($con,$sql);
	if(!$result){	
		// in case of failure
		$response=array('code' => '5', 'data' => mysqli_error($con));
		exit(json_encode($response));
	}
	
//now register for remainning Members
//Member 2 Registration
	if(isset($_POST['name2']) && isset($_POST['email2']) && isset($_POST['contact2']) && isset($_POST['address2']) && isset($_POST['college2'])){
		$user=mysql_fix_string($_POST['name2']);
		$email=mysql_fix_string($_POST['email2']);
		$contact=mysql_fix_string($_POST['contact2']);
		$address=mysql_fix_string($_POST['address2']);
		$college=mysql_fix_string($_POST['college2']);
		$sql="INSERT INTO `participants` (`TeamName`,`Name`,`Email`,`Contact`,`Address`,`College`) VALUES ( '$teamName' ,'$user','$email','$contact','$address','$college');";	
		$result=mysqli_query($con,$sql);
		if(!$result){	
			// in case of failure
			$response=array('code' => '5', 'data' => 'Team Registered But Registration Failed For Member'.$user.' Please contact Team SRC'.mysqli_error($con));
			exit(json_encode($response));
		}
	}
//member 3 Registration
	if(isset($_POST['name3']) && isset($_POST['email3']) && isset($_POST['contact3']) && isset($_POST['address3']) && isset($_POST['college3'])){
		$user=mysql_fix_string($_POST['name3']);
		$email=mysql_fix_string($_POST['email3']);
		$contact=mysql_fix_string($_POST['contact3']);
		$address=mysql_fix_string($_POST['address3']);
		$college=mysql_fix_string($_POST['college3']);
		$sql="INSERT INTO `participants` (`TeamName`,`Name`,`Email`,`Contact`,`Address`,`College`) VALUES ( '$teamName' ,'$user','$email','$contact','$address','$college');";	
		$result=mysqli_query($con,$sql);
		if(!$result){	
			// in case of failure
			$response=array('code' => '5', 'data' => 'Team Registered But Registration Failed For Member'.$user.' Please contact Team SRC'.mysqli_error($con));
			exit(json_encode($response));
		}
	}
	
	mysqli_close($con);
//final Reply to Client
		$response=array('code' => '6', 'data' =>'Team Registration Successful');
		exit(json_encode($response));
}
else{
$response=array('code' => '0', 'data' => 'Not Enough Parameters in Call to scripts');
exit(json_encode($response));
}
// function for cleaning the input for preventing sql injection
function mysql_fix_string($string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return mysql_real_escape_string($string);
}
// function for sending Id card to email 
function sendCard($email,$ms){
	$ch=curl_init();
	$message=$ms;
	curl_setopt($ch,CURLOPT_URL,MailConfig::URL);
	$fields=array(
		'name' => 'SGSITS ROBOTICS CLUB',
		'from' => MailConfig::MAIL,
		'email' => $email,
		'subject' => 'SRC ID Card',
		'message'	=> $message
	);
	$fields_string="";
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');
	curl_setopt($ch,CURLOPT_POST,true);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS,$fields_string);
    $result = curl_exec( $ch );

    //------------------------------
    // Error? Display it!
    //------------------------------

    if ( curl_errno( $ch ) )
    {
		//set code to error code along with its data
		//$response=array('code' => '3', 'data' =>'Registered but Card Not Sent '. curl_error($ch));
		//curl_close($ch);
		//die(json_encode($response))	;
    }

    //------------------------------
    // Close curl handle
    //------------------------------

    curl_close( $ch );

    //------------------------------
    // Debug GCM response
    //------------------------------
	return $result;
}
?>