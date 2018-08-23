<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php require_once("Include/DB.php");?>
<?php confirm_Login(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
  <title>Admin Dashboard</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="css/adminstyles.css">
	 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


  </head>
  <body>
   <div class="line" style="height:10px; background:#27aae1";></div>


<nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top bg-light">

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
        <a class="nav-link active" href="Blog.php" target="_blank">Blog</a>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="searchbutton" type="submit">Go</button>
    </form>
  </div>
</nav>
<div class="line" style="height:10px; margin-top:-1px; background:#27aae1;"></div>
   
<div class="container-fluid">
<div class="row">
<div class="col-sm-2">
<br><br>
<nav class="nav nav-pills nav-stacked nav-responsive">
<ul id="side-menu" >
<a class="nav-link active" href="dashboard.php">
<i class="fas fa-address-book"></i>
Dashboard</a>
<a class="nav-link" href="addnewpost.php"><i class="fas fa-angle-double-down"></i>&nbsp;Add New Post</a>
<a class="nav-link" href="categories.php"><i class="fab fa-contao"></i>&nbsp;Categories</a>
<!--<a class="nav-link" href="addnewpost.php"><i class="fab fa-accusoft"></i>&nbsp;Add New Post</a>-->
<a class="nav-link" href="Admins.php"><i class="fab fa-adn"></i>&nbsp;Manage Admins</a>
<a class="nav-link" href="comments.php"><i class="fas fa-comments"></i>&nbsp;Comments

<?php
$connectingDB;
$querytotal="select count(*) from comments where status='OFF'";
$executetotal=mysql_query($querytotal);
$rowtotal=mysql_fetch_array($executetotal);
$Total=array_shift($rowtotal);
if($Total>0){
?>
<button type="button" class="btn  btn-warning btn-sm float-sm-right responsive-width pull-right">
    <?php echo $Total;?>
</button>
<?php } ?>
</a>

<a class="nav-link" href="Blog.php"><i class="fa fa-anchor"></i>&nbsp;Live Blog</a>
<a class="nav-link" href="Logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

    </ul>
	</nav>

</div><!--Ending of side area-->
<div class="col-sm-10"><!--main area-->
<div><?php  echo Message(); 
 echo SuccessMessage();?></div>
<h1>Admin DashBoard</h1>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
<th>No</th>
<th>Post Title</th>
<th>Date & Time</th>
<th>Author</th>
<th>Category</th>
<th>Banner</th>
<th>Comments</th>
<th>Action</th>
<th>Details</th>
</tr>
<?php 
global $connectingDB;
$Viewquery="select * from adminpanel order by datetime desc";
$execute=mysql_query($Viewquery);
$srno=0;
while($datarows=mysql_fetch_array($execute)){
$id=$datarows["id"];
$datetime=$datarows["datetime"];
$title=$datarows["title"];
$category=$datarows["category"];
$Admin=$datarows["author"];
$image=$datarows["image"];
$post=$datarows["post"];
$srno++;
?>
<tr>
<td><?php echo $srno?></td>
<td style="color:#5e5eff"><?php 
if(strlen($title)>20){
$title=substr($title,0,20)."...";
}

echo $title ?></td>
<td><?php
if(strlen($datetime)>10){
$datetime=substr($datetime,0,10)."...";
}
 echo $datetime ?></td>
<td><?php 
if(strlen($Admin)>6){
$Admin=substr($Admin,0,6)."...";
}
echo $Admin ?></td>
<td><?php 
if(strlen($category)>8){
$category=substr($category,0,8)."...";
}
echo $category ?></td>
<td><img src="Upload/<?php echo $image; ?>" width="170px"; height="50px"></td>
<td>
<?php
$connectingDB;
$queryapproved="select count(*) from comments where admin_panel_id='$id' and status='ON'";
$executeapproved=mysql_query($queryapproved);
$rowapproved=mysql_fetch_array($executeapproved);
$TotalApproved=array_shift($rowapproved);
if($TotalApproved>0){
?>
<button type="button" class="btn  btn-success btn-sm float-sm-right responsive-width">
    <?php echo $TotalApproved;?>
</button>
<?php } ?>

<?php
$connectingDB;
$queryunapproved="select count(*) from comments where admin_panel_id='$id' and status='OFF'";
$executeunapproved=mysql_query($queryunapproved);
$rowunapproved=mysql_fetch_array($executeunapproved);
$TotalunApproved=array_shift($rowunapproved);
if($TotalunApproved>0){
?>

<button type="button" class="btn  btn-danger btn-sm  responsive-width">
    <?php echo $TotalunApproved;?>
</button>
<?php } ?>

</td>
<td>
<a href="Editpost.php?edit=<?php echo $id;?> ">
<span class="btn btn-warning">Edit</span> </a>
<a href="Deletepost.php?delete=<?php echo $id;?> ">
<span class="btn btn-danger">Delete</span></a>
 </td>
<td><a href="Fullpost.php?id=<?php echo $id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
</tr>
<?php } ?>
</table>

</div>

</div><!--Ending of main area-->


</div><!--ending of Row-->

</div><!--Ending of container fluid-->
  <div id="footer">
  <hr style=" background-color: red; ">
  <p>Theme By | Himanshu |&copy; All right reserved.
	<p>
	 </p>
	   <hr style=" background-color: red;  ">
	</div> 
	<div style="height:10px;background:#27AAE1;"></div>
    
  </body>
</html>