<?php require_once("Include/DB.php");?>
<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php confirm_Login(); ?>
<?php
if(isset($_POST["Submit"]))
{
$category=mysql_real_escape_string($_POST["category"]);
date_default_timezone_set('Asia/Kolkata');
$datetime = date('m/d/Y h:i:s a', time());
$datetime;
//echo $datetime;
$Admin=$_SESSION["username"];
if(empty($category))
{
$_SESSION["ErrorMessage"]= "All Fields must be Filled out";
Redirect_to("categories.php");
}
elseif(strlen($category)>99){
$_SESSION["ErrorMessage"]= "Too Long Name for Category";
Redirect_to("categories.php");
}
else{
global $connectingDB;
$execute=mysql_query("insert into category(datetime,name,creatorname)values('$datetime','$category','$Admin')");

if($execute){
$_SESSION["SuccessMessage"]= "Category Added successfully";
Redirect_to("categories.php");
}else{
$_SESSION["ErrorMessage"]= "OOPS! something went wrong";
Redirect_to("categories.php");
}
}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
   
  <title>Manage Categories</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="css/adminstyles.css">
	 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style>
.fieldinfo{
color:rgb(251,174,44);
font-family:Bitter,Georgia,"Times New Roman",Times,serif;
font-size:1.2em;

}

</style>
  </head>
  <body>
<div class="container-fluid">
<div class="row">
<div class="col-sm-2">
<nav class="nav nav-pills nav-stacked">
<ul id="side-menu" >
<a class="nav-link" href="dashboard.php">
<i class="fas fa-address-book"></i>
Dashboard</a>
<a class="nav-link" href="addnewpost.php"><i class="fas fa-angle-double-down"></i>&nbsp;Add New Post</a>
<a class="nav-link active" href="categories.php"><i class="fab fa-contao"></i>&nbsp;Categories</a>
<a class="nav-link" href="Admins.php"><i class="fab fa-adn"></i>&nbsp;Manage Admins</a>
<a class="nav-link" href="comments.php"><i class="fas fa-comments"></i>&nbsp;Comments</a>
<a class="nav-link" href="Blog.php"><i class="fa fa-anchor"></i>&nbsp;Live Blog</a>
<a class="nav-link" href="Logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

    </ul>
	</nav>

</div><!--Ending of side area-->
<div class="col-sm-10">
<h1>Manage Categories</h1>
<?php  echo Message(); 
 echo SuccessMessage(); ?>
<form action="categories.php" method="post">
<fieldset>
<div class="form-group">
<label for="categoryname"><span class="fieldinfo">Name:</span></label>
<input type="text"  class="form-control" name="category" id="categoryname"placeholder="Name">
</div>
<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
</fieldset>


</form>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
<th>Sr No</th>
<th> Date & time</th>
<th>Category Name</Th>
<th>Creator Name</th> 
<th>Action</th>
</tr>
<?php
global $connectingDB;
$Viewquery="select * from category order by datetime desc";
$execute=mysql_query($Viewquery);
$srno=0;
while($datarows=mysql_fetch_array($execute)){
$id=$datarows["id"];
$datetime=$datarows["datetime"];
$categoryname=$datarows["name"];
$creatorname=$datarows["creatorname"];
$srno++;
?>
<tr>
<td><?php echo $srno; ?></td>
<td><?php echo $datetime; ?></td>
<td><?php echo $categoryname; ?></td>
<td><?php echo $creatorname ; ?></td>
<td><a href="Deletecategory.php?id=<?php echo $id; ?>">
<span class="btn btn-danger">Delete</span>
</a> </td>
</tr>
<?php }?>
</table>


</div>


</div><!--Ending of main area-->


</div><!--ending of Row-->

</div><!--Ending of container fluid-->
  <div id="footer">
  <hr style=" background-color: red; ">
  <p>Theme By | Himanshu |&copy;2016-2019 All right reserved.
	<p>CSS Animations & Design for UI UX Designers. finally the best course for moderen deigner is out. after previous skillfull courses. 
	 </p>
	   <hr style=" background-color: red;  ">
	</div> 
	<div style="height:10px;background:#27AAE1;"></div>
    
  </body>
</html>