<?php
    
    require "header.php";
    require "config.php";


    echo '<div style="height:100%; margin-left:230px;margin-top:60px;">';

    $sql="SELECT * from tests";
    $result=$conn->query($sql);
    if($result->num_rows>0) {
        while($row=$result->fetch_assoc()) {
            echo '<div id="product-101" class="product">';
            //echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';
            
           

            echo '<form method="POST">';
            echo '<h2 style="color:red">'.$row["testname"].'</h2>
            <input type="submit" class="add-to-cart" name="starttest" value="Start Test"></form>
			
            </div>';
        }
    }
    echo '</div>';

    if(isset($_POST['starttest'])) {
        echo "<script>
              alert('First you need to Login.');
              window.location='login.php';
        </script>";
    }
    
?>

<?php
    require "footer.php";
?>
