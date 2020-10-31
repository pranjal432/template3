<?php
    require "header.php";
    
?>



<div style="background-color:cyan;height:600px;margin-top:0px;">
<?php
    require "config.php";

$errors=array();


if (isset($_POST['submit'])) {
    $username=isset($_POST['username'])?
    mysqli_real_escape_string($conn, $_POST['username']):'';
    $userpassword=isset($_POST['password'])?
    mysqli_real_escape_string($conn, $_POST['password']):'';
    $userpassword2=isset($_POST['password2'])?
    mysqli_real_escape_string($conn, $_POST['password2']):'';
    $email=isset($_POST['email'])?
    mysqli_real_escape_string($conn, $_POST['email']):'';
    $role=mysqli_real_escape_string($conn, "customer");


    if ($userpassword != $userpassword2) {
        $errors[]=array("input"=>"password","msg"=>"password missmatch");
    }
    $sql1="SELECT * from users WHERE username='".$username."'
	 OR email='".$email."'";
    $result=$conn->query($sql1);
    if ($result->num_rows > 0) {
        $errors[]=array("input"=>"form","msg"=>"Username already present");

    } 
    if (count($errors)==0) {

        $sql="INSERT INTO users (username,userpassword,email,role)
	    VALUES ('".$username."','".$userpassword."','".$email."','".$role."')";

        if ($conn->query($sql)===true) {
            echo "New record created successfully";
            header("Location: login.php");
        } else {
            $errors[]=array("input"=>"form","msg"=>"New record not created.");
        }

    } else {
        foreach ($errors as $error) {
            echo "*".$error['msg']."<br>";
        }
    }

    $conn->close();
}



?>
<center>
<div id="signup-form" >
<h1><u>Sign Up</u></h1>
<br>
<br>
<form action="signup.php" method="POST">
<p>
<label for="username">Username: <input type="text" name="username" 
required placeholder="Enter Username"></label>
</p>
<p>
<label for="password">Password: <input type="password"
 name="password" required placeholder="Enter Password"></label>
</p>
<p>
<label for="password2">Re-Password: <input type="password"
 name="password2" required placeholder="Confirm Password"></label>
</p>
<p>
<label for="email">Email: <input type="email" name="email"
 required placeholder="Enter email"></label>
</p>
<br>
<p>
<input type="submit" name="submit" value="Submit">
</p>
</form>
</div>
</center>
</div>







<?php

    require "footer.php";

?>
