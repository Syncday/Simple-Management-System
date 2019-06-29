<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>学生信息</title>  
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<?php
  include "database.php";
  $db = new database();
?>
<script>
window.addEventListener("load",load,false);
function load(){
  var xmlhttp;
  if (window.XMLHttpRequest)
  {
    // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    xmlhttp=new XMLHttpRequest();
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("showtable").innerHTML=xmlhttp.responseText;
    }
  }
  var url = "operation.php?type=load&table=student";
  xmlhttp.open("GET",url,true);
  xmlhttp.send();
}
</script>
<body>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加</strong></a></div>
    <table class="table table-hover text-center">
      <tr>
        <th width="5%">学号</th>     
          <th>姓名</th>
          <th>性别</th>
          <th>专业</th>
          <th>班级</th>
          <th width="250"></th>
      </tr>
      <tr>
        <th><input type="number" name="id" id="id" style="height:30px;text-align:center;"/></th>
        <th><input type="text" name="name" id="name" style="height:30px;text-align:center;"/></th>
        <th><input type="text" name="gender" id="gender" style="height:30px;text-align:center;"/></th>
        <th><input type="text" name="major" id="major" style="height:30px;text-align:center;"/></th>
        <th><input type="text" name="class" id="class" style="height:30px;text-align:center;"/></th>
        <th><a class="button border-yellow" href="javascript:void(0)" onclick="add()"><span class="icon-plus-square-o"></span>添加</a></th>
      </tr>
    </table>
</div>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 学生信息表</strong></div>
  <table class="table table-hover text-center">
    <tr>
        <th>学号</th>     
        <th>姓名</th>  
        <th>性别</th>
        <th>专业</th>
        <th>班级</th>
    </tr>
  </table>
</div> 
<div class="panel admin-panel">
    <div id="showtable"></div>
<div>
<script>
function add(str){
  var id =document.getElementById("id").value;
  var name = document.getElementById("name").value;
  var gender = document.getElementById("gender").value;
  var major = document.getElementById("major").value;
  var classA = document.getElementById("class").value;//变量名不能为class
  if(id==""||name==""||gender==""||major==""||classA==""){
      alert("不能为空");
  }else{
    var xmlhttp;
  if (window.XMLHttpRequest)
  {
    // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    xmlhttp=new XMLHttpRequest();
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("showtable").innerHTML=xmlhttp.responseText;
    }
  }
  var url = "operation.php?type=add&table=student&id="+id+"&name="+name+"&gender="+gender+"&major="+major+"&classA="+classA;
  xmlhttp.open("GET",url,true);
  xmlhttp.send();
  }
}
</script>
</body></html>