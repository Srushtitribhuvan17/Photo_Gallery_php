<?php
include("../db.php");
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $name=$_POST["fullname"];
    $age=$_POST["age"];
    $username=$_POST["username"];
    $password=password_hash($_POST["password"],PASSWORD_DEFAULT);


    $sql=$conn->prepare("insert into users(name,age,username,password) values(?,?,?,?)");
    $sql->bind_param("siss",$name,$age,$username,$password);
    $sql->execute();
    header("location:login.php" );
}
?>