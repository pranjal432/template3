<?php

    session_start();
    require "examinee_header.php";
    require "sidebar_examinee.php";
    require "config.php";

if(isset($_SESSION['userdata'])) {

$z=array();
$limit=1;
$id1=1;

if (isset($_GET['id1'])) {
  $id1=$_GET['id1'];
  $n=($id1-1)*$limit;

} else {
  $n=0;
}






if(isset($_GET['testid'])) {
    
    $_SESSION['a']=array();
   
    echo "<form method='POST'><div style='margin-left:230px;height:600px;'>";
    
    $sql2="SELECT * from testquestions WHERE test_id='".$_GET['testid']."' LIMIT {$n},{$limit}";
    $result2=$conn->query($sql2);
    if($result2->num_rows>0) {
        $sql30="SELECT * from tests WHERE test_id='".$_GET['testid']."'";
        $result30=$conn->query($sql30);
        if($result30->num_rows>0) {
            while($row30=$result30->fetch_assoc()) {
                echo "<br><center><h1><u>Welcome to the ".$row30['testname']." test</u></h1></center><br><br>";
            }
        }
        
        while($row2=$result2->fetch_assoc()) {
            
            echo ($n+1).".) <strong><span>".$row2['question']."</span></strong><br><br>";
            $_SESSION['a']=json_decode($row2['options']);
            foreach ($_SESSION['a'] as $value) {
                echo '<input type="radio" name="option"';
                if (isset($_POST['option']) && $_POST['option']==$value ) {
                    echo "checked";
                } 
                echo 'value="'.$value.'">'.$value.'<br><br>';
            }

            echo "<br>";


        }
        echo "<center><input type='submit' style='color:red;background-color:yellow;width:90px;height:40px;' name='submit' value='Submit'></center></form>";

        
        if($n!=0) {
            echo '<br><br><center><a href="taketest1.php?testid='.$_GET['testid'].'&id1=';
            echo ($id1-1);
            echo '" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
                </a></center>';
        }
        
        
    
        $sql3="SELECT * from testquestions WHERE test_id='".$_GET['testid']."'";
        $result3=$conn->query($sql3);
        if($result3->num_rows>0) {
        
            $r1=$result3->num_rows;
            $page1=ceil($r1/$limit);
            if($id1!=$page1) {
                echo '<br><br><center><a href="taketest1.php?testid='.$_GET['testid'].'&id1=';
                echo ($id1+1);
                echo '" aria-label="Next">
                <span aria-hidden="true"> Next &raquo;</span>
                </a></center>';
            } else {
                echo "<br><br><center><a href='examinee_panel.php'>Go to Dashboard</a></center>";
            }

        }

    
        
        
        

    }

    if(isset($_POST['submit'])) {

        if(isset($_POST['option'])) {
            //echo $_POST['option'];
            $_SESSION['qid']=array();
            $count10=0;
            $sql2="SELECT * from testquestions WHERE test_id='".$_GET['testid']."' LIMIT {$n},{$limit}";
            $result2=$conn->query($sql2);
            if ($result2->num_rows>0) {
                while ($row2=$result2->fetch_assoc()) {

                    if ($_POST['option']==$row2['correctanswer']) {
                        // echo $_POST['option'];
                        // echo $_SESSION['userdata']['username'];
                        // echo $_SESSION['userdata']['user_id'];
                        // echo $_GET['testid'];
                        $sql5="SELECT * from examineescore";
                        $result5=$conn->query($sql5);
                        if($result5->num_rows>0) {
                            while($row5=$result5->fetch_assoc()) {

                                if($row5['user_id']==$_SESSION['userdata']['user_id'] && $row5['test_id']==$_GET['testid']) {
                                    $count10++;
                                    $s=$row5['score']+1;
                                    $sql9="UPDATE examineescore SET score='".$s."'";
                                    if($conn->query($sql9)==true) {
                                        //echo "updated";
                                    }
                                }

                            }
                            if($count10==0) {
                                
                                
                                $sql8="INSERT into examineescore(user_id,test_id,datetime,score) VALUES('".$_SESSION['userdata']['user_id']."','".$_GET['testid']."',current_timestamp(),1)";
                                if($conn->query($sql8)==true) {
                                    //echo "inserted2";
                                }

                            }

                        } else {
                            $sql7="INSERT into examineescore(user_id,test_id,datetime,score) VALUES('".$_SESSION['userdata']['user_id']."','".$_GET['testid']."',current_timestamp(),1)";
                            if($conn->query($sql7)) {
                                //echo "inserted";
                            }
                        }


                    }
                }
            }

            

        } else {
            echo "<strong>Please choose the answer</strong>";
        }

    }

    
    
    


    
}
}



?>

</div>
<?php


require "footer.php";
?>