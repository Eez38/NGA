<?php
session_start();
session_destroy();
header('Location: home.php');
    echo "<script type=\"text/javascript\">
            document.getElementById('loginlink').style.visibility = 'visible';
            document.getElementById('logoutlink').style.visibility = 'hidden';
            document.getElementById('searchtype').disabled = true;
            document.getElementById('searchsubmit').disabled = true;
        </script>";
exit;
?>