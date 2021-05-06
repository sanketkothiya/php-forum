<?php

$showError="false";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupCpassword'];
    
    $exitsql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result=mysqli_query($conn,$exitsql);
    $numrows=mysqli_num_rows($result);
    if($numrows > 0)
    {
        $showError="Email already exits";
    }
    else{
        if(($pass==$cpass))
         {
            $hass1=password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES 
            ( '$user_email', '$hass1', current_timestamp())";
 
            echo var_dump($hashed_password);
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $showAlert=true;
                header("Location:/forum/index.php?signupsuccess=true");
                exit();
            }
         }
         
        else{
            $showError="password do not match";

        }
    }
    header("Location:/forum/index.php?signupsuccess=false&error=$showError");
    
} 
?>