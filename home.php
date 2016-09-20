<?php
session_start();
include("login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href= "styles.css">
    <script type="text/javascript" src="scripts.js" async></script>
    <title>NGA Address Database</title>
</head>
<body>
    <div id="login">
        <input type="button" value="Sign In" id="loginlink"/>
    </div>
    <form id="logout" action="logout.php">
        <input type="submit" value="Sign Out" id="logoutlink" style="visibility: hidden"/>
    </form>
<!--    <iframe name="loginframe" src="login.html" height="400" width="300" id="loginframe"></iframe>-->
    <div id="loginframe" style="height: 400px width: 300px";>
        <form class="loginform" action="home.php" method="get">
            <div class="container">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button class="loginbtn" type="submit">Login</button>
                <input type="checkbox" checked="checked"> Remember me
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" id="cancelbtn" onclick="cancelLogin()">Cancel</button>
                <span class="psw">Forgot <a href="lostPassword.html">password?</a></span>
            </div>
        </form>
    </div>
    <div id="gradient"></div>
    <img class="logo" src="images/flag.gif" alt="home">
    <h1 class="header"> NGA Addressing </h1>
    <h4 class="subheader"> A search engine for the streets of Nigeria </h4>
    <form id="searchbox" action="results.php" method="get">
        <input id="searchtype" type="search" name="search" placeholder="Search" disabled/>
        <button id="searchsubmit" type="submit" value="search" disabled>&nbsp;</button>
    </form>
    <?php
    if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
        echo "<script type=\"text/javascript\">
            document.getElementById('loginlink').style.visibility = 'hidden';
            document.getElementById('logoutlink').style.visibility = 'visible';
            document.getElementById('searchtype').disabled = false;
            document.getElementById('searchsubmit').disabled = false;
        </script>";
    }
    ?>
    <p id="footer"> Microsystems International &copy;</p>
</body>
</html>