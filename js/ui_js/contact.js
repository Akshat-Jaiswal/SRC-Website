// JavaScript Document

/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var formdata = new FormData();
	var name=document.getElementById("name2").value;
	var email=document.getElementById("email").value;
	var subject=document.getElementById("subject").value;
	var message=document.getElementById("msg").value;
	var error=document.getElementsByClassName("validation");
	var allow=true;
//validations
	if(name.length==0){
		error.item(0).innerHTML="name Required";
		allow=false;
	}
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(! re.test(email)){
		error.item(1).innerHTML="invalid Email";
		allow=false;
	}

	if(message.length==0){
		error.item(3).innerHTML="Message Required";
		allow=false;
	}
	if(!allow)
		return;
	formdata.append("email","patelganesh.n@gmail.com");
	formdata.append("from", email);
	formdata.append("subject", subject);	
	formdata.append("name", name);	
	formdata.append("message", message);
	var ajax = new XMLHttpRequest();
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","./gmail/smtpgmail.php",true);
	ajax.send(formdata);
	document.getElementById("message2").innerHTML="Submitting Please Wait...";
}
function completeHandler(event){
	var data=event.target.responseText;
		document.getElementById("message2").innerHTML=data;
}
function errorHandler(event){
	document.getElementById("message2").innerHTML= "Sending Failed";
}
function abortHandler(event){
	document.getElementById("message2").innerHTML= "Sending Failed";
}
