<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php require_once("Include/DB.php");?>
<?php confirm_Login(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
  <title>Manage comments</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="css/adminstyles.css">
	 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


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
<a class="nav-link" href="dashboard.php">
<i class="fas fa-address-book"></i>
Dashboard</a>
<a class="nav-link" href="addnewpost.php"><i class="fas fa-angle-double-down"></i>&nbsp;Add New Post</a>
<a class="nav-link" href="categories.php"><i class="fab fa-contao"></i>&nbsp;Categories</a>
<a class="nav-link" href="comments.php"><i class="fab fa-adn"></i>&nbsp;Manage Admins</a>
<a class="nav-link active" href="comments.php"><i class="fas fa-comments"></i>&nbsp;Comments</a>
<a class="nav-link" href="Blog.php"><i class="fa fa-anchor"></i>&nbsp;Live Blog</a>
<a class="nav-link" href="Logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

    </ul>
	</nav>

</div><!--Ending of side area-->
<div class="col-sm-10"><!--main area-->
<div><?php  echo Message(); 
 echo SuccessMessage();?></div>
<h1>UnApproved comments</h1>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
<th>No.</th>
<th>Name</th>
<th>Date</th>
<th>Comment</th>
<th>Approve</th>
<th>Delete Comment</th>
<th>Details</th>
</tr>
<?php
$connectingDB;
$execute=mysql_query("select * from comments where status='OFF' order by id desc");
$srno=0;
while($datarows=mysql_fetch_array($execute)){
$commentid=$datarows["id"];
$datetimeofcomment=$datarows["datetime"];
$personname=$datarows["name"];
$personcomment=$datarows["comment"];
$commentedpostid=$datarows["admin_panel_id"];

$srno++;

	 if(strlen($personname)>10)
	 {
	 $personname=substr($personname,0,10).'...';
	 }
?>
<tr>
<td><?php echo htmlentities($srno); ?></td>
<td style="color:#5e5eff"><?php  echo htmlentities($personname); ?></td>
<td><?php  echo htmlentities($datetimeofcomment); ?></td>
<td><?php  echo htmlentities($personcomment); ?></td>
<td><a href="Approvecomment.php?id=<?php echo $commentid ?>"><span class="btn btn-success">Approve</a></td>
<td><a href="Deletecomment.php?id=<?php echo $commentid ?>"><span class="btn btn-danger">Delete</a></td>
<td><a href="Fullpost.php?id=<?php echo $commentedpostid; ?>" target="_blank"><span class="btn btn-primary">Live preview</a></td>


</tr>
<?php } ?>
</table>
</div>


<h1>Approved comments</h1>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
<th>No.</th>
<th>Name</th>
<th>Date</th>
<th>Comment</th>
<th>Approved By</th>
<th>Revert Approve</th>
<th>Delete Comment</th>
<th>Details</th>
</tr>
<?php
$connectingDB;
$Admin="Himanshu";
$execute=mysql_query("select * from comments where status='ON' order by id desc");
$srno=0;
while($datarows=mysql_fetch_array($execute)){
$commentid=$datarows["id"];
$datetimeofcomment=$datarows["datetime"];
$personname=$datarows["name"];
$personcomment=$datarows["comment"];
$ApprovedBy=$datarows['approvedBy'];
$commentedpostid=$datarows["admin_panel_id"];

$srno++;

	 if(strlen($personname)>10)
	 {
	 $personname=substr($personname,0,10).'...';
	 }
?>
<tr>
<td><?php echo htmlentities($srno); ?></td>
<td style="color:#5e5eff"><?php  echo htmlentities($personname); ?></td>
<td><?php  echo htmlentities($datetimeofcomment); ?></td>
<td><?php  echo htmlentities($personcomment); ?></td>
<td><?php echo htmlentities($ApprovedBy); ?></td>
<td><a href="Disapprovecomment.php?id=<?php echo $commentid;?> ">
<span class="btn btn-warning">Dis-Approve</a></td>
<td><a href="Deletecomment.php?id=<?php echo $commentid ?>"><span class="btn btn-danger">Delete</a></td>
<td><a href="Fullpost.php?id=<?php echo $commentedpostid; ?>"target="_blank"><span class="btn btn-primary">Live preview</a></td>


</tr>
<?php } ?>
</table>
</div>
</div><!--Ending of main area-->


</div><!--ending of Row-->

</div><!--Ending of container fluid-->
  <div id="footer">
  <hr style=" background-color: red; ">
  <p class="lead">Theme By | Himanshu |&copy;2016-2019 All right reserved.
	
	   <hr style=" background-color: red;  ">
	</div> 
	<div style="height:10px;background:#27AAE1;"></div>
    
  </body>
</html>