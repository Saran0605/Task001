<?php
$var1 = "localhost";
$var2 = "root";
$var3 = "";
$var4 = "task001";

$conn = new mysqli($var1,$var2,$var3,$var4);
if($conn->connect_error){
    die("conncetion failed");
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    

?>