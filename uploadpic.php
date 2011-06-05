<?
error_reporting (E_ALL & ~E_NOTICE);

require "function.php";
$uploadfile="uploads/".$_FILES['image']['name'];
if($_FILES['image']['type']!='image/bmp'&&$_FILES['image']['type']!='image/gif'&&$_FILES['image']['type']!='image/jpeg'&&$_FILES['image']['type']!='image/png'){
	$str=<<< HERE
		{"ret":"上传文件类型只可以为bmp,gif,jpeg,png"}
HERE;
	echo $str;
  exit;
}
if(move_uploaded_file($_FILES['image']['tmp_name'],$uploadfile)){
	$str=<<< HERE
		{"ret":"success","img":"$uploadfile","name":"$uploadfile","content":"图片已上传"}
HERE;
//	$str='{"ret":"success"}'; //,"img":"Beijing","street":" Chaoyang Road ","postcode":&ret}
	echo $str;
  exit;
}
$str="{ret:'上传失败'}";
echo $str;
?>