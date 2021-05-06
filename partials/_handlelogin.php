<?php

$showError="false";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    include '_dbconnect.php';
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpass'];
    $exitsql="SELECT * FROM `users` WHERE user_email='$email'";
    $result=mysqli_query($conn,$exitsql);
    $numrows=mysqli_num_rows($result);
    if($numrows==1)
    {
        $row=mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$email;
            $_SESSION['sno']=$row['sno'];
            echo"logged in" . $email;
            
        }
        header("Location:/forum/index.php");

    }
    header("Location:/forum/index.php");
}
?>