<?php
    
    session_start();
    require "examinee_header.php";
    require "sidebar_examinee.php";
    require "config.php";


?>

<div style="margin-left:230px;">
    <div style="height:560px;">

    <?php
        
        if(isset($_SESSION['userdata'])) {
            echo "<center><h1 style='margin-top:80px;'>Welcome ".$_SESSION['userdata']['username']."</h1></center>";
            echo "<center><h2 style='margin-top:20px;'><u>Your Test Scores</u></h2></center>";

            echo '<div style="height:100%; margin-left:230px;margin-top:60px;">';
            
            $sql="SELECT * from tests";
            $result=$conn->query($sql);
            if($result->num_rows>0) {
                while($row=$result->fetch_assoc()) {

                    
                $sql3="SELECT * from examineescore";
                $result3=$conn->query($sql3);
                if($result3->num_rows>0) {
                    while($row3=$result3->fetch_assoc()) {
                        
                        if($row3['test_id']==$row['test_id']) {
                            $count=0;
                            $sql2="SELECT * from testquestions WHERE test_id='".$row3['test_id']."'";
                    $result2=$conn->query($sql2);
                    if($result2->num_rows>0) {
                    while($row2=$result2->fetch_assoc()) {
                        $count++;
                    }
                }
                            echo '<div id="product-101" class="product">
                        <form action="taketest1.php?testid='.$row["test_id"].'" method="POST" enctype="multipart/form-data" 
                        name="form">
                        <h2 style="color:red">'.$row["testname"].'</h2>
                        <input type="submit" class="add-to-cart" name="starttest" value="Test Score: '.$row3['score'].'/'.$count.'"></form>
                        <a href="deletescore.php?testid='.$row['test_id'].'" class="add-to-cart">Delete</a><br>';

                        if(($row3['score']/$count) >= 0.33) {
                            echo "Congratulations, You Passeed this exam.";
                            echo "<br>with ".(($row3['score']/$count)*100)."%";
                        } else {
                            echo "Sorry, You failed this exam.";
                            echo "<br>with ".(($row3['score']/$count)*100)."%";
                        }
                
                        echo '</div>';
                        }
                        
                    }
                } else {
                    echo "<strong style='margin-left:200px;margin-top:100px;'>There is no test given by Examinee yet.</strong>";
                break;
                }
                    
                   
                }
            }
            echo '</div>';
        }

    ?>

    </div>
    
<div>

<?php 
    require "footer.php";
?>