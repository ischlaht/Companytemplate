
<?php
    include_once("conf.php");
    // $conn = mysqli_connect('localhost', 'root', '', 'companytemplate');
    
class Register{

    function RegNewAdmin(){
            file_get_contents("php://input");
        $conn = $GLOBALS['DataBaseConnection'];

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
                  
             //POST Data values           
        $userName =     $_POST['Username'];
        $password =     $_POST['Password'];
        $password2=     $_POST['Password2'];
        $firstName=     $_POST['Firstname'];
        $lastName =     $_POST['Lastname'];
            //Make Input fields UpperCase
        $userName =     strtoupper($userName);
        $firstName=     strtoupper($firstName);
        $lastName =     strtoupper($lastName);    
            //Encryption of Password
        $password =     md5($password);
        $password2=     md5($password2);
            //User Super Permissions
        $powerGiveAdmin     =   $_POST['GiveAdminCheck'];
        $powerServer        =   $_POST['GiveServerCheck'];
        $powerAccounts      =   $_POST['ViewAccountsCheck'];
        $powerRegisterAdmins=   $_POST['RegisterAdminsCheck'];
        $powerDeleteAccounts=   $_POST['DeleteAccountsCheck'];
            // error handling
        $error = array();
      
                //Empty fields validation
            if(empty($userName) OR empty($password) OR empty($password2) OR empty($firstName) OR empty($lastName)){
                    array_push($error, '- All fields are required ,');
                    echo '- All fields are required ,';
            }
                // Confrim password validation
            if ($password != $password2) {
                    array_push($error, ' - Passwords do not match ,');
                    echo '- Passwords do not match ,';
            }
                //checking for username leters and numbers
            if (!preg_match('#^[a-zA-Z0-9äöüÄÖÜ]+$#', $userName) && !empty($userName)) {
                    array_push($error, '- Username can only contain letters and numbers ,');
                    echo '- Username can only contain letters and numbers ,';
            }
                //uSERNAME lENGTH CHECKER
            if (strlen($userName) < 4 OR strlen($userName) > 20) {
                if(!empty($userName)) {
                    array_push($error, '- Username is to short or to long ,');
                    echo '- Username must be 4-20 characters ,';
                }
            }
                //___Username Availability
            $newquery = "SELECT * FROM $DBTableAdmins WHERE  $DBUsername = ? ";
            if($userCheckstmt = $conn->prepare($newquery)){
                $userCheckstmt->bind_param('s', $userName);
                $userCheckstmt->execute();
                $userCheckstmt->store_result();
                $rows = $userCheckstmt->num_rows;
                    if($rows != 0){
                        array_push($error, ' - Username is taken ,');                        
                        echo "-Username \"$userName\" is taken";
                        $userCheckstmt->close();
                    }
                    else{
                            $userCheckstmt->close();
                    }
            }

                //SUCCESSFUL registration submition
            if (count($error) === 0){
                    //User admin True or false
                if(!empty($powerGiveAdmin)){
                    if($powerGiveAdmin === "true"){
                        $powerGiveAdmin = "TRUE";
                        echo "- User(Admin) can update website content,\n";
                    }
                    else{
                        $powerGiveAdmin = "FALSE";
                    }
                }
                if(!empty($powerServer)){
                    if($powerServer === "true"){
                        $powerServer = "TRUE";
                        echo "-User(Server) can view webserver information,\n";
                    }
                    else{
                        $powerServer = "FALSE";
                    }
                }
                if(!empty($powerAccounts)){
                    if($powerAccounts === "true"){
                        $powerAccounts = "TRUE";
                        echo "-User can view certian account information and logs,\n";                            
                    }
                    else{
                        $powerAccounts = "FALSE";
                    }
                }
                if(!empty($powerRegisterAdmins)){
                    if($powerRegisterAdmins === "true"){
                        $powerRegisterAdmins = "TRUE";
                        echo "-User can register new admins,\n";                            
                    }
                    else{
                        $powerRegisterAdmins = "FALSE";
                    }
                }
                if(!empty($powerDeleteAccounts)){
                    if($powerDeleteAccounts === "true"){
                        $powerDeleteAccounts = "TRUE";
                        echo "-User can delete accounts,\n";                            
                    }
                    else{
                        $powerDeleteAccounts = "FALSE";
                    }
                }

                    //Insert User information
                    $code = 'D';
                    $power = 'D';
                    $sqlRegister = "INSERT INTO $DBTableAdmins($DBUsername, $DBPassword, $DBFirstname, $DBLastname, $DBCode, 
                                            $DBPower, $DBAdminer, $DBServerAdmin, $DBViewAccounts, $DBRegisterNewAdmins, $DBDeleteAccounts) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                if($stmt = $conn->prepare($sqlRegister)){
                    $stmt->bind_param('sssssssssss', $userName, $password, $firstName, $lastName, $code, 
                                            $power, $powerGiveAdmin, $powerServer, $powerAccounts, $powerRegisterAdmins, $powerDeleteAccounts);
                    $stmt->execute();
                    echo "User-account ($userName) has been created. Ask a SuperUser to add any other needed permission.";
                    // if($stmt == false){
                    //     echo "stmt is true";
                    // }
                    $stmt->close();
                }
            }//if count error is 0 END
    }//RegNewAdmin function end

    function CheckUserNameAvailability(){
            file_get_contents("php://input");
            //Declaring Variables
        $userName = $_POST['Username'];
        $conn = $GLOBALS['DataBaseConnection'];
            //Database values
        $DBTableAdmins      =   $GLOBALS['DBTableAdminAccounts'];
        $DBUsername         =   $GLOBALS['databaseUsername'];
                //Preparing statement
                $newquery = "SELECT * FROM $DBTableAdmins WHERE $DBUsername = ? ";
            if($userCheckstmt = $conn->prepare($newquery)){
                $userCheckstmt->bind_param('s', $userName);
                $userCheckstmt->execute();
                $userCheckstmt->store_result();
                $rows = $userCheckstmt->num_rows;
                    if($rows != 0 && !empty($userName)){
                        echo "Username \"$userName\" is taken ,";
                        $userCheckstmt->close();
                    }
                    else{
                            echo "";
                        $userCheckstmt->close();                            
                    }
            }
            if (strlen($userName) < 4 OR strlen($userName) > 20) {
                if(!empty($userName)) {
                    echo 'Username must be 4-20 characters ,';
                }
            }
            if (!preg_match('#^[a-zA-Z0-9äöüÄÖÜ]+$#', $userName) && !empty($userName)) {
                echo 'Username can only contain letters and numbers ,';
            }   
    }
}//Register class end


class AdminInfo{
    function GetAdmins(){
            file_get_contents("php://input");
        $conn = $GLOBALS['DataBaseConnection'];
        //Database values
      $DBTableAdmins       = $GLOBALS['DBTableAdminAccounts'];
        $DBUserID           =   $GLOBALS['databaseUserID'];
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
        $DBAccountCreated   =   $GLOBALS['databaseAccountCreated'];
            //Preparing statement
                $newquery = "SELECT $DBUserID, $DBUsername, $DBFirstname, $DBLastname, $DBCode, $DBPower, $DBAdminer, $DBServerAdmin, $DBViewAccounts, $DBRegisterNewAdmins, $DBDeleteAccounts, $DBAccountCreated FROM $DBTableAdmins";
            if($stmt = $conn->prepare($newquery)){
                $stmt->execute();
                $stmt->bind_result($id, $username, $firstname, $lastname, $code, $power, $adminer, $serveradmin, $viewaccounts, $registeradmins, $deleteaccounts, $accountcreated);
                $stmt->store_result();
                    while ($stmt->fetch()) {
                        $data = array( 'user'=> array(
                            'id'=>$id, 
                            'username'=>$username, 
                            'firstname'=>$firstname, 
                            'lastname'=>$lastname, 
                            'code'=>$code, 
                            'power'=>$power, 
                            'adminer'=>$adminer, 
                            'serveradmin'=>$serveradmin, 
                            'viewaccounts'=>$viewaccounts, 
                            'registeradmins'=>$registeradmins, 
                            'deleteaccounts'=>$deleteaccounts, 
                            'accountcreated'=>$accountcreated));
                        $mynewdata[] = $data;
                    }
                    echo json_encode($mynewdata);
            }
    }


    function ChangeAdminer(){
            file_get_contents("php://input");
        $conn = $GLOBALS['DataBaseConnection'];
        //Database values
      $DBTableAdmins        =   $GLOBALS['DBTableAdminAccounts'];
        $DBUserID           =   $GLOBALS['databaseUserID'];
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
        $DBAccountCreated   =   $GLOBALS['databaseAccountCreated'];
            if(isset($_POST['username'])){
                $username = $_POST['username'];
                $permissionValue = $_POST['permissionValue'];
                $myEditFunction = $_POST['myeditFunction'];
                
                    if($permissionValue == "TRUE"){
                        $newValue = "FALSE";
                    }         
                    if($permissionValue == "FALSE"){
                        $newValue = "TRUE";
                    }


                    if($myEditFunction == "adminer"){
                        $myFunction = $DBAdminer;
                    }
                    if($myEditFunction == "serveradmin"){
                        $myFunction = $DBServerAdmin;
                    }
                    if($myEditFunction == "viewaccounts"){
                        $myFunction = $DBViewAccounts;
                    }
                    if($myEditFunction == "registeradmins"){
                        $myFunction = $DBRegisterNewAdmins;
                    }
                    if($myEditFunction == "deleteaccounts"){
                        $myFunction = $DBDeleteAccounts;
                    }

                    //Database controls
                        $newquery = "UPDATE $DBTableAdmins SET $myFunction=? WHERE $DBUsername=?";
                    if($stmt = $conn->prepare($newquery)){
                        $stmt->bind_param('ss', $newValue, $username);
                        $stmt->execute();
                        // $userCheckstmt->store_result();
                    }       
                        //Handle error if statement fails
                    if($stmt == false){
                        echo "Failed to make insertion...statement is false -IS";
                    }
            }
    }

    function DeleteAdminAccount(){
            file_get_contents("php://input"); 
        $conn = $GLOBALS['DataBaseConnection'];
            //Database values
      $DBTableAdmins        =   $GLOBALS['DBTableAdminAccounts'];
        $DBUserID           =   $GLOBALS['databaseUserID'];
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
        $DBAccountCreated   =   $GLOBALS['databaseAccountCreated'];
            $username = $_POST['username'];
                //Database controls
                    $newquery = "DELETE FROM $DBTableAdmins WHERE username=?";
                if($stmt = $conn->prepare($newquery)){
                    $stmt->bind_param('s', $username);
                    $stmt->execute();
                }       
                    //Handle error if statement fails
                if($stmt == false){
                    echo "Failed to make deletion...statement is false -IS";
                }
                    

    }
}



$Register = new Register();    
$AdminInfo = new AdminInfo();







//-------------NOTES --NOTES ----------------NOTES NOTES--------------NOTES NOTES NOTES---------

/*
    $data = array( 'user'=> array(
        'id'=>$id, 
        'username'=>$username, 
        'firstname'=>$firstname, 
        'lastname'=>$lastname, 
        'code'=>$code, 
        'power'=>$power, 
        'adminer'=>$adminer, 
        'serveradmin'=>$serveradmin, 
        'viewaccounts'=>$viewaccounts, 
        'registeradmins'=>$registeradmins, 
        'deleteaccounts'=>$deleteaccounts, 
        'accountcreated'=>$accountcreated));
*/
?>