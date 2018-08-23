<?php require_once("Include/DB.php");?>
<!doctype html>
<html lang="en">
  <head>
  <title>Blog</title>
 <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="css/publicstyle.css">
	
   <style>
  
   </style>
    
    
  </head>
  <body>
  <!--
<div style="height:30px; background:#27aae1;">
 <nav class="navbar navbar-inverse" role="navigation">
<div class="container">
<div class="navbar-header">
<a class="navbar-brand" href="Blog.php"><img style="margin-top:135px"src="Image/himanshu.PNG" width=200; height=30;></a>

</div>
<ul class="nav navbar-nav">
<li><a href="#">Home</a></li>
<li><a href="#">Blog</a></li>
<li><a href="#">About Us</a></li>
<li><a href="#">Services </a></li>
<li><a href="#">Contact Us</a></li>
<li><a href="#">Feature</a></li>
</ul>
</div>
</div>
 </nav> 
 -->
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
        <a class="nav-link " href="secretdiary/projectdiary.php">Services</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="#">Contact Us</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="#">Feature</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="searchbutton" type="submit">Go</button>
    </form>
  </div>
</nav>

<div class="line" style="height:10px; margin-top:-1px; background:#27aae1;"></div>
    
	<div class="container-fluid"><!--container-->
	<div class="blog-header">
	<h1>The Complete Responsive CMS Blog </h1>
	<p class="lead">The complete blog using PHP</p>
	</div>
	<div class="row">
	<div class="col-sm-8"><!--Main blog area-->
	<?php
global $connectingDB;
//Query when Search Button is Active
if(isset($_GET["searchbutton"])){

$search=$_GET["search"];
$Viewquery="select * from adminpanel 
where datetime like '%$search%' or title like '%$search%' or category like '%$search%' or post like '%$search%' order by id desc ";
}


//query when category is active
elseif(isset($_GET["category"])){
$category=$_GET["category"];
$Viewquery="select * from adminpanel where category='$category' order by id desc";
}



//query when pagination is active ie. Blog.php?page=1
elseif(isset($_GET["page"])){
$page=$_GET["page"];
if($page==0 || $page<1){$showpostfrom=0;}
else{
$showpostfrom=($page*5)-5;}

$Viewquery="select * from adminpanel order by id desc limit $showpostfrom,5";
}

//The Default Query for Blog.php page page
else{

$Viewquery="select * from adminpanel order by id desc";}
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
	 <p class="description">Category:<?php echo htmlentities($category) ?> &nbsp; published on:<?php echo htmlentities($datetime) ?>
	 
	 <?php
$connectingDB;
$queryapproved="select count(*) from comments where admin_panel_id='$postid' and status='ON'";
$executeapproved=mysql_query($queryapproved);
$rowapproved=mysql_fetch_array($executeapproved);
$TotalApproved=array_shift($rowapproved);
if($TotalApproved>0){
?>
<button type="button" class="btn  badge  btn-sm float-sm-right responsive-width">
    Comments:<?php echo $TotalApproved;?>
</button>
<?php } ?>
	 
	 </p>
	 <p class="post"><?php  
	 if(strlen($post)>150)
	 {
	 $post=substr($post,0,150).'...';
	 }
	 echo $post ?></p>
	 </div>
	 <a href="Fullpost.php?id=<?php echo $postid; ?>"><span class="btn btn-info"> Read More &raquo; </span></a>
	  </div>
	  <br>
	 <?php }?>
	 
	<!--  <nav aria-label="Page navigation example">
	   <ul class="pagination justify-content-center">-->
	    <nav aria-label="Page navigation example">
  <ul class="pagination pagination-lg">
  <!-- creating Backward button-->
  <?php
  if(isset($page))
  {
  if($page>1){
  ?>

   <li class="page-item"><a class="page-link" href="Blog.php?page=<?php echo $page-1; ?>">&laquo</a></li>
<?php 
}
 } ?>
  

	 <?php
	 global $connectingDB;
	 $querypagination="select count(*) from adminpanel";
	 $executepagination=mysql_query($querypagination);
	 $rowpagination=mysql_fetch_array($executepagination);
	  $totalposts=array_shift($rowpagination);
	// echo $totalposts;
	   $postpagination=$totalposts/5;
	  $postpagination=ceil($postpagination);
	  //echo $postpagination;
	  for($i=1;$i<=$postpagination;$i++){
	  if(isset($page)){
	  if($i==$page){
	 ?>
	  <li class="page-item active"><a class="page-link" href="Blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	
	 <!-- <li class="page-item disabled"><a href="Blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	 </ul>-->
	<?php } else { ?>
 
	 <li class="page-item"><a class="page-link" href="Blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	<?php 
	} 
	}
	}
	?>
	 <!-- creating forward button-->
	<?php
  if(isset($page))
  {
  if($page+1<=$postpagination){
  ?>

   <li class="page-item"><a class="page-link" href="Blog.php?page=<?php echo $page+1; ?>">&raquo</a></li>
<?php 
}
 } ?>
	  </ul>
	</nav>
	</div> <!--Main blog area ending-->
	<div class="col-sm-offset-1 col-sm-3"><!--side area-->
		<h2>About me</h2>
	<img class="img-responsive rounded-circle imageicon img-fluid img-thumbnail" src="Image/Bunny.jpg">
	<p class="lead">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
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
  <div class="jumbotron">
  <h1 class="display-4">Hello, world!</h1>
  <p class="lead">Me Himanshu .</p>
  <hr class="my-4">
  <p class="lead">It uses utility classes for typography and spacing to space content out within the larger container.</p>
</div>
	</div><!--side area Ending-->
	</div><!--Row ending-->
	
	</div><!--container ending-->
	 <div id="footer">
  <hr style=" background-color: red; ">
  <p>Theme By | Himanshu |&copy; All right reserved.
	
	   <hr style=" background-color: red;">
	</div> 
	
  </body>
</html>