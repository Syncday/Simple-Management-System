<?php
    include "database.php";
    $db = new database();
    $result = $db->checkLogin($_POST['username'],$_POST['password']);
    if($result!=null){
        session_start();
        $_SESSION['isLogin']="TRUE";
        header('Refresh:0;url=index.php');
    }else{
        echo "<script>alert('登录失败！');window.location.href='login.html'</script>";
    }
?>