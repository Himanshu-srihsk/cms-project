<?php
session_start();
function Message()
{
if(isset($_SESSION["ErrorMessage"])){
$output="<div class=\"alert alert-danger\">";
$output.=htmlentities($_SESSION["ErrorMessage"]);
$output.="</div>";
return $output;
}

}
function SuccessMessage()
{
if(isset($_SESSION["SuccessMessage"])){
$output="<div class=\"alert alert-success\">";
$output.=htmlentities($_SESSION["ErrorMessage"]);
$output.="</div>";
return $output;
}

}


?>