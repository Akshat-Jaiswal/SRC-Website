// JavaScript Document

/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function uploadFile(){
	window.scrollTo(0,0);
	var error=document.getElementsByClassName("validation");
	var formdata = new FormData();
	var name=document.getElementById("name2").value;
	var email=document.getElementById("email").value;
	var contact=document.getElementById("contact").value;
	var college=document.getElementById("college").value;
	var branch=document.getElementById("branch").value;
	var allow=true;
// email check
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(! re.test(email)){
		error.item(1).innerHTML="invalid Email";
		allow=false;
	}
// name check
 	if(name.length<4){
			error.item(0).innerHTML="Minimum 4 charaters are required";
					allow=false;
	}
// check for contact 
	var re2=/^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/;
	if(! re2.test(contact)){
			error.item(2).innerHTML="only the digits are allowed";
					allow=false;
	}
	if(!allow )return;
//		alert("allowed");
	formdata.append("name", name);
	formdata.append("email", email);
	formdata.append("contact", contact);
	formdata.append("college", college);
	formdata.append("branch", branch);	
	var ajax = new XMLHttpRequest();
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","./php/Registration.php",true);
	ajax.send(formdata);
	document.getElementById("message2").innerHTML="Submitting Please wait....";
}
function completeHandler(event){
	alert(event.target.responseText);
	var data= JSON.parse(event.target.responseText);
		if(data.code==6)
		document.getElementById("message2").innerHTML=data.data;
		else
		document.getElementById("message2").innerHTML=data.data;	
	document.getElementById("bar").setAttribute("width", Math.round(percent));
}
function errorHandler(event){
	document.getElementById("message2").innerHTML= "Upload Failed";
}
function abortHandler(event){
	document.getElementById("message2").innerHTML= "Upload Aborted";
}
