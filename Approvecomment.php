<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php require_once("Include/DB.php");?>
<?php
if(isset($_GET["id"])){
$connectingDB;
$Admin=$_SESSION["username"];
$idfromurl=$_GET["id"];
$execute=mysql_query("update comments set status='ON',approvedBy='$Admin' where id='$idfromurl'");
if($execute){
$_SESSION["SuccessMessage"]= "Comment Approved successfully";
Redirect_to("comments.php");
}else{
$_SESSION["ErrorMessage"]= "OOPS! something went wrong";
Redirect_to("comments.php");
}

}



?>