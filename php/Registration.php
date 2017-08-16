<?php
// get configuration files
require_once("./Configurations/DatabaseConfig.php");
require_once("./Configurations/config.php");
$response=array('code' => '1', 'data' => 'Unable To Connect To Database');

// get parameters
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['branch']) && isset($_POST['college'])){
	// Connect to Database
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));
	$user=mysql_fix_string($con,$_POST['name']);
	$email=mysql_fix_string($con,$_POST['email']);
	$contact=mysql_fix_string($con,$_POST['contact']);
	$branch=mysql_fix_string($con,$_POST['branch']);
	$college=mysql_fix_string($con,$_POST['college']);

	$sql="INSERT INTO `members` (`name`,`email`,`contact`,`branch`,`college`) VALUES ( '$user' ,'$email','$contact','$branch','$college' );";	
	// query database
	$result=mysqli_query($con,$sql);
	if($result){
		$id=mysqli_insert_id($con);
		$r2=sendCard($email,$id);
		$response=array('code' => '6', 'data' => 'Registered '.$r2);
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
// function for cleaning the input for preventing sql injection
function mysql_fix_string($link,$string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return mysqli_real_escape_string($link,$string);
}
// function for sending Id card to email 
function sendCard($email,$id){
	$ch=curl_init();
	$message="Your ID:".$id."<br />";
	$img=file_get_contents("card.txt");
	$message=$message."<img src='".$img."'alt='ID CARD'";
	$message=$message."<br />Follow The Link to download your ID Card <a href='".MailConfig::IDCARD."'>Download";
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
		$response=array('code' => '3', 'data' =>'Registered but Card Not Sent '. curl_error($ch));
		curl_close($ch);
		die(json_encode($response))	;
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