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
            echo "<script 
                    type='text/javascript'> window.frameElement.style.visibility = 'hidden'; 
                    location.reload();
                </script>";
        }
        else {
            $error = "Your Login Name or Password is invalid";
        }
    }
//    if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
//        echo "<script>
//                window.frameElement.style.visibility = 'hidden';
//                login();
////                window.document.getElementById('searchbox').style.visibility = 'visible';
//                window.document.getElementById('login').style.visibility = 'hidden';
////                parent.document.getElementById('searchbox').style.visibility = 'visible';
//            </script>";
//    }
?>