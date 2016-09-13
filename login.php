<?php
    include("config.php");
    session_start();

    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
        $user = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        echo $user;
        echo " ";
        echo $password;
//        $user = mysqli_real_escape_string($connector, $_REQUEST['username']);
//        $password = mysqli_real_escape_string($connector, $_REQUEST['password']);
        $query = "SELECT * FROM NGA.USERS WHERE username = '$user' AND password = '$password' ";
        //COUNT(*) AS TOTAL
        echo $query;
        $result = mysqli_fetch_row($query);
        if($result['TOTAL'] == 1){
//            session_register("myusername");
            $_SESSION['login_user'] = $myusername;

//            header("location: home.php");
        }
        else {
            $error = "Your Login Name or Password is invalid";
        }
    }
//    else echo 'blah';
?>