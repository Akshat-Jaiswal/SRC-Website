<?php
// script for getting posts
// get configuration files
require_once("./Configurations/DatabaseConfig.php");
// default response
$response=array('code' => '1', 'data' => 'Unable To Connect To Database');
if(isset($_GET['offset'])&& isset($_GET['length']) && isset($_GET['about'])){
		$offset=$_GET['offset'];
		$noOfPosts=$_GET['length'];
		// for selecting a particular table
		$table=$_GET['about'];
		// connect to database
		$con=mysqli_connect(config::HOST,config::USER,config::PASS,config::DB) or 
			die(json_encode($response));
		// otherwise create a new response
		$data=array();
	if($table=='gallery')
	$parameter='ID';
	// for projects
	if($table=='projects')
	$parameter="title";
	// for posts
	if($table=='posts')	$parameter="PDate desc";
	//for workshops
	if($table=='workshops')	$parameter="WDate desc";
	// for reports
	if($table=='reports')	$parameter="RDate desc";
	// for founders
	if($table=='founders')	$parameter="year";
	// for aayaam events
	if($table=='aayaam') 	$parameter="Edate";
		// query 
		$sql = "SELECT * FROM $table order by $parameter LIMIT $offset, $noOfPosts ";
		// query the database
		$result=mysqli_query($con,$sql);
		if(!$result){
			$response=array('code' => '5','data' => mysqli_error($con) );
			die(json_encode($response));
		}
		// fetch each row and convert to an array
		$count=mysqli_num_rows($result);
		for($i=0;$i<$count;++$i){
			$row=mysqli_fetch_row($result);
			array_push($data,convertToArray($row));
		}
		// create a new response
		$response=array('code' => '6','data' => $data);
		mysqli_close($con);
		exit(json_encode($response));

}
else{
$response=array('code' => '0', 'data' => 'Not Enough Parameters in Call to scripts');
exit(json_encode($response));
}
// function for converting row into a json object
function convertToArray($r){
	$table=$_GET['about'];
	// change array according to the table
	// for projects
	if($table=='projects')
	$value=array('id' => $r[0],'title' => $r[1],'description' => $r[2],'imageURL' => $r[3],'report' => $r[4]);
	// for posts
	if($table=='posts'){
		$tm=strtotime($r[2]);
		$r[2]=date("F d,Y",$tm);
		$value=array('title' => $r[1],'date' => $r[2],'description' => $r[3],'PostedBy' => $r[4],'imageURL' => $r[5]);	
	}
	//for workshops
	if($table=='workshops'){
		$tm=strtotime($r[3]);
		$r[3]=date("F d,Y",$tm);	
		$value=array('title' => $r[1],'description' => $r[2],'wDate' => $r[3],'wLink' => $r[4],'imageURL' => $r[5]);
	}
	// for reports
	if($table=='reports'){
		$tm=strtotime($r[2]);
		$r[2]=date("F d,Y",$tm);	
		$value=array('title' => $r[0],'dlink' => $r[1],'RDate' => $r[2],'uploadedBy' => $r[3]);
	}
	if($table=='founders')
	$value=array('name' => $r[0],'designation' => $r[1],'year' => $r[2],'imageURL' => $r[3]);
	
	if($table=='aayaam'){
		$tm=strtotime($r[4]);
		$r[4]=date("F d,Y",$tm);
		$tm=strtotime($r[2]);
		$r[2]=date("F d,Y",$tm);
	
	$value=array('event' => $r[0],'description' => $r[1],'eDate' => $r[2],'flink' => $r[3],'ldate' => $r[4],'imageURL' =>$r[5],'statement'  => $r[6]);
	}
	if($table=='gallery')
	$value=array('title' => $r[0],'description' => $r[1],'imageURL' => $r[2] );
	return $value;
}
?>