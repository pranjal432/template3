<?php
    require "header.php";
    require "config.php";
?>





<div id="wrapper" style='background-color:cadetblue'>
<?php

/*dfjnv
 */
session_start();
$errors=array();
//$_SESSION['userdata']=array();

if (isset($_POST['submit'])) {
    
    $username=isset($_POST['username'])?$_POST['username']:'';
    $userpassword=isset($_POST['password'])?$_POST['password']:'';


    $sql1="SELECT * from users WHERE username='".$username."'
	 AND userpassword='".$userpassword."'";
    $result=$conn->query($sql1);
    if ($result->num_rows > 0) {
        while ($row= $result->fetch_assoc()) {
            if ($row['role']=="customer") {
                $_SESSION['userdata']=array("username"=>$row['username'],
                 "user_id"=>$row['user_id']);
                header("Location: examinee_panel.php");
            } elseif ($row['role']=="admin") {
                $_SESSION['admindata']=array("adminname"=>$row['username'],
                "admin_id"=>$row['user_id']);
                header("Location: admin_panel.php");
            }
            
        }

    } else {
        $errors[]=array("input"=>"form","msg"=>"Invalid Login credentials!!");
    }
    if (count($errors)!=0 ) {
        foreach ($errors as $error) {
            echo "*".$error['msg']."<br>";
        }
    }

    $conn->close();
}

// if (isset($_POST['register'])) {
//     header("Location: signup.php");
// }



?>
<center>
<div id="signup-form">
<h1><u>Login</u></h1>
<br>
<br>
<form action="login.php" method="POST">
<p>
<label for="username">Username: <input type="text" name="username"
 required placeholder="Enter Username"></label>
</p>

<p>
<label for="password">Password: <input type="password"
 name="password" required placeholder="Enter Password"></label>
</p>
<br>
<p>
<input type="submit" name="submit" value="Login">
</p>
<!-- <h2 style="text-align:center">OR</h2>

</form>
<form action="login.php" method="POST">
<p>
<input type="submit" name="register" value="Register a new user">
</p>
</form> -->
</div>
</center>
</div>


<?php

    require "footer.php";

?>
