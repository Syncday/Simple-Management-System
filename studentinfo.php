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
<body>
<?php
require "database.php";
$t = new database();
?>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加</strong></div>
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
        <th><input type="text" name="entitle" value="" /></th>
        <th><input type="text" name="entitle" value="" /></th>
        <th><input type="text" name="entitle" value="" /></th>
        <th><input type="text" name="entitle" value="" /></th>
        <th><input type="text" name="entitle" value="" /></th>
        <th><a class="button border-yellow" href=""><span class="icon-plus-square-o"></span> 添加</a></th>
      </tr>
    </table>
</div>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 学生信息表</strong></div>
  <table class="table table-hover text-center">
    <tr>
        <th width="5%">学号</th>     
        <th>姓名</th>  
        <th>性别</th>
        <th>专业</th>
        <th>班级</th>
      <th width="250">操作</th>
    </tr>
   
    <tr>
      <td>17</td>      
      <td>公司简介</td>  
      <td>1</td>      
      <td>
      <div class="button-group">
      <a type="button" class="button border-main" href="#"><span class="icon-edit"></span>修改</a>
       <a class="button border-red" href="javascript:void(0)" onclick="return del(17)"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr> 

  </table>
</div>
<script>
function del(id){
	if(confirm("您确定要删除吗?")){
		
	}
}
</script>
</body></html>