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
    $databaseBanAdmins          = 'banAdmins';
    $databaseRegisterNewAdmins  = 'registerNewAdmins';
    $databaseDeleteAccounts     = 'deleteAccounts';
    $databaseAccountCreated     = 'accountCreated';

//Company Information
    $CompanyName        = "WYOConcrete";
    $Location           = "Laramie, Wyoming";
    $TypeOfBussiness    = "Concrete";
    $Owners             = "Shawn Harnden & Matt Baliney";
    $ContactInformation = "N/A";
    $WebsiteDueDate     = "13th of every month";
    $WebsiteCost        = "120$/Month";
    $ContractEnds       = "N/A";
    $CompanyPolicy      = "N/A";
    $Contract           = "N/A";
    $WebsiteOwner       = "Isaac Schlaht @King Systems Development, Email: KingSystemsDev@gmail.com, Phone: 307-321-6559";
    $CopyRights         = "N/A";
    $YearFounded        = "N/A";

    //Cookie Configuration
    $Cookie = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 
    
    //Logging System
class Logger{
    public function Logg($LogThis){
        date_default_timezone_set("America/Denver");

            if(isset($_COOKIE['UserName'])){
                $userName = $_COOKIE['UserName'];
            }
            elseif(isset($_POST['UserName'])){
                $userName = $_POST['UserName'];
            }
            else{
                $userName = "Unknown Username";
            }
                $LogFileAppend = fopen("../currentLogFile.txt", "a+");
                fwrite($LogFileAppend, "--->". $userName. "::: " .$LogThis. " Date: ". date("Y/m/d")." Time: ". date("h:i:sa")."\n");
                fclose($LogFileAppend);
    }
}
$Logger = new Logger($LogThis);
    

    
    //Error Handeling
if($DataBaseConnection == false){
    echo "<script> console.log('Could not Connect to database'); alert('Could NOT Connect to DataBase')</script>";
    $Logger->Logg("Failed to connect to database...");
}
?>