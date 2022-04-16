<?php

include("db.php");

$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$passwd = $_POST['password'];
$cpasswd = $_POST['cpassword'];

if($passwd != $cpasswd){
    echo("<h1 style = 'color: red;'>Password doesn't match</h1>");
} elseif(!empty($pseudo) && !empty($email) && !empty($passwd) && !empty($cpasswd) && !is_numeric($pseudo)) {
    $query = "insert into registration (pseudoUser, emailUser, passwordUser) values ('$pseudo','$email','$passwd')";
    mysqli_query($con,$query);
    header("index.php")
}

?>