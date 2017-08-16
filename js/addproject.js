// JavaScript Document

/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = document.getElementById("imageURL").files[0];
	var file2 = document.getElementById("report").files[0];	
	var formdata = new FormData();
	var title=document.getElementById("title").value;
	var desc=document.getElementById("desc").value;
	var error=document.getElementsByClassName("validation");
	var allow=true;
	// validations
	if(title.length==0){
		error.item(0).innerHTML="Required";
		allow=false;
	}
	if(desc.length==0){
		error.item(1).innerHTML="Required";
		allow=false;
	}
	if(!allow) return;
	formdata.append("title", title);
	formdata.append("description", desc);
	formdata.append("imageURL", file);
	formdata.append("report", file2);	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","../php/Restricted/AddProject.php",true);
	ajax.send(formdata);
	document.getElementById("message").style.display="normal";
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	document.getElementById("bar").style.width= Math.round(percent);
	document.getElementById("message").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	var data= JSON.parse(event.target.responseText);
		if(data.code==6)
		document.getElementById("message").innerHTML="POST Successful";
		else
		document.getElementById("message").innerHTML=data.data;	
	document.getElementById("bar").style.width= Math.round(percent);
}
function errorHandler(event){
	document.getElementById("message").innerHTML= "Upload Failed";
}
function abortHandler(event){
	document.getElementById("message").innerHTML= "Upload Aborted";
}
