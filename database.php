<?php
class database
{
    public $servername = "localhost";//数据库位置，一般是localhost
    public $username = "test";//用户名
    public $password = "123456";//密码
    public $mysql="";//全局数据库对象

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
            student_id  VARCHAR(20) NOT NULL,
            student_name VARCHAR(50) NOT NULL,
            student_gender VARCHAR(10) NOT NULL,
            student_major VARCHAR(50) NOT NULL,
            student_class VARCHAR(50) NOT NULL,
            PRIMARY KEY (student_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建教师信息表
        $sql="CREATE TABLE IF NOT EXISTS teacher(
            teacher_id VARCHAR(20) NOT NULL,
            teacher_name VARCHAR(50) NOT NULL,
            teacher_gender VARCHAR(10) NOT NULL,
            teachert_professionaltitle VARCHAR(50) NOT NULL,
            teacher_education VARCHAR(50) NOT NULL,
            teachert_phone VARCHAR(50) NOT NULL,
            teachert_college VARCHAR(50) NOT NULL,
            PRIMARY KEY (teacher_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建课程表
        $sql="CREATE TABLE IF NOT EXISTS course(
            course_id VARCHAR(20) NOT NULL,
            course_name VARCHAR(50) NOT NULL,
            course_credit DECIMAL NOT NULL,
            course_precourse VARCHAR(50) NOT NULL,
            course_type VARCHAR(10) NOT NULL,
            course_introduction VARCHAR(100) NOT NULL,
            PRIMARY KEY (course_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建教室表
        $sql="CREATE TABLE IF NOT EXISTS classroom(
            classroom_id VARCHAR(20) NOT NULL,
            classroom_address VARCHAR(50) NOT NULL,
            classroom_capacity INT NOT NULL,
            classroom_hasmedia VARCHAR(10) NOT NULL,
            PRIMARY KEY (classroom_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建授课表
        $sql="CREATE TABLE IF NOT EXISTS teaching(
            teaching_id VARCHAR(20) NOT NULL,
            teaching_course VARCHAR(20) NOT NULL,
            teaching_teacher VARCHAR(20) NOT NULL,
            teaching_term VARCHAR(20) NOT NULL,
            teaching_weekhour DECIMAL NOT NULL,
            PRIMARY KEY (teaching_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建选修表
        $sql="CREATE TABLE IF NOT EXISTS elective(
            elective_id VARCHAR(20) NOT NULL,
            elective_student VARCHAR(20) NOT NULL,
            elective_isreselect VARCHAR(20) NOT NULL,
            PRIMARY KEY (elective_id,elective_student)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $mysql->exec($sql);
        //创建分配教室表
        $sql="CREATE TABLE IF NOT EXISTS assignClassroom(
            assignClassroom_teaching VARCHAR(20) NOT NULL,
            assignClassroom_studentcount VARCHAR(20) NOT NULL,
            assignClassroom_class VARCHAR(20) NOT NULL,
            assignClassroom_classcapacity VARCHAR(20) NOT NULL,
            PRIMARY KEY (assignClassroom_teaching)
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
    /**
     * 登录检测
     */
    public function checkLogin($username, $password)
    {
        try {
            $stmt = $this->mysql->prepare("select user_name from user where user_name=? and user_password=?");
            $data=array($username,md5($password));
            $stmt->execute($data);
            $result = $stmt->fetchAll();
            $stmt = NULL;
            if($result==null){
                return NULL;
            }else{
                return $result;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 获取全部学生数据
     */
    public function getallstudent()
    {
        try {
            $stmt = $this->mysql->prepare("select * from student");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
        /**
     * 获取全部教师数据
     */
    public function getallteacher()
    {
        try {
            $stmt = $this->mysql->prepare("select * from teacher");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
        /**
     * 获取全部课程数据
     */
    public function getallcourse()
    {
        try {
            $stmt = $this->mysql->prepare("select * from course");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
       /**
     * 获取全部教室数据
     */
    public function getallclassroom()
    {
        try {
            $stmt = $this->mysql->prepare("select * from classroom");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 获取全部授课数据
     */
    public function getallteaching()
    {
        try {
            $stmt = $this->mysql->prepare("select * from teaching");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 获取全部选修数据
     */
    public function getallelective()
    {
        try {
            $stmt = $this->mysql->prepare("select * from elective");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 获取教室分配数据
     */
    public function getallassignClassroom()
    {
        try {
            $stmt = $this->mysql->prepare("select * from assignClassroom");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    
    /**
     * 添加学生数据
     */
    public function addstudent($id,$name,$gender,$major,$class){
        try {
            $stm=$this->mysql->prepare("insert into student values(?,?,?,?,?)");
            $data = array($id,$name,$gender,$major,$class);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 修改学生数据
     */
    public function updatestudent($id,$name,$gender,$major,$class){
        try {
            $stm=$this->mysql->prepare("update student set student_name=?,student_gender=?,student_major=?,student_class=? where student_id=?");
            $data = array($name,$gender,$major,$class,$id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 删除学生数据
     */
    public function delstudent($id){
        try {
            $stm=$this->mysql->prepare("delete from student where student_id=?");
            $data = array($id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 添加教师数据
     */
    public function addteacher($id,$name,$gender,$professionaltitle,$education,$phone,$college){
        try {
            $stm=$this->mysql->prepare("insert into teacher values(?,?,?,?,?,?,?)");
            $data = array($id,$name,$gender,$professionaltitle,$education,$phone,$college);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 修改教师数据
     */
    public function updateteacher($id,$name,$gender,$professionaltitle,$education,$phone,$college){
        try {
            $stm=$this->mysql->prepare("update teacher set teacher_name=?,teacher_gender=?,teachert_professionaltitle=?,teacher_education=?,teachert_phone=?,teachert_college=? where teacher_id=?");
            $data = array($name,$gender,$professionaltitle,$education,$phone,$college,$id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 删除教师数据
     */
    public function delteacher($id){
        try {
            $stm=$this->mysql->prepare("delete from teacher where teacher_id=?");
            $data = array($id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 添加课程数据
     */
    public function addcourse($id,$name,$credit,$precourse,$typeA,$introduction){
        try {
            $stm=$this->mysql->prepare("insert into course values(?,?,?,?,?,?)");
            $data = array($id,$name,$credit,$precourse,$typeA,$introduction);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 修改课程数据
     */
    public function updatecourse($id,$name,$credit,$precourse,$typeA,$introduction){
        try {
            $stm=$this->mysql->prepare("update course set course_name=?,course_credit=?,course_precourse=?,course_type=?,course_introduction=? where course_id=?");
            $data = array($name,$credit,$precourse,$typeA,$introduction,$id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 删除课程数据
     */
    public function delcourse($id){
        try {
            $stm=$this->mysql->prepare("delete from course where course_id=?");
            $data = array($id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 添加教室数据
     */
    public function addclassroom($id,$address,$capacity,$hasmedia){
        try {
            $stm=$this->mysql->prepare("insert into classroom values(?,?,?,?)");
            $data = array($id,$address,$capacity,$hasmedia);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 修改教室数据
     */
    public function updateclassroom($id,$address,$capacity,$hasmedia){
        try {
            $stm=$this->mysql->prepare("update classroom set classroom_address=?,classroom_capacity=?,classroom_hasmedia=? where classroom_id=?");
            $data = array($address,$capacity,$hasmedia,$id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 删除教室数据
     */
    public function delclassroom($id){
        try {
            $stm=$this->mysql->prepare("delete from classroom where classroom_id=?");
            $data = array($id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 添加授课数据
     */
    public function addteaching($id,$course,$teacher,$term,$weekhour){
        try {
            $stm=$this->mysql->prepare("insert into teaching values(?,?,?,?,?)");
            $data = array($id,$course,$teacher,$term,$weekhour);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 修改授课数据
     */
    public function updateteaching($id,$course,$teacher,$term,$weekhour){
        try {
            $stm=$this->mysql->prepare("update teaching set teaching_course=?,teaching_teacher=?,teaching_term=?,teaching_weekhour=? where teaching_id=?");
            $data = array($course,$teacher,$term,$weekhour,$id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 删除授课室数据
     */
    public function delteaching($id){
        try {
            $stm=$this->mysql->prepare("delete from teaching where teaching_id=?");
            $data = array($id);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 添加选修数据
     */
    public function addelective($id,$student,$isreselect){
        try {
            $stm=$this->mysql->prepare("insert into elective values(?,?,?)");
            $data = array($id,$student,$isreselect);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 修改选修数据
     */
    public function updateelective($id,$student,$isreselect){
        try {
            $stm=$this->mysql->prepare("update elective set elective_isreselect=? where elective_id=? and elective_student=?");
            $data = array($isreselect,$id,$student);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 删除选修数据
     */
    public function delelective($id,$student){
        try {
            $stm=$this->mysql->prepare("delete from elective where elective_id=? and elective_student=?");
            $data = array($id,$student);
            $stm->execute($data);
            $stm=null;
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 分配教室
     */
    public function assignClassroom(){
        try {
            //清除分配数据库
            $this->mysql->exec("delete from assignClassroom");
            $stmt = $this->mysql->prepare("SELECT elective_id,count(1) AS counts FROM elective GROUP BY elective_id ORDER BY counts DESC");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt = $this->mysql->prepare("SELECT classroom_address,classroom_capacity FROM classroom  ORDER BY classroom_capacity DESC");
            $stmt->execute();
            $result2 = $stmt->fetchAll();
            for($i=0;$i<count($result);$i++){
                for($j=0;$j<count($result2);$j++)
                    if($j+1==count($result2)){//只剩最后一个教室
                        $stmt=$this->mysql->prepare("insert into assignClassroom values(?,?,?,?)");
                        $data = array($result[$i][0],$result[$i][1],$result2[$j][0],$result2[$j][1]);
                        $stmt->execute($data);
                    }
                    else if($result[$i][1]<=$result2[$j][1]&&$result[$i][1]>$result2[$j+1][1]){//前一个教室人数>课程人数>后一个教室人数
                        $stmt=$this->mysql->prepare("insert into assignClassroom values(?,?,?,?)");
                        $data = array($result[$i][0],$result[$i][1],$result2[$j][0],$result2[$j][1]);
                        $stmt->execute($data);
                        break 1;//跳出该次循环
                    }
            }
            $stmt=null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * 分配班级课表
     */
    public function assignCurriculum(){
        // $stmt = $this->mysql->prepare(" SELECT student.student_class,elective.elective_isreselect from elective 
        //     RIGHT outer join student on elective.elective_student = student.student_id and elective_isreselect='是' group by student.student_class ");
        $stmt = $this->mysql->prepare("SELECT course_id  from course where course_type='必修'");
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
