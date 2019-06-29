<?php
    include "database.php";
    $db = new database();
    $errorMsg = $db->creatUser($_POST['username'],$_POST['password']);
    if($errorMsg==null){
        echo "<script>alert('创建成功！请登录')</script>";
        header('Refresh:0;url=login.html');
    }else{
        echo "<script>alert('创建失败！');window.location.href='register.html'</script>";
        die();
    }
?>