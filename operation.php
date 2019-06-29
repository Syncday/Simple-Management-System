<?php
   include "database.php";
   $db = new database();

//加载数据
   if ($_GET['type']=="load") {
       //加载学生
       if ($_GET['table']=="student") {
           $data = $db->getallstudent();
           echodata($data);
       }
   }

//添加
   if ($_GET['type']=="add") {
       //添加学生
       if ($_GET['table']=="student") {
           addstudent($db);
           $data = $db->getallstudent();
           echodata($data);
       }
   }

/**
 * 显示表，包括外观
 */
function echodata($result)
{
    echo "<table class='table table-hover text-center'>";
    foreach ($result as $row=>$key) {
        echo "<tr>";
        foreach ($key as $b) {
            echo "<td>".$b."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
/**
 * 添加学生
 */
function addstudent($db)
{
    $id = $_GET['id'];
    $name = $_GET['name'];
    $gender = $_GET['gender'];
    $major = $_GET['major'];
    $classA = $_GET['classA'];
    $db->addstudent($id, $name, $gender, $major, $classA);
}
