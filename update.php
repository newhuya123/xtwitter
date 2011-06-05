<?
error_reporting (~E_ALL & ~E_NOTICE);

require "function.php";

$msg = $_REQUEST['message'];
//$emotionlist = array('惊喜'=>'2');s
$msg=eregi_replace( "\(疑问\)", ":1:",$msg);
$msg=eregi_replace( "\(惊喜\)", ":2:",$msg);
$msg=eregi_replace( "\(鄙视\)", ":3:",$msg);
$msg=eregi_replace( "\(呕吐\)", ":4:",$msg);
$msg=eregi_replace( "\(拜拜\)", ":5:",$msg);
$msg=eregi_replace( "\(大笑\)", ":6:",$msg);
$msg=eregi_replace( "\(求\)", ":7:",$msg);
$msg=eregi_replace( "\(色\)", ":8:",$msg);
$msg=eregi_replace( "\(撇嘴\)", ":9:",$msg);
$msg=eregi_replace( "\(调皮\)", ":10:",$msg);
$msg=eregi_replace( "\(流泪\)", ":11:",$msg);
$msg=eregi_replace( "\(偷笑\)", ":12:",$msg);
$msg=eregi_replace( "\(鲜花\)", ":13:",$msg);
$msg=eregi_replace( "\(流汗\)", ":14:",$msg);

$msg=eregi_replace( ":([0-9]{1,2}):", "<img src=image/facelist/\\1.gif>",$msg);
if($msg != "")
{
	$uid = $_SESSION['loginid'];
	$strSql = "INSERT INTO messages (shout_at,content,user_id) VALUES(now(),'$msg',$uid)";
	mysql_query($strSql);
}
$newID = mysql_insert_id();
$result=mysql_query("SELECT * FROM messages,users where users.id=messages.user_id and messages.id=$newID");
?>

<?
while( $row=mysql_fetch_array($result) ){
?>
<li class="unlight" style="">
	<a class="avatar" title="qqq" href="http://bentutu.com/me/index.php?s=/qqq">
		<img alt="qqq" src="uploads/avatar/noavatar.jpg">
	</a>
	<div class="">
		<div class="content">
			<a class="author " href="http://bentutu.com/me/index.php?s=/qqq"><?= $row['username']?></a>
			<h6>:</h6>
			<span id="cont<?= $row['id'] ?>"><?= $row['content'] ?></span>
		</div>
		<span class="stamp fleft">
			<a title="<?= $row['shout_at'] ?>" class="ctime" href="http://bentutu.com/me/index.php?s=/v/<?= $row['id'] ?>">
				<?= $row['shout_at'] ?>
			</a>
			&nbsp;通过网页&nbsp;&nbsp;
		</span>
		<span style="float: right; white-space: nowrap;" class="stamp op">
			<a onclick="delmsg('delmsg.php?s=<?= $row['id'] ?>','确实要删除此条广播吗?',this.parentNode.parentNode.parentNode,'')" href="javascript:void(0)">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a onclick="retwit('<?= $row['id'] ?>')" href="javascript:void(0)">转播</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a onclick="replyajax('<?= $row[0] ?>')" href="javascript:void(0)">评论
<? 
$sqlstring = "SELECT count(*) FROM messages where parent_id=".$row[0];
$count=mysql_query($sqlstring);
$count1=mysql_fetch_array($count);
?>
(<?=$count1[0]?>)
</a>&nbsp;&nbsp;|&nbsp;
			<a title="添加到我的收藏" onclick="dofavor('<?= $row['id'] ?>')" href="javascript:void(0)" class="fav">收藏</a>
		</span>
		<div class="clearline"></div>
		<span class="replyspan" id="reply_<?= $row[0] ?>"></span>
	</div>
</li>
<?
}
?>

