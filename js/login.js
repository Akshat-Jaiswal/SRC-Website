// JavaScript Document
function login(){	
		var name=document.getElementById("name").value;
		var passwd=document.getElementById("passwd").value;
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.addEventListener("error",errorHandler,false);
		xmlhttp.addEventListener("load",completeHandler,false);
		xmlhttp.addEventListener("abort",abortHandler,false);
		document.getElementById("message").innerHTML="Checking Please Wait";
		xmlhttp.open("POST","php/login.php",true);
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		var str="username="+name+"&password="+passwd;
		xmlhttp.send(str);
}
function completeHandler(event){
	var data=JSON.parse(event.target.responseText);
	if(data.code==6){
		document.getElementById("message").innerHTML="Login Successful";
		window.location.href="./php/adminPanel.php";
	}
	else
	document.getElementById("message").innerHTML="Invalid Credentials";
}
function abortHandler(event){
		document.getElementById("message").innerHTML="Aborted By user";
}
function errorHandler(event){
		document.getElementById("message").innerHTML="Unable to Connect Check Network Settings...";
}