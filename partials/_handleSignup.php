<?php
$showError = false;
$showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include'_dbconnect.php';
    $name = $_POST['name'];
    $user_email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $cpassword = $_POST['signupCpassword'];

    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn , $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        $showError = "Email already exist";
    }
    else{
        if($password == $cpassword){
            $hash = password_hash($password , PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name` , `user_email` , `user_password` , `timestamp`) VALUES('$name','$user_email', '$hash' , current_timestamp())";
            $result  = mysqli_query($conn , $sql);
            if($result){
                $showAlert = true;
                header("Location:/forums/index.php?signupsuccess = true");
                exit();
            }
        }
        else{
            $showError = "Password do not match";
        }
    }
    header("Location:/forums/index.php?signupsuccess = false&error=$showError");
}

?>