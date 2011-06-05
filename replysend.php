<?
error_reporting (E_ALL & ~E_NOTICE);
require "function.php";
mysql_connect("localhost","xtwitter","xtwitter");
mysql_select_db("xtwitter");
$id = $_REQUEST['p'];
$reply = $_REQUEST['scont'];
if($id != "") {
    $uid = $_SESSION['loginid'];
	mysql_query("INSERT INTO messages (shout_at,content,user_id,parent_id) VALUES(now(),'$reply',$uid,$id);");
	//$result=mysql_query("SELECT * FROM messages where parent_id=$id order by shout_at desc limit 0,1");
	//$row=mysql_fetch_array($result);
	//$newID = mysql_insert_id();
	$sqlstring="SELECT * FROM messages,users where users.id=messages.user_id and parent_id=$id order by shout_at desc limit 0,1";
    $result=mysql_query($sqlstring);
	$row=mysql_fetch_array($result);
?>
            	<li class="lire" style="">
                <div class="images"><a href="http://bentutu.com/me/index.php?s=/qqq"><img width="30px" src="uploads/avatar/noavatar.jpg"></a></div>
                <div class="info">
                    <p><a href="http://bentutu.com/me/index.php?s=/qqq" class="username "><?= $row['username']?></a>
                    <span class="setgray">刚才&nbsp;&nbsp;通过网页&nbsp;<a onclick="delmsg('delmsg.php?s=<?= $row[0] ?>','确实要删除此条广播吗?',this.parentNode.parentNode.parentNode.parentNode)" class="fright" href="javascript:void(0)">删除</a></span></p>
                    <p><?= 	$reply ?></p>
                </div>
            	</li>

<?
}
else{
?>
删除失败，请指定id
<?
}
?>
