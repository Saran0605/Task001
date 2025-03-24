<?php

include("db.php");

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




?>