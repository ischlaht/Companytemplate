<?php
include_once("conf.php");
$conn = $GLOBALS['DataBaseConnection'];
$CookieFix = $GLOBALS['Cookie'];


        //Database values
        $DBTableAdmins    = $GLOBALS['DBTableAdminAccounts'];
        $DBUsername         =   $GLOBALS['databaseUsername'];
        $DBPassword         =   $GLOBALS['databasePassword'];
        $DBFirstname        =   $GLOBALS['databaseFirstname'];
        $DBLastname         =   $GLOBALS['databaseLastname'];
        $DBCode             =   $GLOBALS['databaseCode'];
        $DBPower            =   $GLOBALS['databasePower'];
        $DBAdminer          =   $GLOBALS['databaseAdminer'];
        $DBServerAdmin      =   $GLOBALS['databaseServerAdmin'];
        $DBViewAccounts     =   $GLOBALS['databaseViewAccounts'];
        $DBRegisterNewAdmins=   $GLOBALS['databaseRegisterNewAdmins'];
        $DBDeleteAccounts   =   $GLOBALS['databaseDeleteAccounts'];
                  


if(isset($_POST['LoginUser'])){
        //DB Connection errors
    if($conn == false){
        echo "<script> console.log('Could not Connect to database'); alert('Could NOT Connect to DataBase')</script>";
        $Logger->Logg("Failed to connect to database on loggin...");
    }
        //Variables
    $userName = $_POST['UserName'];
    $password = $_POST['Password'];
        //fix variables
    $userName = strtoupper($userName);
    $password = md5($password);
                //select for login
            $Login = "SELECT * FROM $DBTableAdmins WHERE $DBUsername = ? && $DBPassword = ?";
        if($LoginCheckstmt = $conn->prepare($Login)){
            $LoginCheckstmt->bind_param('ss', $userName, $password);
            $LoginCheckstmt->execute();
            $LoginCheckstmt->store_result();
            $rows = $LoginCheckstmt->num_rows;
    
            if($rows != 0){
                    //binding data to fetch from select statement above
                mysqli_stmt_bind_result($LoginCheckstmt, $Sid, $Susername, $Spassword, $SfirstName, $SlastName, $Scode, 
                                            $Spower, $Sadmin, $SserverAdmin, $SviewAccounts, $SregisterNewAdmins, $SdeleteAccounts, $SaccountCreated);
                mysqli_stmt_fetch($LoginCheckstmt);//Has to come after above bind result ^^^
                $_SESSION['Session']=       'TRUELY';      
                $_SESSION['UserName']=      $userName;
                $_SESSION['Admin']=         $Sadmin;
                $_SESSION['ServerAdmin']=   $SserverAdmin;
                $_SESSION['ViewAccounts']=  $SviewAccounts;
                $_SESSION['RegAdmins']=     $SserverAdmin;
                $_SESSION['DeleteAccounts']=$SdeleteAccounts;
                $_SESSION['Code']=          $Scode;
                    //Setting Cookies
                setcookie('Session',       'TRUELY',           time()+3600*24*60, '/', $CookieFix, false);
                setcookie('UserName',      $Susername,         time()+3600*24*60, '/', $CookieFix, false);
                setcookie('Admin',         $Sadmin,            time()+3600*24*60, '/', $CookieFix, false);
                setcookie('ServerAdmin',   $SserverAdmin,      time()+3600*24*60, '/', $CookieFix, false);
                setcookie('ViewAccounts',  $SviewAccounts,     time()+3600*24*60, '/', $CookieFix, false);
                setcookie('RegAdmins',     $SregisterNewAdmins,time()+3600*24*60, '/', $CookieFix, false);
                setcookie('DeleteAccounts',$SdeleteAccounts,   time()+3600*24*60, '/', $CookieFix, false);
                setcookie('Code',          $Scode,             time()+3600*24*60, '/', $CookieFix, false);
                $LoginCheckstmt->close();//Close out of database
                $Logger->Logg("User just Logged in...");

                    if(isset($_COOKIE['UserName']) && $_COOKIE['Session'] === 'TRUELY'){
                        // if($_COOKIE['ServerAdmin'] != 'TRUE'){
                        //     echo "<script>if(confirm('You are now logged in and only have permissions to change content on the website and update your account!')){window.location.assign('../admin/admin.index.php');}</script>";  
                        // }
                        // if(isset($_COOKIE['ServerAdmin']) && $_COOKIE['ServerAdmin'] === 'TRUE'){
                        //     header('location: ../admin/admin.index.php');
                        // }           
                        header('location: ../admin/admin.index.php');
                        
                    }  
            }             
                    else{
                        // $LoginCheckstmt->close();
                        echo "Wrong Username or Password, Please Try Again!";
                        $_SESSION['session'] = "ERROR";   
                        setcookie('Session', 'ERROR', time()+3600*24*60, '/', $CookieFix, false);   
                        $Logger->Logg("User entered wrong username/password combination...");
                    }
                
        }
}



?>