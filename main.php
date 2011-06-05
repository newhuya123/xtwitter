
<?
error_reporting (E_ALL & ~E_NOTICE);

require "function.php";

checklogin();

$reply = $_REQUEST['reply'];
$pid = $_REQUEST['pid'];
if($reply != "")
	mysql_query("INSERT INTO messages (shout_at,content,user_id,parent_id) VALUES(now(),'$reply',1,$pid);");
else {
	$tid = $_REQUEST['tid'];
	if($tid != "")
		mysql_query("DELETE from messages where id=$tid;");
	else {
		$msg = $_REQUEST['message'];
		if($msg != "")
			mysql_query("INSERT INTO messages (shout_at,content,user_id) VALUES(now(),'$msg',1);");
	}
}
$result=mysql_query("SELECT * FROM messages,users where users.id=messages.user_id and messages.parent_id=0 order by shout_at desc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="Bentutu，Ubuntu,Linux,微博" />
<meta name="description" content="中国Ubuntu和Linux用户微博平台，快乐分享业界资讯！" />
<title><?= $_SESSION['loginuser']?>_Bentutu ME - 中国Ubuntu和Linux用户微博平台</title>
<link rel="shortcut icon" href="http://bentutu.com/me/Public/images/favicon.ico" />
<script type="text/javascript">var etuser='{"siteurl":"./xtwitter/","pubdir":"http://bentutu.com/me/Public","setok":"-1","my_uid":"21","user_name":"<?= $_SESSION['loginuser']?>","nickname":"<?= $_SESSION['loginuser']?>","space":"home"}';var stalk='1';</script>
<script type="text/javascript" src="./javascript/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="./javascript/common.js"></script>
<script type="text/javascript" src="./javascript/extends.js"></script>
<script type="text/javascript" src="./javascript/ye_dialog.js"></script>
<link rel="stylesheet" type="text/css" href="./style/bentutu.css" />
<!--[if lte IE 6]>
<style type="text/css">
#header .left{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='image',src='http://bentutu.com/me/Public/images/logo.png');background:none;cursor:pointer}
#header .topmenubg{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='image',src='http://bentutu.com/me/Public/images/topmenu.png');background:none;}
#navbg {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true', sizingMethod='scale',src='http://bentutu.com/me/Public/images/headbg.png');background:none;}
#sidebar .homestabs .menu li .arrHover{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=image,src='http://bentutu.com/me/Public/images/sidemenuArr_over.png');background:none;}
#sidebar .homestabs .menu li .arrCurt{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=image,src='http://bentutu.com/me/Public/images/sidemenuArr.png');background:none}
#sidebar .sect {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=scale, src='http://bentutu.com/me/Public/images/dot.png');background:none;}
.newst {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=image,src='http://bentutu.com/me/Public/images/newst.png');background:none;}
</style>
<![endif]-->
<style type="text/css">body {}</style>
</head>

<body>
<div id="navbg"></div>
<div id="container" class="newlook">
<div id="header">
    <div id="navigation">
        <ul>
                    <li ><a href="http://bentutu.com/me/index.php?s=/Pub">广播大厅</a></li>
            <li ><a href="http://bentutu.com/me/index.php?s=/Hot">排行榜</a></li>
            <li ><a href="http://bentutu.com/me/index.php?s=/Find">找朋友</a></li>
            <li ><a href="http://bentutu.com/me/index.php?s=/Find/invite">邀请</a></li>
                        <li id="plugins"><a class="nohover" href="javascript:void(0);">工具<span class="arr_d"><em class="b1">&nbsp;</em><em class="b2">&nbsp;</em><em class="b3">&nbsp;</em></span></a>
            <div class="subNav" style="display:none;">
            <p><a href="http://bentutu.com/me/index.php?s=/Plugins/map">地图微博</a></p>            <p><a href="http://bentutu.com/me/index.php?s=/Plugins">博客挂件</a></p>            <p><a href="http://bentutu.com/me/m">手机WAP</a></p>            </div>
            </li>
                        <li class="fright"><a href="logout.php">退出</a></li>
                        <li class="fright "><a href="http://bentutu.com/me/index.php?s=/Message/inbox">私信</a> | </li>
            <li class="fright "><a href="http://bentutu.com/me/index.php?s=/Setting/theme">模板</a></li>
            <li class="fright "><a href="http://bentutu.com/me/index.php?s=/Setting">设置</a></li>
            <li class="fright "><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/profile"><?= $_SESSION['loginuser']?></a></li>
                </ul>
    </div>
    <a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>">
    <div class="left"></div></a>
                    <div class="topmenubg"></div>
        <div class="topmenu">
            <ul>
                <li class="selected"><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>">我的首页</a> | </li>
                <li ><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/profile">我的微博</a> | </li>
                <li ><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/following">关系</a></li>
                <li>
                    <div id="searchr">
                        <select id="commonsearch" class="select"><option value="talk">广播</option><option value="user">用户</option></select>
                        <input type="text" id="searchr-input" name="q" value="请输入关键字" onfocus="this.value=''" onkeydown= "if(event.keyCode==13){dosearch()}"/>
                        <input type="button" id="searchr-submit" value="搜 索" onclick="dosearch();" />
                    </div>
                </li>
            </ul>
        </div>
    </div>
<table id="columns">
<tr>
<td id="main">
    <div id="infohead">
        <div class="hometip">来，说说你在做什么，想什么：</div>
        <textarea id="contentbox" class="input_text headtextarea" onkeydown="javascript:return ctrlEnter_st(event);"></textarea>
        <div class="sendbox">
        <div id="uploadbox">
            <div id="emotion"></div>
            <div class="topic"><a href="javascript:void(0);" onclick="Sharetopic()">话题</a></div>
            <div class="video"><a href="javascript:void(0);">视频</a>
            <div id="sharevideo">
                <p>请直接在微博发布框粘贴视频播放页面URL地址，或MP3/WMA音乐文件地址</p>
	            <p>支持如下视频的站内播放：<a href="http://video.sina.com.cn/" rel="nofollow" target="_blank">新浪</a>、<a href="http://www.youku.com/" rel="nofollow" target="_blank">优酷</a>、<a href="http://v.blog.sohu.com/" rel="nofollow" target="_blank">搜狐</a>、<a href="http://www.ku6.com/" rel="nofollow" target="_blank">酷6</a>、<a href="http://www.tudou.com/" rel="nofollow" target="_blank">土豆</a>、<a href="http://tv.mofile.com/" rel="nofollow" target="_blank">魔方</a></p>
            </div></div>
            <div class="emos"><a href="javascript:void(0);" onclick="showemotion('emotion','contentbox')">表情</a></div>
            <div class="photo"><a href="javascript:void(0);">照片</a>
            <div id="sharephoto">
                <div id="loadform" style="display:block">
                    <div id="closephoto"></div>
                    请选择要上传的图片：
                    <form target="imageUpload" method="post" enctype="multipart/form-data" action="uploadpic.php" id="upform">
                        <input type="file" id="uploadbtn" class="uploadbtn" name="image" title="支持jpg、jpeg、gif、png格式，文件小于2M"/>
                    <input type="hidden" name="__hash__" value="c90eb98f980e83a6e12ef53fe8731880" /></form>
                </div>
                <div id="priviewbtn"></div>
                <div id="uploading"><img src='http://bentutu.com/me/Public/images/spinner.gif'> 上传中 <a href='javascript:void(0)' onclick='cencelUpload();'>[取消]</a></div>
                <div class="clearline"></div>
                <div id="priviewpoic"></div>
            </div>
            </div>
            <iframe style="display:none;" src="about:blank" name="imageUpload" id="imageUpload"></iframe>
            <span id="morecontent" style="display:none;"></span>
        </div>
        <div class="fright">
            <div class="sendtip"><span class="sendsp">还能输入<span id="nums">140</span>字</span></div>
            <input type="button" class="sendbutton" onclick="sendTalk()" value=""/>
        </div>
        </div>
    </div>
    <div class="contenter">
        <div class="hometitle">
                    <span class="mine">所有广播</span>
                <div class="fright">
            查看类型：
            <select id="lookmore">
            <option value="a">所有广播</option>
            <option value="p">图片广播</option>
            <option value="m">媒体广播</option>
            <option value="o">原创广播</option>
            <option value="r">转播广播</option>
            </select>
        </div>
        </div>
        <div id="stream" class="message">
            <ol class="wa">
<? while( $row=mysql_fetch_array($result) ){ ?>
              <li class="unlight">
              	<a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>" title="<?= $_SESSION['loginuser']?>" class="avatar">
              		<img src="uploads/avatar/noavatar.jpg" alt="<?= $_SESSION['loginuser']?>" />
              	</a>
              	<div class="">
              		<div class="content">
              			<a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>" class="author "><?= $row['username']?></a>
              			<h6>:</h6>
              			<span id="cont136"><?= $row['content'] ?></span>
              		</div>
              		<span class="stamp fleft">
              			<a href="http://bentutu.com/me/index.php?s=/v/136" class="ctime" title="<?= $row['shout_at'] ?>"><?= $row['shout_at'] ?></a>&nbsp;通过网页&nbsp;&nbsp;
              		</span>
              		<span class="stamp op" style="float:right;white-space:nowrap">
              			<a href="javascript:void(0)" onclick="delmsg('delmsg.php?s=<?= $row[0] ?>','确实要删除此条广播吗?',this.parentNode.parentNode.parentNode,'')">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              			<a href="javascript:void(0)" onclick="retwit('136')">转播</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              			<a href="javascript:void(0)" onclick="replyajax('<?= $row[0] ?>')">评论
<? 
$sqlstring = "SELECT count(*) FROM messages where parent_id=".$row[0];
$count=mysql_query($sqlstring);
$count1=mysql_fetch_array($count);
?>
(<?=$count1[0]?>)
</a>&nbsp;&nbsp;|&nbsp;
              			<a class="fav" href="javascript:void(0)" onclick="dofavor('136')" title="添加到我的收藏">收藏</a>
              		</span>
              		<div class="clearline"></div>
              		<span id="reply_<?= $row[0] ?>" class="replyspan"></span>
              	</div>
              </li>  
<? } ?>                      
            </ol>
        </div>
    </div>
</td>
<td id="sidebar" rowspan="2"><div class="contenter">
    <div class="sect first-sect" style="margin-bottom:0px">
        <div class="fleft" style="width:60px"><a href="http://bentutu.com/me/index.php?s=/Setting/face" title="修改头像"><img src="uploads/avatar/noavatar.jpg" width="50px" height="50px" alt="<?= $_SESSION['loginuser']?>" class="imgborder"></a></div>
        <div class="fleft">
            <p style="font-size:14px"><span class=""><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/profile"><?= $_SESSION['loginuser']?></a></span><p>
            <p>山东省 济宁<p>
        </div>
        <table class="sidetable">
            <tr style="line-height:100%">
                <td class="tz"><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/follower"><p><b>0</b></p><p>听众</p></a></td>
                <td class="st"><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/following"><p><b>0</b></p><p>收听</p></a></td>
                <td class="gb"><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/mine"><p><b id="mymsgnum">
<? 
$sqlstring = "SELECT count(*) FROM messages where parent_id=0";
$count=mysql_query($sqlstring);
$count1=mysql_fetch_array($count);
?>
<?=$count1[0]?>
				</b></p><p>广播</p></a></td>
            </tr>
        </table>
            </div>

    <div class="homestabs">
        <ul class="menu">
            <li><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>" class="home curt">我的主页</a><b class="arr arrCurt"></b></li>
            <li><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/mine" class="mytalk">我的广播</a><b class="arr"></b></li>
            <li><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/at" class="at">提到我的</a><b class="arr"></b></li>
            <li><a href="http://bentutu.com/me/index.php?s=/<?= $_SESSION['loginuser']?>/favor" class="favor">我的收藏</a><b class="arr"></b></li>
            <li><a href="http://bentutu.com/me/index.php?s=/Comments" class="comments">我的评论</a><b class="arr"></b></li>
            <li><a href="http://bentutu.com/me/index.php?s=/Message/inbox" class="pmsg">私 信</a><b class="arr"></b></li>
        </ul>
    </div>

    <div class="clearline"></div>
    
    
    <!-- 用户侧边 -->
    <div class="sect "><h2>意见反馈</h2>众人拾柴火焰高，如您有任何建议欢迎点发表#意见反馈#告诉我们。</div></div></td>
</tr>
<tr>
<td height="36px">
    <div id="indexpage" class="page"><span class="disabled">&lsaquo;</span><span class="disabled">&rsaquo;</span></div>
</td>
</tr>
</table>
<script type="text/javascript">
    $("#contentbox").focus(function(){$("#contentbox").css({border: "1px solid #7bd6f6" });});
    $("#contentbox").blur(function(){$("#contentbox").css({border: "1px solid #b3b3b3" });});
    $("#contentbox").focus();
        $("#lookmore").val('a');
</script>
    <a id="reportbutton" href="javascript:void(0)" onclick="reportbox()"></a></div>
<div class="bottomLinks">
    <div class="bL_List">
        <div class="bL_info">  
        <h4>找找感兴趣的人</h4>
        <ul>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Find">找朋友</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Hot">达人排行榜</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Hot?c=山东省">同城达人榜</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Find/invite">邀请好友加入</a></li>
        </ul>
        </div>
        <div class="bL_info">  
        <h4>大家正在说什么</h4>
        <ul>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Pub">广播大厅</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Pub?t=hot">热门广播</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Pub?t=city&c=济宁">同城广播</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Topic">热门话题榜</a></li>
        </ul>
        </div>
        <div class="bL_info bL_io3">  
        <h4>微博更多玩法</h4>
        <ul>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/m">手机登陆</a></li>
            <li class="MIB_linkar"><a href="##">短信更新</a></li>
            <li class="MIB_linkar"><a href="##">下载客户端</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Setting/theme">设置个性模版</a></li>
        </ul>
        </div>
        <div class="bL_info bL_io4">  
        <h4>认证&合作</h4>
        <ul>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Index/vip">微博认证</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Index/about">关于我们</a></li>
            <li class="MIB_linkar"><a href="http://bentutu.com/me/index.php?s=/Index/faq">新手帮助</a></li>
            <li class="MIB_linkar">统计代码</li>
        </ul>
        </div>
    </div>
</div>
<div class="gotop"><button onclick="indextop();" title="返回顶部"><span>返回顶部</span></button></div>
<script type="text/javascript">$(document).ready(function(){$('#footer').append('<a href="http://www.miibeian.gov.cn" target="_blank">正在备案...</a>')});</script>
</body>
</html>