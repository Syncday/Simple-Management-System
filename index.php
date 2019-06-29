<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>大学排课管理系统</title>
    <meta name="keywords" content="简单,实用,网站后台,后台管理,管理系统,网站模板" />
    <meta name="description" content="简单实用网站后台管理系统网站模板下载。" /> 
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<?php
  session_start();
  if(!isset($_SESSION['isLogin'])){
    echo "<script>alert('您还没登录呢!')</script>";
    header('Refresh:0;url=login.html');
    die();
  }
?>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1>大学排课管理系统</h1>
  </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>管理</strong></div>
  <ul style="display:block">
    <li><a href="studentinfo.php" target="right"><span class="icon-caret-right"></span>学生信息</a></li>
    <li><a href="teacherinfo.html" target="right"><span class="icon-caret-right"></span>教师信息</a></li>
    <li><a href="courseinfo.html" target="right"><span class="icon-caret-right"></span>课程信息</a></li>  
    <li><a href="classinfo.html" target="right"><span class="icon-caret-right"></span>教室信息</a></li>   
    <li><a href="teachingmanage.html" target="right"><span class="icon-caret-right"></span>授课管理</a></li>     
    <li><a href="electivemanage.html" target="right"><span class="icon-caret-right"></span>选修管理</a></li>
  </ul>   
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  })
});
</script>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="studentinfo.php" name="right" width="100%" height="99%"></iframe>
</div>
</body>
</html>