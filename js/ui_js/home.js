// JavaScript Document
//	function for getting data
	function getData(about,length,offset,handler){
		var ajax=new XMLHttpRequest();
		if(handler=="addPosts")
		ajax.addEventListener("load",addPosts,false);
		if(handler=="addGallery")
		ajax.addEventListener("load",addGallery,false);
		ajax.addEventListener("error",function(event){
				alert("Unable To Fetch Data Pleasse Refresh Page...");
		},false);
		str="about="+about+"&length="+length+"&offset="+offset;
		ajax.open("GET","./php/getData.php?"+str,true);
		ajax.send(null);
	}		
// function	for add posts
	function formPosts(data){
		var elem=document.createElement("li");
		var	str="<img src='"+data.imageURL+"' width='64px' height='64px' class='pull-left' alt='' />";
			str+="<h6><a href='posts.html'>"+data.title+"</a></h6>";
			str+="<p>";
			str+=data.date;
			str+="<br /><br /></p>";
		elem.innerHTML=str;
		return elem;				
	}
// function for forming gallery items
	function formImage(data){
		var elem=document.createElement("li");
		elem.setAttribute("class","col-lg-3 design");	
		var	str=	"<div class='item-thumbs'>";
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
		getData("posts",3,0,"addPosts");
		getData("gallery",4,0,"addGallery");
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
		}
		

	}
	function addPosts(event){
	info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementsByClassName("recent").item(0);
			data=info.data;
			for(i=0;i<data.length;++i){
				post=formPosts(data[i]);
				elem.appendChild(post);
			}		
		}
	}