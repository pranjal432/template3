<?php

session_start();
if (isset($_SESSION['admindata'])) {
    session_unset();
    session_destroy();
    header("Location: home.php");
} else {
    echo "<center>Admin Logout, login again to continue</center>";
}


?>