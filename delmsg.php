<?
error_reporting (E_ALL & ~E_NOTICE);

mysql_connect("localhost","xtwitter","xtwitter");
mysql_select_db("xtwitter");

$id = $_REQUEST['s'];
if($id != "") {
	mysql_query("DELETE from messages where parent_id=$id;");
	mysql_query("DELETE from messages where id=$id;");
?>
success
<?
}
else{
?>
删除失败，请指定id
<?
}
?>