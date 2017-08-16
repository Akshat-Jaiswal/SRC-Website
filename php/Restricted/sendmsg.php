
<?php
session_start();
// get configuration files
require_once("../Configurations/GCMConfig.php");
require_once("../Configurations/DatabaseConfig.php");
global $response;
global $user;
global $recepients;
// default response
$response=array('code' => 5 ,'data' => 'Could not  connect to database ');
// check for valid user
if(!isset($_SESSION['username'])){
// set response code and return
	$response=array('code' => 3 ,'data' => 'Authentication Required ');
	die(json_encode($response));
}
$user=$_SESSION['username'];
//connect to database
	$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));

// get msg and pids first
if(isset($_POST['message'])){
	$msg=mysqli_real_escape_string($con,$_POST['message']);
	
$sql;
// if project ids are provided then modify query
	if(isset($_POST['Pid'])){
		$pids=mysqli_real_escape_string($con,$_POST['Pid']);
// convert array into string using ',' as seperator		
		$pids=implode(",",$pids);	
		$recepients="Project Id- ". $pids;	
		$sql = "SELECT gcmId FROM `gcm` where Id in ( SELECT Mid FROM `projectteams` WHERE pid in ( $pids ) )";
	}
// if direct IDS of members  i.e. emails are provided then use this query
	else if(isset($_POST['Mids'])){
		$mids=mysqli_real_escape_string($con,$_POST['Mids']);
		$recepients="Member Ids- ". $mids;
		$sql="SELECT gcmId from `gcm` where Id in ( $mids )";
	}
// otherwise send to all
	else {
		$sql="SELECT gcmId from `gcm` ";
		$recepients="Everyone";
	}
// query the database 
	$result=mysqli_query($con,$sql);
// in case of error
	if(!$result){
		$response=array('code' => 5 ,'data' => mysqli_error($con));	
		die(json_encode($response));
	}
// array for storing GCM ids of these users 	
	$ids = array();	
// push each id from table to array
	$count=mysqli_num_rows($result);
	for($i=0;$i<$count;++$i){
		$row=mysqli_fetch_row($result);
		array_push($ids,$row[0]);
	}
//------------------------------
// Payload data you want to send 
// to Android device (will be
// accessible via intent extras)
//------------------------------

$data = array( 'price' => '$msg' );

//------------------------------
// The recipient registration IDs
// that will receive the push
// (Should be stored in your DB)
// 
// Read about it here:
// http://developer.android.com/google/gcm/
//------------------------------
// add
//------------------------------
// Call our custom GCM function
//------------------------------
	
	if($result=sendGoogleCloudMessage(  $data, $ids)){
	//-- add this notification to notifications table
	// toget correct time
		$tm=date("h:i:s",strtotime("+330 minute"));
	// to get correct date
		$dt=date("20y-m-d");
	// query to insert msg date,time,pid to notifications table
		$sql="INSERT INTO `notifications`(`Sentby`, `NDate`, `NTime`, `message`,`recepients`) VALUES ('$user','$dt','$tm','$msg','$recepients')";
		$result2=mysqli_query($con,$sql);
	// incase of mysql error
		if(!$result2){
			$response=array('code' => '5', 'data' => mysqli_error($con));
			exit(json_encode($response));
		}
	//-- when msg successfully sent send response 
		$response=array('code' => '6', 'data' => $result);
		exit (json_encode($response));

	}
	mysqli_close($con);	
}
else{
	// set response code and echo result
	$response=array('code' => '0', 'data' => 'Not Enough Parameters in Call to scripts');
	exit(json_encode($response));

}

//------------------------------
// Define custom GCM function
//------------------------------

function sendGoogleCloudMessage( $data, $ids)
{
    //------------------------------
    // Replace with real GCM API 
    // key from Google APIs Console
    // 
    // https://code.google.com/apis/console/
    //------------------------------
	$apiKey=GCMConfig::apiKey;
	
    //------------------------------
    // Define URL to GCM endpoint
    //------------------------------

    $url = GCMConfig::URL;

    //------------------------------
    // Set GCM post variables
    // (Device IDs and push payload)
    //------------------------------

    $post = array(
                    'registration_ids'  => $ids,
                    'data'              => $data,
                    );

    //------------------------------
    // Set CURL request headers
    // (Authentication and type)
    //------------------------------

    $headers = array( 
                        'Authorization: key=' . $apiKey,
                        'Content-Type: application/json'
                    );

    //------------------------------
    // Initialize curl handle
    //------------------------------

    $ch = curl_init();

    //------------------------------
    // Set URL to GCM endpoint
    //------------------------------

    curl_setopt( $ch, CURLOPT_URL, $url );

    //------------------------------
    // Set request method to POST
    //------------------------------

    curl_setopt( $ch, CURLOPT_POST, true );

    //------------------------------
    // Set our custom headers
    //------------------------------

    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

    //------------------------------
    // Get the response back as 
    // string instead of printing it
    //------------------------------

    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    //------------------------------
    // Set post data as JSON
    //------------------------------
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );

    //------------------------------
    // Actually send the push!
    //------------------------------

    $result = curl_exec( $ch );

    //------------------------------
    // Error? Display it!
    //------------------------------

    if ( curl_errno( $ch ) )
    {
		//set code to error code along with its data
		$response=array('code' => '3', 'data' => curl_error($ch));
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
