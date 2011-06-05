<?
error_reporting (E_ALL & ~E_NOTICE);

require "function.php";

$username = $_REQUEST['uname'];
$password1 = $_REQUEST['pass1'];
$password2 = $_REQUEST['pass2'];
$strSql="SELECT * FROM users where username='$username'";
$result1=mysql_query($strSql);
$row1=mysql_fetch_array($result1);
if($username=="") {
  	$info = '用户名和密码不能为空';
}
else if($password1!=$password2)
{
  	$info = '两次密码不一致';
}
else if($row1['username']==$username)
{
  	$info = '用户名已有';
}
else
{
    $email= $_REQUEST['mailadres'];
    $str = "INSERT INTO users (username,hashed_password,email) VALUES ('$username',md5('$password1'),'$email')";
    $result = mysql_query($str);
  	$info = 'check_ok';
}
?>
<? echo $info ?>
