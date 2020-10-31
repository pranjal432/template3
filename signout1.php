<?php

session_start();
if (isset($_SESSION['userdata'])) {
    session_unset();
    session_destroy();
    header("Location: home.php");
} else {
    echo "<center>Examinee Logout, login again to continue</center>";
}


?>