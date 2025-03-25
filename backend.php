<?php

include("db.php");
$fac_id = $_SESSION['faculty_id'];
$section = $_SESSION['section'];
$year = $_SESSION['year'];


if(isset($_POST['faclogin'])){
    $id=$_POST['id'];
    $pass=$_POST['pass'];
    $_SESSION['faculty_id'] = $id;
    $sql="SELECT * FROM faculty WHERE faculty_id='$id' AND pass='$pass'" ;
    $query_run=mysqli_query($conn,$sql);
    $query_data=mysqli_fetch_assoc($query_run);
    $role = $query_data['role'];
    $_SESSION['role'] = $role;
    $dept = $query_data['department'];
    $_SESSION['dept'] = $dept;
    if($query_data!= NULL){
        $res=[
            "status"=>"200",
            "message"=>"success",
            
        ];
    }
    echo json_encode($res);
}


if(isset($_POST['course'])){
    $dept = $_POST['dept']; 
    $sql = "SELECT * FROM academic_year";
    $sql1 = "SELECT * FROM faculty WHERE department = '$dept' AND role='faculty'";
    $query_run1 = mysqli_query($conn,$sql1);
    $query_data1 = mysqli_fetch_all($query_run1,MYSQLI_ASSOC);
    $query_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_all($query_run,MYSQLI_ASSOC);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$query_data,
            "data1"=>$query_data1,
        ];
        echo json_encode($res);

    }

}

if(isset($_POST['yearc'])){
    $year = $_POST['year'];
    $sql = "SELECT * FROM course WHERE year = '$year'";
    $query_run = mysqli_query($conn,$sql);
    $data = mysqli_fetch_all($query_run,MYSQLI_ASSOC);
    if($data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$data,
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['cdata'])){
    $advisor_id = $_POST['advisor'];
    $courses = json_decode($_POST['courses'], true);  
    $year = $_POST['year'];
    $section = $_POST['section'];
    $run = false;
    $query = "INSERT INTO advisor(faculty_id,year,section) VALUES('$advisor_id','$year','$section')";
    $q_run = mysqli_query($conn,$query);

    foreach($courses as $course){
        $sql = "INSERT INTO advisor_courses(advisor_id,course_id,section,year) VALUES('$advisor_id','$course','$section','$year')";
        $query_run = mysqli_query($conn,$sql);
        $run = true;

    }
    if($run){
        $res=[
            "status"=>200,
            "message"=>"done",
        ];
        echo json_encode($res);
    }
    
}

if(isset($_POST['assign'])){
    $id = $_POST['flist'];
    $rid = $_POST['rid'];
    $sql = "UPDATE advisor_courses SET faculty = '$id' WHERE id = '$rid'";
    $query_run = mysqli_query($conn,$sql);
    if($query_run){
        $res=[
            "status"=>200,
            "message"=>"success",
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['coursename'])){
    $course_id = $_POST['id'];
    $sql="SELECT * FROM course where code='$course_id'";
    $query_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_assoc($query_run);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$query_data
        ];
        echo json_encode($res);
    }
}


if(isset($_POST['facultyname'])){
    $fac_id = $_POST['id'];
    $sql="SELECT * FROM faculty where faculty_id = '$fac_id'";
    $query_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_assoc($query_run);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"success",
            "data"=>$query_data
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['indcourse'])){

    $sql = "SELECT * FROM advisor_courses WHERE advisor_id='$fac_id'";
    $sql_run = mysqli_query($conn,$sql);
    $query_data = mysqli_fetch_all($sql_run,MYSQLI_ASSOC);
    if($query_data){
        $res=[
            "status"=>200,
            "message"=>"done",
            "data"=>$query_data,

        ];
        echo json_encode($res);
    }

}


if(isset($_POST['tt'])){
    $row = $_POST['id'];
    $hour = $_POST['hour'];
    $course = $_POST['code'];
    $sql = "SELECT * FROM advisor WHERE faculty_id='$fac_id'";
    $sql_run = mysqli_query($conn,$sql);
    $sql_data = mysqli_fetch_array($sql_run);
    $year = $sql_data['year'];
    $section = $sql_data['section'];
    $sql1  = "UPDATE time_table SET $hour='$course' WHERE id='$row'";
    $sql1_run = mysqli_query($conn,$sql1);
    if($sql1_run){
        $res=[
            "status"=>200,
            "message"=>"Done",
        ];
        echo json_encode($res);
    }

}

if(isset($_POST['get_tt'])){
    $date = date("d/m/Y");
    $day = date("l");
    $sql = "SELECT * FROM time_table WHERE section='$section' AND year='$year' AND day = '$day' ";
    $sql_run = mysqli_query($conn,$sql);
    $sql_data = mysqli_fetch_array($sql_run);
    if($sql_data){
        $res=[
            "status"=>200,
            "message"=>"done",
            "data"=>$sql_data,
            "date"=>$date,
        ];
        echo json_encode($res);
    }
}

if(isset($_POST['getcdetail'])){
    $code = $_POST['code'];
    $sql = "SELECT * FROM advisor_courses WHERE course_id='$code'";
    $sql_run = mysqli_query($conn,$sql);
    $sql_data = mysqli_fetch_array($sql_run);
    $fac1_id = $sql_data['faculty'];
    $sql1 = "SELECT * FROM faculty WHERE faculty_id='$fac1_id'";
    $sql1_run = mysqli_query($conn,$sql1);
    $sql1_data = mysqli_fetch_array($sql1_run);
    $fac1_name = $sql1_data['faculty_name'];
    $sql2 = "SELECT * FROM course WHERE code='$code'";
    $sql2_run  = mysqli_query($conn,$sql2);
    $sql2_data = mysqli_fetch_array($sql2_run);
    $c_name = $sql2_data['name'];
    if($sql_data && $sql1_data && $sql2_data){
        $res=[
            "status"=>200,
            "message"=>"succcess",
            "cname"=>$c_name,
            "fac_name"=>$fac1_name,
        ];
        echo json_encode($res);
    }




}
?>