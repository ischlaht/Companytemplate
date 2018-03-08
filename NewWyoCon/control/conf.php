<?php

//DataBase Connection
$DataBaseConnection = mysqli_connect('localhost', 'root', '', 'companytemplate');
//Database Tables
$DBTableAdminAccounts           = 'admins';//Table for users(admins)...
//Database values-------------------------------------------------------
    $databaseUserID             = 'id';
    $databaseUsername           = 'userName';
    $databasePassword           = 'password';
    $databaseFirstname          = 'firstName';
    $databaseLastname           = 'lastName';
    $databaseCode               = 'code';
    $databasePower              = 'power';
    $databaseAdminer            = 'adminer';
    $databaseServerAdmin        = 'serverAdmin';
    $databaseViewAccounts       = 'viewAccounts';
    $databaseRegisterNewAdmins  = 'registerNewAdmins';
    $databaseDeleteAccounts     = 'deleteAccounts';
    $databaseAccountCreated     = 'accountCreated';



//Error Handeling
if($DataBaseConnection == false){
    echo "<script> console.log('Could not Connect to database'); alert('Could NOT Connect to DataBase')</script>";
    $Logger->Logg("Failed to connect to database on loggin...");
}



    //Cookie Configuration
$Cookie = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 


//Logging System
class Logger{
    public function Logg($LogThis){
        date_default_timezone_set("America/Denver");
        $userName = $_POST['UserName'];
            $LogFileAppend = fopen("../Logs.txt", "a+");
                fwrite($LogFileAppend, "--->". $userName. "::: " .$LogThis. " Date: ". date("Y/m/d")." Time: ". date("h:i:sa")."\n");
                fclose($LogFileAppend);
    }
}
$Logger = new Logger($LogThis);

?>