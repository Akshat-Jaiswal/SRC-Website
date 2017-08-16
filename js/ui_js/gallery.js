// JavaScript Document
//	function for getting data
var len=10;
var off=0;
	function getData(about,length,offset){
		var ajax=new XMLHttpRequest();
		ajax.addEventListener("load",addGallery,false);
		ajax.addEventListener("error",function(event){
				alert(event.target.responseText);
		},false);
		str="about="+about+"&length="+length+"&offset="+offset;
		ajax.open("GET","./php/getData.php?"+str,true);
		ajax.send(null);
	}		
// function	for add posts
	// function for forming gallery items
	function formImage(data){
		var elem=document.createElement("li");
		elem.setAttribute("class","col-lg-3 design");
		var str=	"<div class='item-thumbs'>";
			//	<!-- Fancybox - Gallery Enabled - Title - Full Image -->
			str+=	"<a class='hover-wrap fancybox' data-fancybox-group='gallery' title='"+data.title+"' href='"+data.imageURL+"'>";
			str+=	"	<span class='overlay-img'></span>";
			str+=	"	<span class='overlay-img-thumb font-icon-plus'></span>";
			str+=	"		</a>";
			str+=	"		<img src='"+data.imageURL+"' alt='"+data.description+"'>";
			str+=	"		</div>";
		elem.innerHTML=str;
		return elem;				
	}
	window.onload=function(){
		getData("gallery",len,off);
	}
	function addGallery(event){
		info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementById("thumbs");
			data=info.data;
			for(i=0;i<data.length;++i){
		
				post=formImage(data[i]);
				elem.appendChild(post);
			}
		off=off+len;	
		}
		document.getElementById("load").innerHTML="Load More";		
	}
	function loadMore(){
		document.getElementById("load").innerHTML="Loading Please Wait...";
		getData("gallery",len,off+len);
	}
	function addPosts(event){
	info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementsByClassName("recent").item(0);
			data=info.data;
			for(i=0;i<data.length;++i){
				post=formPosts(data[i]);
				elem.innerHTML+=post;
			}		
		}
	}