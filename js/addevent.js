// JavaScript Document

/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var error=document.getElementsByClassName("validation");
	var title=document.getElementById("title").value;
	var desc=document.getElementById("desc").value;
	var edate = document.getElementById("edate").value;	
	var ldate = document.getElementById("ldate").value;	
	var file = document.getElementById("imageURL").files[0];
	var file2 = document.getElementById("statement").files[0];
	var links = document.getElementById("link").value;		
	var allow=true;
	var formdata = new FormData();
	//validations
	if(title.length==0){
			error.item(0).innerHTML="Required";
		allow=false;
	
	}
	if(desc.length==0){
			error.item(1).innerHTML="Required";
		allow=false;
	
	}
		var re=/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
	if(!re.test(edate)){
		error.item(2).innerHTML="Format not Valid";
		allow=false;
	
	}
	if(!re.test(ldate)){
		error.item(3).innerHTML="Format Not Valid";
		allow=false;
	
	}
	
	if(links.length >= 100 || links.length <=5 ){
		error.item(6).innerHTML="URL Length must be less than 100 characters";		
		allow=false;
	}
	
	if(!allow ) return;
	formdata.append("description", desc);
	formdata.append("imageURL", file);
	formdata.append("title", title);
	formdata.append("statement",file2);
	formdata.append("edate", edate);
	formdata.append("ldate", ldate);
	formdata.append("link", links);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","../php/Restricted/AddEvent.php",true);
	ajax.send(formdata);
	document.getElementById("message").style.display="normal";
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	document.getElementById("bar").style.width= Math.round(percent);
	document.getElementById("message").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	alert(event.target.responseText);
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
