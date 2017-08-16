// JavaScript Document

function uploadFile(){
	var file = document.getElementById("imageURL").files[0];
	var formdata = new FormData();
	var title=document.getElementById("title").value;
	var desc=document.getElementById("desc").value;
	var error=document.getElementsByClassName("validation");
	var allow=true;
//validations
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
	formdata.append("image", file);	
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","../php/Restricted/AddPost.php",true);
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

// JavaScript Document

function uploadFile2(){
	var formdata = new FormData();
	var title=document.getElementById("title2").value;
	var table=document.getElementById("table").value;
	var error=document.getElementsByClassName("validation2");
	var allow=true;
//validations
	if(title.length==0){
		error.item(1).innerHTML="Required";
		allow=false;
	}
	if(!allow) return;
	formdata.append("title", title);
	formdata.append("table", table);	
	var ajax = new XMLHttpRequest();
	ajax.addEventListener("load", completeHandler2, false);
	ajax.addEventListener("error", errorHandler2, false);
	ajax.addEventListener("abort", abortHandler2, false);
	ajax.open("POST","../php/Restricted/deleteData.php",true);
	ajax.send(formdata);
	document.getElementById("message2").innerHTML="Querying DB Please Wait...";
}
function completeHandler2(event){
	var data= JSON.parse(event.target.responseText);
	document.getElementById("message2").innerHTML=data.data;	
}
function errorHandler2(event){
	document.getElementById("message2").innerHTML= "Upload Failed";
}
function abortHandler2(event){
	document.getElementById("message2").innerHTML= "Upload Aborted";
}
