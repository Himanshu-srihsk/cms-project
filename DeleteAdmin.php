<?php require_once("Include/session.php");?>
<?php require_once("Include/functions.php");?>
<?php require_once("Include/DB.php");?>
<?php
if(isset($_GET["id"])){
$connectingDB;
$idfromurl=$_GET["id"];
$execute=mysql_query("delete from registration where id='$idfromurl'");
if($execute){
$_SESSION["SuccessMessage"]= "Category Deleted successfully";
Redirect_to("Admins.php");
}else{
$_SESSION["ErrorMessage"]= "OOPS! something went wrong";
Redirect_to("Admins.php");
}

}



?>