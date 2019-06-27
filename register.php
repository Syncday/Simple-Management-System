<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录</title>
<style type="text/css">
*{
	margin: 0;
	padding: 0;
}
#head {
	height: 120px;
	width: 100;
	background-color: #66CCCC;
	text-align: center;
	position: relative;
}
#wrap .logGet {
	height: 120px;
	width: 368px;  
	position: absolute;
    align: center;
	background-color: #FFFFFF;
	top: 20%;
	left: 35%;
}
.logC input {
	width: 100%;
	height: 45px;
	background-color: #ee7700;
	border: none;
	color: white;
	font-size: 18px;
}
.logGet .logD.logDtip .p1 {
	display: inline-block;
	font-size: 28px;
	margin-top: 30px;
	width: 86%;
}
#wrap .logGet .logD.logDtip {
	width: 86%;
	border-bottom: 1px solid #ee7700;
	margin-bottom: 60px;
	margin-top: 0px;
	margin-right: auto;
	margin-left: auto;
}
.logGet .lgD img {
	position: absolute;
	top: 12px;
	right: 8px;
}
.logGet .lgD input {
	width: 100%;
	height: 42px;
	text-indent: 2.5rem;
}
#wrap .logGet .lgD {
	width: 86%;
	position: relative;
	margin-bottom: 30px;
	margin-top: 30px;
	margin-right: auto;
	margin-left: auto;
}
#wrap .logGet .logC {
	width: 86%;
	margin-top: 0px;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
}
.title {
	font-family: "宋体";
	color: #FFFFFF;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);  /* 使用css3的transform来实现 */
	font-size: 36px;
	height: 40px;
	width: 30%;
}
</style>
</head>
<body>
<div class="header" id="head">
  <div class="title">大学排课管理系统</div>
</div>
<div class="wrap" id="wrap">
	<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">注册</p>
			</div>
			<!-- 输入框 -->
			<form action="" method="post" name="myform">
			<div class="lgD">
				<img src="img/logName.png" width="20" height="20" alt=""/>
				<input type="text" name="username"
					placeholder="输入用户名" />
			</div>
			<div class="lgD">
				<img src="img/logPwd.png" width="20" height="20" alt=""/>
				<input type="text" name="password"
					placeholder="输入用户密码" />
			</div>
			<div class="logC">
				<input type="submit" name= "submit" value="注 册">
			</div>
			</form>
		</div>
</div>
</body>
</html>
<?php
if (!empty($_POST['submit'])&&$_POST["submit"]!="") {	
    $host='localhost';
    $username='test';
    $password='123456';
    $database='test';
    $mysqli=new mysqli($host, $username, $password, $database);
	if ($mysqli) {
		$sql="create table admin(
			username char(20) not null,
			password varchar(50) not null,
			primary key(username))";
		$mysqli->query($sql);//创建注册信息数据库
		$sql="alter table tablename convert to character SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
		$mysqli->query($sql);
		$username=$_POST['username'];
		$password=$_POST['password'];
		$sql="insert into admin(username,password) values($username,md5($password));";
		$mysqli->query($sql);
		echo $mysqli->error;

	}
}
?>