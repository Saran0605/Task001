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




?>