<?php
   include "database.php";
   $db = new database();

//加载数据
   if ($_GET['type']=="load") {
       switch ($_GET['table']) {
        case "student":
            $data = $db->getallstudent();
            echodata($data);
            break;
        case "teacher":
            $data = $db->getallteacher();
            echodata($data);
            break;
        case "course":
            $data = $db->getallcourse();
            echodata($data);
            break;
        case "classroom":
            $data = $db->getallclassroom();
            echodata($data);
            break;
        case "teaching":
            $data = $db->getallteaching();
            echodata($data);
            break;
        case "elective":
            $data = $db->getallelective();
            echodata($data);
            break;
       }
   }
//分配
    if ($_GET['type']=="assign") {
        switch ($_GET['table']) {
            case "assignClassroom":
                $db->assignClassroom();
                $result = $db->getallassignClassroom();
                echodata($result);
                break;
            case "assignCurriculum":
               $result = $db->assignCurriculum();
                // = $db->getallassignCurriculum();
                echodata($result);
                break;
        }
    }
//添加
   if ($_GET['type']=="add") {
       switch ($_GET['table']) {
        case "student":
            $errorMsg = $db->addstudent($_GET['id'], $_GET['name'], $_GET['gender'], $_GET['major'], $_GET['classA']);
            echo $errorMsg;
            $data = $db->getallstudent();
            echodata($data);
            break;
        case "teacher":
            $errorMsg = $db->addteacher($_GET['id'], $_GET['name'], $_GET['gender'], $_GET['professionaltitle'], $_GET['education'], $_GET['phone'], $_GET['college']);
            echo $errorMsg;
            $data = $db->getallteacher();
            echodata($data);
            break;
        case "course":
            $errorMsg = $db->addcourse($_GET['id'], $_GET['name'], $_GET['credit'], $_GET['precourse'], $_GET['typeA'], $_GET['introduction']);
            echo $errorMsg;
            $data = $db->getallcourse();
            echodata($data);
            break;
        case "classroom":
            $errorMsg = $db->addclassroom($_GET['id'], $_GET['address'], $_GET['capacity'], $_GET['hasmedia']);
            echo $errorMsg;
            $data = $db->getallclassroom();
            echodata($data);
            break;
        case "teaching":
            $errorMsg = $db->addteaching($_GET['id'], $_GET['course'], $_GET['teacher'], $_GET['term'], $_GET['weekhour']);
            echo $errorMsg;
            $data = $db->getallteaching();
            echodata($data);
            break;
        case "elective":
            $errorMsg = $db->addelective($_GET['id'], $_GET['student'], $_GET['isreselect']);
            echo $errorMsg;
            $data = $db->getallelective();
            echodata($data);
            break;
    }
   }
//修改
   if ($_GET['type']=="update") {
       switch ($_GET['table']) {
        case "student":
            $result = $db->updatestudent($_GET['id'], $_GET['name'], $_GET['gender'], $_GET['major'], $_GET['classA']);
            echo $result;
            $data = $db->getallstudent();
            echodata($data);
            break;
        case "teacher":
            $result = $db->updateteacher($_GET['id'], $_GET['name'], $_GET['gender'], $_GET['professionaltitle'], $_GET['education'], $_GET['phone'], $_GET['college']);
            echo $result;
            $data = $db->getallteacher();
            echodata($data);
            break;
        case "course":
            $result = $db->updatecourse($_GET['id'], $_GET['name'], $_GET['credit'], $_GET['precourse'], $_GET['typeA'],$_GET['introduction']);
            echo $result;
            $data = $db->getallcourse();
            echodata($data);
            break;
        case "classroom":
            $result = $db->updateclassroom($_GET['id'], $_GET['address'], $_GET['capacity'], $_GET['hasmedia']);
            echo $result;
            $data = $db->getallclassroom();
            echodata($data);
            break;
        case "teaching":
            $result = $db->updateteaching($_GET['id'], $_GET['course'], $_GET['teacher'], $_GET['term'], $_GET['weekhour']);
            echo $result;
            $data = $db->getallteaching();
            echodata($data);
            break;
        case "elective":
            $result = $db->updateelective($_GET['id'], $_GET['student'], $_GET['isreselect']);
            echo $result;
            $data = $db->getallelective();
            echodata($data);
            break;
    }
   }
//删除
if ($_GET['type']=="del") {
    switch ($_GET['table']) {
        case "student":
            $result = $db->delstudent($_GET['id']);
            echo $result;
            $data = $db->getallstudent();
            echodata($data);
            break;
        case "teacher":
            $result = $db->delteacher($_GET['id']);
            echo $result;
            $data = $db->getallteacher();
            echodata($data);
            break;
        case "course":
            $result = $db->delcourse($_GET['id']);
            echo $result;
            $data = $db->getallcourse();
            echodata($data);
            break;
        case "classroom":
            $result = $db->delclassroom($_GET['id']);
            echo $result;
            $data = $db->getallclassroom();
            echodata($data);
            break;
        case "teaching":
            $result = $db->delteaching($_GET['id']);
            echo $result;
            $data = $db->getallteaching();
            echodata($data);
            break;
        case "elective":
            $result = $db->delelective($_GET['id'],$_GET['student']);
            echo $result;
            $data = $db->getallelective();
            echodata($data);
            break;
    }
}

/**
 * 显示表，包括外观
 */
function echodata($result)
{
    echo "<table class='table table-hover text-center' style='table-layout:fixed;'>";
    foreach ($result as $row=>$key) {
        echo "<tr>";
        foreach ($key as $b) {
            echo "<td>".$b."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
