<?php

    session_start();
    require "examinee_header.php";
    require "sidebar_examinee.php";
    require "config.php";
    if(isset($_SESSION['userdata'])) {
    
    echo '<div style="height:100%; margin-left:230px;margin-top:60px;">';

    $sql="SELECT * from tests";
    $result=$conn->query($sql);
    if($result->num_rows>0) {
        while($row=$result->fetch_assoc()) {
            echo '<div id="product-101" class="product">';
            //echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';
            $sql2="SELECT * from examineescore";
            $result2=$conn->query($sql2);
            if($result2->num_rows>0) {
                $count=0;
                while($row2=$result2->fetch_assoc()) {
                    if($row2['test_id']==$row['test_id']) {
                        $count++;
                        // echo $row2['test_id'];
                        // echo $row['test_id'];
                        
                        // $sql3="DELETE from examineescore WHERE test_id='".$row2['test_id']."'"; 
                        // if($conn->query($sql3)==true) {
                        //     echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';
                        // }

                        // if($conn->query($sql3)==true) {
                        // echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';

                            
                        // }
                    }
                    
                }
                
                if($count==0) {
                    echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';
                }

            } else {
                echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';
            }
           


            echo '<input type="text" value="'.$row["testname"].'" name="testname" readonly>
            <input type="submit" class="add-to-cart" name="starttest" value="Start Test"></form>
			
            </div>';
        }
    }
    echo '</div>';

    if(isset($_POST['starttest'])) {
        //echo $_POST['testname'];
        echo "ergvtd";
    }
}

    

?>
<!-- <a class="add-to-cart" href="taketest.php?id='.$row['test_id'].'" name="anchortag">Start test</a> -->




<?php

    require "footer.php";

?>