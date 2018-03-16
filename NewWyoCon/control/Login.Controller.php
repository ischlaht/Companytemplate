<?php
require_once("conf.php");
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
        $DBBanAdmins        =   $GLOBALS['databaseBanAdmins'];
        $DBRegisterNewAdmins=   $GLOBALS['databaseRegisterNewAdmins'];
        $DBDeleteAccounts   =   $GLOBALS['databaseDeleteAccounts'];
        $DBAccountCreated   =   $GLOBALS['databaseAccountCreated'];
                  
if(isset($_POST['LoginUser'])){
        //Variables
    $userName = $_POST['UserName'];
    $password = $_POST['Password'];
        //Adjust variables
    $userName = strtoupper($userName);
    $password = md5($password);

                //select for login
                $Login = "SELECT * FROM $DBTableAdmins WHERE $DBUsername = ? && $DBPassword = ?";
            if($LoginCheckstmt = $conn->prepare($Login)){
                $LoginCheckstmt->bind_param('ss', $userName, $password);
                $LoginCheckstmt->execute();
                $LoginCheckstmt->store_result();
                $rows = $LoginCheckstmt->num_rows;

                    if(empty($userName) OR empty($password)){
                        echo "Must enter username and password!";
                    }
                    elseif (!preg_match('#^[a-zA-Z0-9äöüÄÖÜ]+$#', $userName) && !empty($userName)) {
                        echo 'Invalid Username.';
                    }
                    elseif($rows != 0){
                            //binding data to fetch from select statement above
                        mysqli_stmt_bind_result($LoginCheckstmt, $Sid, $Susername, $Spassword, $SfirstName, $SlastName,                                 $Scode, $Spower, $Sadmin, $SserverAdmin, $SbanAdmins,                                                   $SregisterNewAdmins, $SdeleteAccounts, $SaccountCreated);
                        mysqli_stmt_fetch($LoginCheckstmt);//Has to come after above bind result ^^^
                            if($Scode != 'BAN'){
                                // $_SESSION['Session']=       'TRUELY';
                                // $_SESSION['Logged-in']=     'Logged-in';     
                                // $_SESSION['UserName']=      $userName;
                                // $_SESSION['Admin']=         $Sadmin;
                                // $_SESSION['ServerAdmin']=   $SserverAdmin;
                                // $_SESSION['BanAdmins']=     $SbanAdmins;
                                // $_SESSION['RegAdmins']=     $SserverAdmin;
                                // $_SESSION['DeleteAccounts']=$SdeleteAccounts;
                                // $_SESSION['Code']=          $Scode;
                                    //Setting Cookies
                                setcookie('Session',       'TRUELY',           time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('Logged-in',     'Logged-in',        time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('UserName',      $Susername,         time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('Admin',         $Sadmin,            time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('ServerAdmin',   $SserverAdmin,      time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('BanAdmins',     $SbanAdmins,        time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('RegAdmins',     $SregisterNewAdmins,time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('DeleteAccounts',$SdeleteAccounts,   time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('Code',          $Scode,             time()+3600*24*60, '/', $CookieFix, false);

                                $LoginCheckstmt->close();//Close out of database
                                $Logger->Logg("User logged in...");
                                header('location: ../admin/admin.index.php');
                            }  
                            elseif($Scode == 'BAN'){ 
                                echo "<script> alert('This account is banned, please talk to your supervisor if you would like to login!') </script>";

                                setcookie('Session',       'BANNED',           time()+3600*24*60, '/', $CookieFix, false);
                                setcookie('Logged-in',     'Logged-out',       time()+3600*24*60, '/', $CookieFix, false);
                                $Logger->Logg('Banned user tried to loggin...');
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