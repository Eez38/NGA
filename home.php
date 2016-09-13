<?php
//session_start();
include("config.php");
include("login.php");

//echo $user = $_REQUEST['username'];
//echo $password = $_REQUEST['password'];

if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
    echo "<script> document.getElementById('searchbox').style.visibility = 'visible'; </script>";
    echo "<script> document.getElementById('login').style.visibility = 'hidden'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href= "styles.css">
    <link rel="stylesheet" href="normalize.css">
    <script type="text/javascript" src="scripts.js" async></script>
    <title>NGA Address Database</title>
</head>
<body>
    <div id="login">
        <input type="button" value="Sign In" id="loginlink" />
    </div>
    <iframe src="login.html" height="400" width="300" id="loginframe"></iframe>
    <div id="gradient"></div>
    <img class="logo" src="images/flag.gif" alt="home">
    <h1 class="header"> NGA Addressing </h1>
    <h4 class="subheader"> A search engine for the streets of Nigeria </h4>
    <form id="searchbox" action="results.php" method="get">
        <input type="search" name="search" placeholder="Search" />
        <button id="searchsubmit" type="submit" value="search">&nbsp;</button>
    </form>
    <p id="footer"> Microsystems International &copy;</p>
</body>
</html>