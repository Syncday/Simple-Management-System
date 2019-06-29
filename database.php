<?php
class database
{
    public $servername = "localhost";//数据库位置，一般是localhost
    public $username = "test";//用户名
    public $password = "123456";//密码
    public $mysql="";//数据库对象

    //构造函数，初始化
    public function __construct()
    {
        try {
            // 创建连接
            $mysql = new PDO("mysql:host=$this->servername", $this->username, $this->password);
        } catch (Exception $e) {
            die("登录数据库时出错，请检查用户名或密码!");
        }
        $this->init($mysql);
    }

    private function init($mysql)
    {
        // 创建数据库
        $sql = "CREATE DATABASE IF NOT EXISTS classschedule;";
        $mysql->exec($sql);
        $mysql=null;
        //使用数据库
        $databaseName = "classschedule";
        $mysql = new PDO("mysql:host=$this->servername;dbname=$databaseName", $this->username, $this->password);
        //全局数据库对象已改变
        $this->mysql=$mysql;
        // 设置 PDO 错误模式为异常 
        $this->mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //创建管理员表
        $sql="CREATE TABLE IF NOT EXISTS user(
            user_name VARCHAR(50) NOT NULL,
            user_password VARCHAR(50) NOT NULL,
            PRIMARY KEY (user_name)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);

        //创建学生信息表
        $sql="CREATE TABLE IF NOT EXISTS student(
            student_id INT NOT NULL,
            student_name VARCHAR(50) NOT NULL,
            student_gender VARCHAR(10) NOT NULL,
            student_major VARCHAR(50) NOT NULL,
            student_class VARCHAR(50) NOT NULL,
            PRIMARY KEY (student_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建教师信息表
        $sql="CREATE TABLE IF NOT EXISTS teacher(
            teacher_id INT NOT NULL,
            teacher_name VARCHAR(50) NOT NULL,
            teacher_gender VARCHAR(10) NOT NULL,
            teachert_professionaltitle VARCHAR(50) NOT NULL,
            teacher_education VARCHAR(50) NOT NULL,
            teachert_phone VARCHAR(50) NOT NULL,
            teachert_college VARCHAR(50) NOT NULL,
            PRIMARY KEY (teacher_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建授课表
        $sql="CREATE TABLE IF NOT EXISTS course(
            course_id INT NOT NULL,
            course_name VARCHAR(50) NOT NULL,
            course_credit DECIMAL NOT NULL,
            course_precourse VARCHAR(50) NOT NULL,
            course_type VARCHAR(10) NOT NULL,
            course_introduction VARCHAR(100) NOT NULL,
            PRIMARY KEY (course_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
    }

    /**
     * 创建管理员
     */
    public function creatUser($username, $password)
    {
        try {
            $stm=$this->mysql->prepare("insert into user values(?,?)");
            $data = array($username,md5($password));
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
