<?php require_once("Include/DB.php");?>
<?php require_once("Include/functions.php");?>
<?php require_once("Include/session.php");?>
<?php
if(isset($_POST["Submit"]))
{
$name=mysql_real_escape_string($_POST["name"]);
$email=mysql_real_escape_string($_POST["email"]);
$comment=mysql_real_escape_string($_POST["comment"]);
date_default_timezone_set('Asia/Kolkata');
$datetime = date('m/d/Y h:i:s a', time());
$datetime;
$postid=$_GET["id"];
if(empty($name) || empty($email) || empty($comment))
{
$_SESSION["ErrorMessage"]= "All field are required";
Redirect_to("Fullpost.php?id={$postid}");
}
elseif(strlen($comment)>500){
$_SESSION["ErrorMessage"]= "only Max 500 characters allowed! ";
Redirect_to("Fullpost.php?id={$postid}");
}
else{
global $connectingDB;
$postidfromurl=$_GET["id"];
$execute=mysql_query("insert into comments(datetime,name,email,comment,approvedBy,status,admin_panel_id)values('$datetime','$name','$email','$comment','pending','OFF','$postidfromurl')");
move_uploaded_file($image=$_FILES["image"]["tmp_name"],$path);
if($execute){
$_SESSION["SuccessMessage"]= "Comment Added successfully";
Redirect_to("Fullpost.php?id={$postid}");
}else{
$_SESSION["ErrorMessage"]= "OOPS! something went wrong";
Redirect_to("Fullpost.php?id={$postid}");
}
}
}
?>

<!doctype html>
<html lang="en">
  <head>
  <title>Full Blog Post</title>
 <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="css/publicstyle.css">
	
   <style>
  
  
   .fieldinfo{
   color:rgb(251,174,44);
 font-family:Bitter,Georgia,"Times New Roman",Times,serif;
font-size:1.2em;
   
   }
   .commentblock{
   background-color:#F6F7F9;
   }
  .pull-left{
   float:left;
   }
   .commentinfo{
   color:#365899;
   font-family:sans-serif;
   font-size:1.1em;
   font-weight:bold;
   padding-top:10px;
   }
   .comment{
   margin-top:-2px;
   padding-bottom:10px;
   font-size:1.1em;
   
   }
   .background{
   background-color:#F6F7F9;
   
   }
   
   </style>
    
    
  </head>
  <body>
 <div class="line" style="height:10px; background:#27aae1";></div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="sr-only">Toggle Navigation</span>
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="Blog.php"><img style="margin-left:100px;"src="Image/himanshu.PNG" width=200; height=30;></a>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#">Services</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="#">Contact Us</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="#">Feature</a>
      </li>
    </ul>
    <form action="Fullpost.php?id=<?php echo $postid; ?>" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="searchbutton" type="submit">Go</button>
    </form>
  </div>
</nav>
<div class="line" style="height:10px; margin-top:-1px; background:#27aae1;"></div>
    
	<div class="container"><!--container-->
	<div class="blog-header">
	<h1>The Complete Responsive CMS Blog </h1>
	<p class="lead">The complete blog using PHP</p>
	</div>
	<div class="row">
	<div class="col-sm-8"><!--Main blog area-->
	<?php  echo Message(); 
 echo SuccessMessage(); ?>
	<?php
global $connectingDB;
if(isset($_GET["searchbutton"])){
$search=$_GET["search"];
$Viewquery="select * from adminpanel 
where datetime like '%$search%' or title like '%$search%' or category like '%$search%' or post like '%$search%' ";

}else{
$postidfromurl=$_GET["id"];
$Viewquery="select * from adminpanel where id='$postidfromurl' order by id desc";}
$execute=mysql_query($Viewquery);
while($datarows=mysql_fetch_array($execute)){
$postid=$datarows["id"];
$datetime=$categoryname=$datarows["datetime"];
$title=$datarows["title"];
$category=$datarows["category"];
$admin=$datarows["author"];

$image=$datarows["image"];
$post=$datarows["post"];
     ?>
	<div class = "blogpost img-thumbnail">
	 <img class="img-thumbnail img-responsive img-rounded" src="Upload/<?php echo $image;?>">
	 <div class="caption">
	 <h1 id="heading"> <?php echo htmlentities($title); ?></h1>
	 <p class="description">Category:<?php echo htmlentities($category) ?> &nbsp; published on:<?php echo htmlentities($datetime) ?></p>
	 <p class="post"><?php echo nl2br($post) ?></p>
	 </div>
	
	  </div>
	  <br>
	 <?php }?>
	 <br><br>
	 <span class="fieldinfo">Share Your Thoughts about this post</span>
	 <br><br>
	 <span class="fieldinfo">Comments</span>
	 <?php
	 $connectingDB;
	 $postidforcomments=$_GET["id"];
	 $Extractingcommentsquery="select * from comments where admin_panel_id='$postidforcomments' and status='ON'";
	 $execute=mysql_query($Extractingcommentsquery);
	 while($datarows=mysql_fetch_array($execute)){
	 $commentdate=$datarows["datetime"];
	  $commentername=$datarows["name"];
	   $commentbyusers=$datarows["comment"];
	 ?>

	 <div class="commentblock">
	 <img style="margin-left:10px; margin-top:10px;" class="pull-left" src="Image/comment.png" width=70px; height=70px;>
<p style="margin-left:90px;" class="commentinfo"><?php echo $commentername; ?></p>
	<p style="margin-left:90px;" class="description"><?php echo $commentdate; ?></p>
	<p style="margin-left:90px;" class="comment"><?php echo nl2br($commentbyusers); ?></p>
	 </div>
	
	 <hr>
	 <?php } ?>
	 <br><br>
	 <form action="Fullpost.php?id=<?php echo $postid; ?>" method="post" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
<label for="title"><span class="fieldinfo">Name:</span></label>
<input type="text"  class="form-control" name="name" id="name"placeholder="Name">
</div>
<div class="form-group">
<label for="title"><span class="fieldinfo">Email:</span></label>
<input type="email"  class="form-control" name="email" id="email"placeholder="Email">
</div>

<div class="form-group">
<label for="postarea"><span class="fieldinfo">Comment:</span></label>
<textarea class="form-control" name="comment" id="commentarea"></textarea>
</div>
<br><br>
<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Submit">
</fieldset>


</form>
	</div> <!--Main blog area ending-->
	<div class="col-sm-offset-1 col-sm-3"><!--side area-->
	<h2>About me</h2>
	<img class="img-responsive rounded-circle imageicon img-fluid img-thumbnail" src="Image/Bunny.jpg">
	<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
dout odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. 
Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
 numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam</p>
 
   <div class="panel panel-primary background">
 <div class="panel-heading">
 <h2 class="panel-title">Categories</h2>
 <hr style="background-color:red">
 </div>
 <div class="panel-body">
 <?php
 global $connectingDB;
 $Viewquery="select * from category order by id desc";
 $execute=mysql_query($Viewquery);
 while($datarows=mysql_fetch_array($execute)){
 $id=$datarows["id"];
 $category=$datarows["name"];
 ?>
 <a href="Blog.php?category=<?php echo $category ?>">
 <span style="margin-left:15px;" id="heading"><?php echo $category."<br>"; ?></span></a>
 <br> <hr style="margin-top:1px;">
 <?php } ?>
 </div>
 <div class="panel-footer">
 </div>
 </div>
 
 <br><br>
 
 <div class="panel panel-primary background">
 <div class="panel-heading">
 <h2 class="panel-title">Recent Posts</h2>
 <hr style="background-color:red">
 </div>
 <div class="panel-body">
<?php
$connectingDB;
$Viewquery="select * from adminpanel order by id desc limit 0,5";
$execute=mysql_query($Viewquery);
 while($datarows=mysql_fetch_array($execute)){
 $id=$datarows["id"];
 $category=$datarows["title"];
$datetime=$datarows["datetime"];
$image=$datarows["image"];
if(strlen($datetime)>11){$datetime=substr($datetime,0,11);}
?>
 <div>
 <img class="pull-left" style="margin-top:10px; margin-left:6px; width:70px ;height:70px;" class="img-responsive img-thumbnail" src="Upload/<?php echo $image; ?>" >
 <a href="Fullpost.php?id=<?php echo $id ?>">
 <p id="heading" style="margin-left:90px;"><?php echo htmlentities($category); ?></p></a>
 <p class="description" style="margin-left:90px;"><?php echo htmlentities($datetime);?></p>
 </div>
 <br><hr style="margin-top:1px;">
 <?php } ?> 
 </div>
 <div class="panel-footer">
 </div>
 </div>
 <br><br>
 <hr>
  <div class="jumbotron" style="color:rgb(234, 96, 163)">
  <h1 class="display-4">Hello, world!</h1>
  <p class="lead">Me Himanshu </p>
  <hr class="my-4">
  <p class="lead">Hi i am Himanshu .<br> I am an avid learner</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>

 
 

	</div><!--side area Ending-->
	</div><!--Row ending-->
	
	</div><!--container ending-->
	<br><br>
	 <div id="footer">
  <hr style=" background-color: red; ">
  <p>Theme By | Himanshu |&copy; All right reserved.
	   <hr style=" background-color: red;">
	</div> 
	
  </body>
</html>