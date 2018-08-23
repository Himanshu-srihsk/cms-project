<?php require_once("Include/DB.php");?>
<?php require_once("Include/session.php");?>
<?php
function Redirect_to($New_Location){
header("Location:$New_Location");
exit;

}
function Login_Attempt($username,$password){
$query="select * from registration where username='$username' and password='$password'";
$execute=mysql_query($query);
if($admin=mysql_fetch_assoc($execute)){
return $admin;
}else{
return null;
}
}
function Login(){
if(isset($_SESSION["user_id"])){
return true;}
}

function confirm_Login(){
if(!Login()){
$_SESSION["ErrorMessage"]= "Login required *  ";
Redirect_to("Login.php");
}

}

?>