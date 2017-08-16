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
<script src="../js/addworkshop.js"></script>

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
            	<li class="active" ><a class="btn btn-navbar " href="adminWorkshops">Workshops</a></li>
            	<li ><a class="btn btn-navbar" href="adminImages.php">Gallery</a></li>
            	<li ><a class="btn btn-navbar" href="adminNotify.php">Notifications</a></li>
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
        <section>
        <div class="container" style="background-image:url(../images/Tulips.jpg); background-size:cover">
  
                <div class="box-gray col-lg-5" style="opacity:.8" >
                    <h1 class="text-center "> organise a new workshop</h1>
                   
                    <form id="contactform" action="php/Registration.php" method="POST" class="validateform" name="send-contact" enctype="multipart/form-data">
                            <div id="message">
                            </div>	
                                <label >*Title </label>
                                <input type="text" class="form-control"  id="title" placeholder="Enter name" data-rule="maxlen:4" data-msg="Please enter at least 4 chars" /> 
                                <div class="validation">
                                </div>
                                <label  >*Description</label>
                                <textarea row="5" class="form-control" id="desc" placeholder="Enter Description" data-rule="email" data-msg="Please enter a valid email" ></textarea>
                                <div class="validation">
                                </div>
                                <label >*image </label>
                                <input type="file" class="form-control" id="imageURL" placeholder="" />
                                <label >*Date of workshop </label>
                                <input type="date" class="form-control" id="wdate" placeholder="please input in yyyy-mm-dd" />
                                <br />
                                <div class="progress"> 
                                    <div id="bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"> 
                                    <span class="sr-only">40% Complete</span> 
                                    </div> 
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