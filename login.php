
<?
error_reporting (E_ALL & ~E_NOTICE);

require "function.php";

$username = $_REQUEST['loginname'];
$password = $_REQUEST['password'];

$str = "SELECT * FROM users where username='$username' and hashed_password=md5('$password')";
$result = mysql_query($str);
$ary = mysql_fetch_array($result);

if ($ary) {
	$_SESSION['loginuser'] = $username;
	$_SESSION['loginid'] = $ary['id'];
	$url = "main.php";
} else
	$url = "error.php";

header("Location: $url");

?>
