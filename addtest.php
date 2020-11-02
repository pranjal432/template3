<?php
    
    session_start();
    require "admin_header.php";
    require "sidebar.php";
    require "config.php";
    $count=0;
    if(isset($_SESSION['admindata'])) {
        if(isset($_GET['testname'])) {
            $a=$_GET['testname'];
        } else {
            $a="";
        }
    
    


?>
<form method="POST">
<center><div style="margin-top:100px;margin-left:230px;height:510px;">
<label>Test Name : </label>
<input type="text" value="<?php echo $a; ?>" name="testname1"><br><br><br><br>

<input type="submit" value="Add new Question" name="addnewquestion" class="add-to-cart"><br>

<?php

    if(isset($_POST['addnewquestion'])) {
        echo "<input type='hidden' name='testname2' value='".$_POST['testname1']."'><br>";
        echo "<label><strong>Question: </strong><textarea name='question' placeholder='Enter question here' style='margin-top:40px;' cols='45' rows='6'></textarea></label><br>";
        echo "<input type='text' placeholder='Option1' name='option1'><br><input type='text' placeholder='Option2' name='option2'><br><input type='text' placeholder='Option3' name='option3'><br><input type='text' placeholder='Option4' name='option4'><br><br>";
        echo "<label>Correct Answer: <input type='text' placeholder='Correct Answer' name='correctanswer'><br><br><br>";
        echo "<input type='submit' value='ADD' name='add'><br>";
    }

?>

</div></center>
</form>

<?php

    if(isset($_POST['add'])) {
        
        echo $_POST['option1'];
        echo $_POST['testname2'];
        $sql="SELECT * from tests";
        $result=$conn->query($sql);
        if ($result->num_rows>0) {
            while ($row=$result->fetch_assoc()) {
                if($row['testname']==$_POST['testname2']) {
                    $count++;
                }
                
            }
            if($count==0) {
                $sql1="INSERT into tests(testname) VALUES('".$_POST['testname2']."')";
                if($conn->query($sql1)==true) {
                    echo "data inserted";
                }
            }
        } else {
            $sql2="INSERT into tests(testname) VALUES('".$_POST['testname2']."')";
            if($conn->query($sql2)==true) {
                echo "data inserted1";
            }
        }

        $_SESSION['options']=array($_POST['option1'],$_POST['option2'],$_POST['option3'],$_POST['option4']);
        $js=json_encode($_SESSION['options']);

        $sql3="SELECT * from tests WHERE testname='".$_POST['testname2']."'";
        $result3=$conn->query($sql3);
        if($result3->num_rows>0) {
            while($row3=$result3->fetch_assoc()) {
                $sql4="INSERT into testquestions(test_id,question,options,correctanswer) VALUES('".$row3['test_id']."','".$_POST['question']."','".$js."','".$_POST['correctanswer']."')";
                if($conn->query($sql4)==true) {
                    echo "hello";

                }
            }
        }
        
        header("Location:addtest.php?testname=".$_POST['testname2']."");
        $count=0;
    }
}

?>
<?php 
    require "footer.php";
?>