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
    $dept = $query_data['dept'];
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
    $sql="SELECT * FROM academic_year";
    $query_run=mysqli_query($conn,$sql);
    $query_data=mysqli_fetch_array($query_run);
    if($query_data!=NULL){
        $res=[
            "status"=>"200",
            "message"=>"Fetched",
            "data"=>$query_data
        ];
        echo json_encode($res);

    }
}




?>