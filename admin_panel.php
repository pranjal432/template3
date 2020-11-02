<?php
    
    session_start();
    require "admin_header.php";
    require "sidebar.php";


?>

<div style="margin-left:230px;">
    <div style="height:560px;">

    <?php
        
        if(isset($_SESSION['admindata'])) {
            echo "<center><h1 style='margin-top:220px;'>Welcome to the Admin Panel ".$_SESSION['admindata']['adminname']."</h1></center>";
        }

    ?>

    </div>
    
<div>

<?php 
    require "footer.php";
?>