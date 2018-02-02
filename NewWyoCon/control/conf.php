<?php

//DataBase Connection and Configurations
$conn = mysqli_connect('localhost', 'root', '', 'companytemplate');


//DELETE LATER!~!!!!!!!!!!!!!!!!!!!!!!!!!!!!!~~~~~~~~~~~~~!!!!!!!!!!~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!~~~~~~~~~~~~
if($conn == false){
    echo "<script> console.log('Could not Connect to database'); alert('Could NOT Connect to DataBase')</script>";
}//DELETE LATER!~!!!!!!!!!!!!!!!!!!!!!!!!!!!!!~~~~~~~~~~~~~!!!!!!!!!!~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!~~~~~~~~~~~~

    //Cookie Configurations
$Cookie = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 
// $CookieFix = $GLOBALS['Cookie'];
// mysqli_select_db($dbconn, 'login_register');
// if(isset($_COOKIE['UserName'])){
// }
?>