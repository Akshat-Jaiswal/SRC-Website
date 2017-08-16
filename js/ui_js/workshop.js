// JavaScript Document
//	function for getting data
var len=10;
var off=0;
	function getData(about,length,offset){
		var ajax=new XMLHttpRequest();
		ajax.addEventListener("load",addProjects,false);
		ajax.addEventListener("error",function(event){
				alert(event.target.responseText);
		},false);
		str="about="+about+"&length="+length+"&offset="+offset;
		ajax.open("GET","./php/getData.php?"+str,true);
		ajax.send(null);
	}		
// function	for add posts
	// function for forming gallery items
	function formProject(data){
		var elem=document.createElement("div");
		elem.setAttribute("class","col-lg-4 box-gray text-center");
		var str="	<div class='img-responsive'>";
            str+="    	<img src='"+data.imageURL+"' alt=''>";
            str+="    </div>";
            str+="    <h3>"+data.title+"</h3>";
            str+="    <p class='text-info'>On "+ data.wDate+"</quote>";
            str+="    <blockquote>"+data.description+"</blockquote>";
            str+="    <div class='box-bottom'>";
            str+="    	<a href='"+data.wLink+"'>Learn More</a>";
            str+="    </div>";
		elem.innerHTML=str;
		return elem;				
	}
	window.onload=function(){
		getData("workshops",len,off);
	}

	function loadMore(){
		document.getElementById("load").innerHTML="Loading Please Wait...";
		getData("workshops",len,off+len);
	}
	function addProjects(event){
	info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementsByClassName("row").item(1);
			data=info.data;
			for(i=0;i<data.length;++i){
				post=formProject(data[i]);
				elem.appendChild(post);
			}	
			off=off+len;			
		}
		document.getElementById("load").innerHTML="Load More";
	}