// JavaScript Document
	// JavaScript Document
//	function for getting data
	function getData(about,length,offset,handler){
		var ajax=new XMLHttpRequest();
		ajax.addEventListener("load",addEvents,false);
		ajax.addEventListener("error",function(event){
				alert(event.target.responseText);
		},false);
		str="about="+about+"&length="+length+"&offset="+offset;
		ajax.open("GET","./php/getData.php?"+str,true);
		ajax.send(null);
	}		
	function formEvent(data){
		var elem=document.createElement("div");
		elem.setAttribute("class","row box-gray");
        var str=	"<div class='col-lg-6 img-box box-gray'>";
		str+="<img class='img-responsive' src='"+data.imageURL+"' />";
     	str+="   </div>";
        str+="    <div class='col-lg-6 box-gray' style='opacity:.9'>";
        str+="    	<h3>" +data.event+ "</h3>";
        str+="        <p> Event Date:"+data.eDate+"</span></p>";
		str+="		<p>Last Date for Registration: "+data.ldate+"</p>";
        str+="        <p class='text-info'>";
		str+="          	<h5 >Description</h5>";
		str+=	data.description;
        str+="        </p><a class='btn btn-blue marginbot10' href='"+data.flink+"'>Register </a>";
        str+="        <a class='btn btn-green pull-right' href='"+data.statement+"'>Download Problem Statement</a>";
		str+="</div>";
		elem.innerHTML=str;
		return elem;				
	}
	window.onload=function(){
		getData("aayaam",5,0,"addPosts");
	}
	function addEvents(event){
	info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementById("container");
			data=info.data;
			for(i=0;i<data.length;++i){
				post=formEvent(data[i]);
				elem.appendChild(post);
			}		
		}
	}