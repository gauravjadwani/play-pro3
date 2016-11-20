<?php
include 'connection.php';
session_start();
    $email=$_SESSION["email"];
    $name=$_SESSION["name"];
    $name=$_SESSION["user_id"];
    //$name=$r->hget($email,'name');
?>