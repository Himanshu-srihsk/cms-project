<?php require_once("Include/DB.php");?>
<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php
if(isset($_POST["Submit"]))
{
$username=mysql_real_escape_string($_POST["username"]);
$password=mysql_real_escape_string($_POST["password"]);
if(empty($username) || empty($password))
{
$_SESSION["ErrorMessage"]= "All fields are required *  ";
Redirect_to("Login.php");
}
else{
$found_account=Login_Attempt($username,$password);
$_SESSION["user_id"]=$found_account["id"];
$_SESSION["username"]=$found_account["username"];
if($found_account){
$_SESSION["SuccessMessage"]="Welcome {$_SESSION["username"]}";
Redirect_to("dashboard.php");

}else{
$_SESSION["ErrorMessage"]="Invalid  UserName/Password";
Redirect_to("Login.php");
}
}
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
   
  <title>Login page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="css/adminstyles.css">
	 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style type="text/css">
.fieldinfo{
color:rgb(251,174,44);
font-family:Bitter,Georgia,"Times New Roman",Times,serif;
font-size:1.2em;

}
body{
background:none;

}
.centered{
 margin: 0 auto;
    width:80%
}
html { 
  background: url(Image/backlogin.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

</style>
  </head>
  <body>
<div class="container-fluid">
<div class="row">

<div class="col-lg-5  centered">
<br><br>
<?php  echo Message(); 
 echo SuccessMessage(); ?>
<h1>Welcome Back</h1>

<form action="Login.php" method="post">
<fieldset>

<!--<div class="form-group">
      <label for="username"><span class="fieldinfo">UserName:</span></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
		  <input type="text"  class="form-control" name="username" id="username"placeholder="UserName">
        </div>
		</div>
		</div>-->
		<!--
<div class="form-group">

<label for="username"><span class="fieldinfo">UserName:</span></label>
<div class="input-group input-group-lg">
<span class="input-group-addon">
  @&nbsp;</span>
<input type="text"  class="form-control" name="username" id="username"placeholder="UserName">
</div>
 </div>
		
	

<div class="form-group">
<label for="password"><span class="fieldinfo">Password:</span></label>
<div class="input-group input-group-lg">
<span class="input-group-addon">
  @&nbsp;</span>
<input type="password"  class="form-control" name="password" id="password "placeholder="Password">
</div>
</div>
-->
<br><br>
<div class="col-auto">
      <label class="sr-only" for="username">Username</label>
      <div class="input-group input-group-lg mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
      </div>
    </div>
	
	<br>
	<div class="col-auto">
      <label class="sr-only" for="password">Password</label>
      <div class="input-group input-group-lg">
        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>
        <input type="password" class="form-control" id="password" name="password" placeholder="password">
      </div>
    </div>
	<br>
<input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
</fieldset>


</form>
<br>


</div><!--Ending of main area-->


</div><!--ending of Row-->

</div><!--Ending of container fluid-->
 
    
  </body>
</html>