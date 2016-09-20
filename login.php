<?php
    include("config.php");
    echo "<script src='scripts.js'></script>";

    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
        $user = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $query = "SELECT * FROM NGA.USERS WHERE username = '$user' AND password = '$password' ";
        $result = mysqli_query($connector,$query);
        $count = mysqli_num_rows($result);
        if ($count == 1){
            $_SESSION['login_user'] = $user;
            header("Refresh:0");
        }
        else {
            $error = "Your Login Name or Password is invalid";
        }
    }
?>