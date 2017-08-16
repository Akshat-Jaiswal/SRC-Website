<?php 
	session_start();
	if(!isset($_SESSION['username']))
		header("Location: ../index.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin-Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<!-- css -->
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" />


<!-- Theme skin -->
<link href="../skins/default.css" rel="stylesheet" />

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script src="../js/addnotify.js"></script>

</head>
<body>
<div class="row">
  <div class="col-lg-2 left-sidebar box-gray">
  			<div class=" text-center img-responsive margintop40">
                <img src="../img/avatar.png" alt="User Profile Pic">
            </div>

            <ul class="nav nav-pills nav-stacked margintop20">
                <li ><a class="btn btn-navbar" href="adminPanel.php">Posts</a></li>
                <li ><a class="btn btn-navbar" href="adminEvents.php">Events</a></li>
            	<li ><a class="btn btn-navbar" href="adminWorkshops.php">Workshops</a></li>
            	<li ><a class="btn btn-navbar" href="adminImages.php">Gallery</a></li>
            	<li class="active"><a class="btn btn-navbar" href="#">Notifications</a></li>
            	<li ><a class="btn btn-navbar" href="adminProjects.php">Projects</a></li>
            	<li ><a class="btn  btn-navbar" href="adminReport.php">Reports</a></li>
           </ul>
  </div>
  <div class="content col-lg-9">
    	<div class="row margintop20">
        	<div class="pull-right">
            <span class="text-info" ><?php echo $_SESSION['username'] ?></span>
        	<a href="signout.php" class="btn btn-blue">Signout</a>
            </div>
        </div>    	    
        <!-- start header -->
        <section style="background-image:url(../images/Tulips.jpg); background-size:cover" >
        <div class="container">
  
                <div class="box-gray col-lg-5" style="opacity:.8">
                    <h1 class="text-center "> Send Notifications</h1>
                   
                    <form id="contactform" action="php/Registration.php" method="POST" class="validateform" name="send-contact" enctype="multipart/form-data">
                            <div id="message">
                            	Fill
                            </div>	
                                <label >*Recepients </label>
                                <select id="recepients" onChange="show()" >
                                	 <option value="2">Selected Members</option>
                                    <option value="1">Everyone</option>
                                </select>
     
                                <textarea row="5" class="form-control" id="mids" placeholder="Emails seperated by commas(,)" data-rule="email" data-msg="Please enter a valid email" ></textarea>                                </textarea>
                         
                         	    <br />       
                                <label  >*Message</label>
                                <textarea row="5" class="form-control" id="message" placeholder="Your Message" data-rule="email" data-msg="Please enter a valid email" ></textarea>
                                <div class="validation">
                                </div>
                                <p>    
                                    <button class="btn btn-blue margintop10 pull-left" type="button" onClick="uploadFile()">Submit</button>
                                    <span class="pull-right margintop20">* Please fill all required form field, thanks!</span>
                                </p>
                                                    </form>
                </div>
        </div>
        
	<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
	</section>
    </div>
</div>    
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>