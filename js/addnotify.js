// JavaScript Document

/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function show(){
	var val=document.getElementById("recepients");
	var mids=document.getElementById("mids");
	if(val.value==2)
	mids.style.display="normal";
	if(val.value==1)
	mids.style.display="none";
	
}
function uploadFile(){
	var formdata = new FormData();
	var val=document.getElementById("recepients");
	var mids=document.getElementById("mids").value;
	var msg=document.getElementById("message").value;
	if(val==2)
	formdata.append("Mids",mids);
	formdata.append("message", msg);
	var ajax = new XMLHttpRequest();	
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","../php/Restricted/sendmsg.php",true);
	ajax.send(formdata);
	document.getElementById("message").style.display="normal";
}
function completeHandler(event){
	var data= JSON.parse(event.target.responseText);
		if(data.code==6)
		document.getElementById("message").innerHTML="Success:"+data.data.success+" Failed:"+data.data.failure;
		else
		document.getElementById("message").innerHTML=data.data;	
}
function errorHandler(event){
	document.getElementById("message").innerHTML= "Sending Failed";
}
function abortHandler(event){
	document.getElementById("message").innerHTML= "Sending Aborted";
}
