<?php require_once("Include/DB.php");?>
<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php confirm_Login(); ?>
<?php
if(isset($_POST["Submit"]))
{
$title=mysql_real_escape_string($_POST["title"]);
$category=mysql_real_escape_string($_POST["category"]);
$post=mysql_real_escape_string($_POST["post"]);
date_default_timezone_set('Asia/Kolkata');
$datetime = date('m/d/Y h:i:s a', time());
$datetime;
//echo $datetime;
$Admin=$_SESSION["username"];
$image=$_FILES["image"]["name"];
$path="Upload/".basename($_FILES["image"]["name"]);
if(empty($title))
{
$_SESSION["ErrorMessage"]= "Title cannot be Empty";
Redirect_to("addnewpost.php");
}
elseif(strlen($title)<2){
$_SESSION["ErrorMessage"]= "Title should be at least two character long";
Redirect_to("addnewpost.php");
}
else{
global $connectingDB;
$Editfromurl=$_GET['edit'];
$execute=mysql_query("update adminpanel set datetime='$datetime',title='$title',category='$category',author='$Admin',image='$image',post='$post' where id='$Editfromurl'");
move_uploaded_file($image=$_FILES["image"]["tmp_name"],$path);
if($execute){
$_SESSION["SuccessMessage"]= "Post Updated successfully";
Redirect_to("addnewpost.php");
}else{
$_SESSION["ErrorMessage"]= "OOPS! something went wrong";
Redirect_to("addnewpost.php");
}
}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
   
  <title>Edit Post</title>
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
<a class="nav-link" href="#"><i class="fas fa-angle-double-down"></i>&nbsp;Add New Post</a>
<a class="nav-link " href="categories.php"><i class="fab fa-contao"></i>&nbsp;Categories</a>
<a class="nav-link active" href="addnewpost.php"><i class="fab fa-accusoft"></i>&nbsp;Add New Post</a>
<a class="nav-link" href="#"><i class="fab fa-adn"></i>&nbsp;Manage Admins</a>
<a class="nav-link" href="#"><i class="fas fa-comments"></i>&nbsp;Comments</a>
<a class="nav-link" href="#"><i class="fa fa-anchor"></i>&nbsp;Live Blog</a>
<a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

    </ul>
	</nav>

</div><!--Ending of side area-->
<div class="col-sm-10">
<h1>Update Post</h1>
<?php  echo Message(); 
 echo SuccessMessage(); ?>

 <?php
 $connectingDB;
 $searchqueryparameter=$_GET['edit'];
 $query="select * from adminpanel where id='$searchqueryparameter'";
 $execute=mysql_query($query);
 while($datarows=mysql_fetch_array($execute)){
$titleupdate=$datarows["title"];
$categoryupdate=$datarows["category"];
 $imageupdate=$datarows["image"];
 $postupdate=$datarows["post"];
 
 }
 ?>
<form action="Editpost.php?edit=<?php  echo $searchqueryparameter ?>" method="post" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
<label for="title"><span class="fieldinfo">Title:</span></label>
<input type="text"  class="form-control" name="title" id="title"placeholder="Title" value="<?php echo $titleupdate;?>">
</div>
<div class="form-group">
<label for="categoryselect"><span class="fieldinfo">Existing Category:</span></label>
<?php
echo $categoryupdate ?>
<br>
<label for="categoryselect"><span class="fieldinfo">Category:</span></label>
<select class="form-control" id="categoryselect" name="category">
<?php
global $connectingDB;
$Viewquery="select * from category order by datetime desc";
$execute=mysql_query($Viewquery);
while($datarows=mysql_fetch_array($execute)){
$id=$datarows["id"];
$categoryname=$datarows["name"];
?>
<option><?php echo $categoryname;?>
<?php } ?>
</select>
</div>
<div class="form-group">
<label for="imageselect"><span class="fieldinfo">Existing Image:</span></label>
<img src="Upload/<?php echo $imageupdate; ?> " width=170px; height=70px;>
<br>
<label for="imageselect"><span class="fieldinfo">Select Image:</span></label>
<input type="file" class="form-control" name="image" id="imageselect">
</div>
<div class="form-group">
<label for="postarea"><span class="fieldinfo">Post:</span></label>
<textarea class="form-control" name="post" id="postarea">
<?php
echo $postupdate;
?>
</textarea>
<br><br>
<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post">
</fieldset>


</form>
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