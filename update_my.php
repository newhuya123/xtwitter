<?
error_reporting (E_ALL & ~E_NOTICE);

mysql_connect("localhost","xtwitter","xtwitter");
mysql_select_db("xtwitter");

$msg = $_REQUEST['message'];
if($msg != "")
	mysql_query("INSERT INTO messages (shout_at,content,user_id) VALUES(now(),'$msg',1);");

$result=mysql_query("SELECT * FROM messages where parent_id=0 order by shout_at desc");
$i=0;
?>

<?
while( $row=mysql_fetch_array($result) ){
	$result_child=mysql_query("SELECT * FROM messages where parent_id=".$row['id']." order by shout_at desc");
?>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<li onmouseover="javascript:showReply(<?= $row['id'] ?>);" onmouseout="javascript:hideReply(<?= $row['id'] ?>);"><?= $row['shout_at'] ?><a href="javascript:del('<?= $row['id'] ?>');">删除</a><br/><?= $row['content'] ?>
<form method="post" id="f_twitter_reply_<?= $row['id'] ?>" action="main.php" style="visibility:hidden;">
<label>回复：</label>
<input type="text" value="" name="reply">
<input type="submit" value="回复">
<input type="hidden" id="pid" name="pid" value="<?= $row['id'] ?>">
</form>

<ul>
<?
	while( $row_child=mysql_fetch_array($result_child) ){
?>
<li><?= $row_child['shout_at'] ?><a href="javascript:del('<?= $row_child['id'] ?>');">删除</a><br/><?= $row_child['content'] ?></li>
<?
	}
?>
</ul>
</li>
<?
}
?>

