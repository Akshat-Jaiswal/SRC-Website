// JavaScript Document
//	function for getting data
var plen=10;
var poff=0;
var rlen=5;
var roff=0;
	function getData(about,length,offset,handler){
		var ajax=new XMLHttpRequest();
		if(handler=="addPosts")
		ajax.addEventListener("load",addPosts,false);
		if(handler=="reports")
		ajax.addEventListener("load",addReport,false);
		ajax.addEventListener("error",function(event){
				alert(event.target.responseText);
		},false);
		str="about="+about+"&length="+length+"&offset="+offset;
		ajax.open("GET","./php/getData.php?"+str,true);
		ajax.send(null);
	}		
// function	for add posts
	function formReport(data){
		var elem=document.createElement("li");
		var str="<h6><a href='"+data.dlink+"'>"+data.title+"</a></h6>";
			str+="<p>";
			str+=data.RDate;
			str+="<br />Uploaded By:"+data.uploadedBy+"<br /></p>";
		elem.innerHTML=str;
		return elem;				
	}
// function for forming gallery items
	function formPosts(data){
		var elem=document.createElement("div");
		elem.setAttribute("class","post-image");
		var str="				<div class='post-heading'>";
			str+="					<h3><a href='#'>"+data.title+"</a></h3>";
			str+="				</div>";
			str+="				<img src='"+data.imageURL+"' alt='' />";
			str+="			</div>";
			str+="			<p>"+data.description+"</p>";
			str+="		<div class='bottom-article'>";
			str+="				<ul class='meta-post'>";
			str+="					<li><i class='icon-calendar'></i><a href='#'>"+data.date+"</a></li>";
			str+="						<li><i class='icon-user'></i><a href='#'>"+data.PostedBy+"</a></li>";
			str+="				<li><i class='icon-folder-open'></i><a href='#'> Blog</a></li>";
			str+="				</ul>";
			str+="				<a href='#' class='pull-right'>Continue reading <i class='icon-angle-right'></i></a>";
        elem.innerHTML=str;
		return elem;				
	}
	window.onload=function(){
		getData("posts",plen,poff,"addPosts");
		getData("reports",rlen,roff,"reports");
	}
	function loadMorePosts(){
		elem=document.getElementsByClassName("all").item(0);
		elem.innerHTML="Loading Please Wait..";
		getData("posts",plen,poff+plen,"addPosts");
	}
	function loadMoreReports(){
		elem=document.getElementsByClassName("all").item(1);
		elem.innerHTML="Loading Please Wait..";
		getData("reports",rlen,roff+rlen,"reports");
	}
	function addReport(event){
		info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementsByClassName("recent").item(0);
			data=info.data;
			for(i=0;i<data.length;++i){
		
				post=formReport(data[i]);
				elem.appendChild(post);
			}
		}
		elem=document.getElementsByClassName("all").item(1);
		elem.innerHTML="Load More";
		roff=roff+rlen;
		
	}
	function addPosts(event){
	info=JSON.parse(event.target.responseText);
		if(info.code==6){
			elem=document.getElementById("posts");
			data=info.data;
			for(i=0;i<data.length;++i){
				post=formPosts(data[i]);
				elem.appendChild(post);
			}		
		elem=document.getElementsByClassName("all").item(0);
		elem.innerHTML="Load More";
		poff=poff+plen;
		}
	}