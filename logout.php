﻿
<?
error_reporting (E_ALL & ~E_NOTICE);

require "function.php";

$_SESSION['loginuser'] = '';

header("Location: index.htm");
?>
