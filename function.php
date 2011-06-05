<?
session_start();
mysql_connect("localhost","xtwitter","xtwitter");
mysql_select_db("xtwitter");

$_SESSION['lasterr'] = "";

function checklogin() {
	if(!$_SESSION['loginuser'])
		header("Location: error.php");
}
?>