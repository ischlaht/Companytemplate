
<?php
require('conn.php');
include_once('class.php');

if(isset($_GET['functionRegUser'])){
        $Register->RegNewAdmin();
    }
    

    if(isset($_GET['functionUserNameAvailability'])){
        $Register->CheckUserNameAvailability();    
    }
    

function LoginUser(){
    $UserName=$_POST['UserName'];
    $Password=$_POST['Password'];
    $Login = mysqli_query($conn, "SELECT * FROM admin WHERE userName = '$UserName' && password = '$Password'");
        if(mysqli_num_rows($Login) == 0){
            // header("location: conn.php");
        }
        else{
            echo "nooo";
        }
}



?>