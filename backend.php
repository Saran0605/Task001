<?php
include("db.php");
session_start();

if(isset($_POST['faclogin'])){
    $id=$_POST['id'];
    $pass=$_POST['pass'];
    $sql="SELECT * FROM faculty WHERE faculty_id='$id' AND pass='$pass'" ;
    $query_run=mysqli_query($conn,$sql);
    $query_data=mysqli_fetch_assoc($query_run);
    if($query_data!= NULL){
        $_SESSION['faculty_id'] = $id;
        $res=[
            "status"=>"200",
            "message"=>"success",
            
        ];
    }
    echo json_encode($res);
}

?>