<?php
    
    session_start();
    require "examinee_header.php";
    require "sidebar_examinee.php";
    require "config.php";

    if(isset($_GET['testid'])) {
        $id=$_GET['testid'];

        $sql="DELETE from examineescore WHERE test_id='".$id."'";
        if($conn->query($sql)==true) {
            header("Location:examinee_panel.php");
        }
    }


?>





<?php

   require "footer.php";

?>