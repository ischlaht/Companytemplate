
<?php
    require("conf.php");
    // $conn = mysqli_connect('localhost', 'root', '', 'companytemplate');
    
class Register{

    function RegNewAdmin(){
            file_get_contents("php://input");
        $con = $GLOBALS['conn'];
                        
        $userName = $_POST['Username'];
        $password = $_POST['Password'];
        $password2 = $_POST['Password2'];
        $firstName = $_POST['Firstname'];
        $lastName = $_POST['Lastname'];
            //Make Input fields UpperCase
        $userName = strtoupper($userName);
        $firstName = strtoupper($firstName);
        $lastName = strtoupper($lastName);
            //User Super Permissions
        $powerGiveAdmin = $_POST['GiveAdminCheck'];
        $powerServer = $_POST['GiveServerCheck'];
        $powerAccounts = $_POST['ViewAccountsCheck'];
        $powerRegisterAdmins = $_POST['RegisterAdminsCheck'];
        $powerDeleteAccounts = $_POST['DeleteAccountsCheck'];
            // error handling
        $error = array();
      
                //Empty fields validation
            if(empty($userName) OR empty($password) OR empty($password2) OR empty($firstName) OR empty($lastName)) {
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
            $newquery = "SELECT * FROM adminer WHERE userName = ? ";
            if($userCheckstmt = $GLOBALS['conn']->prepare($newquery)){
                $userCheckstmt->bind_param('s', $userName);
                $userCheckstmt->execute();
                $userCheckstmt->store_result();
                $rows = $userCheckstmt->num_rows;
                // printf("Number of rows: %d.\n", $userCheckstmt->num_rows);
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
                        echo "- User(Admin) can update website content ,";
                    }
                    else{
                        $powerGiveAdmin = "FALSE";
                    }
                }
                if(!empty($powerServer)){
                    if($powerServer === "true"){
                        $powerServer = "TRUE";
                        echo "-User(Server) can view webserver information,";
                    }
                    else{
                        $powerServer = "FALSE";
                    }
                }
                if(!empty($powerAccounts)){
                    if($powerAccounts === "true"){
                        $powerAccounts = "TRUE";
                        echo "-User can view certian account information and logs,";                            
                    }
                    else{
                        $powerAccounts = "FALSE";
                    }
                }
                if(!empty($powerRegisterAdmins)){
                    if($powerRegisterAdmins === "true"){
                        $powerRegisterAdmins = "TRUE";
                        echo "-User can register new admins,";                            
                    }
                    else{
                        $powerRegisterAdmins = "FALSE";
                    }
                }
                if(!empty($powerDeleteAccounts)){
                    if($powerDeleteAccounts === "true"){
                        $powerDeleteAccounts = "TRUE";
                        echo "-User can delete accounts,";                            
                    }
                    else{
                        $powerDeleteAccounts = "FALSE";
                    }
                }
                            //Encryption of Password
                    $password = md5($password);
                    $password2 = md5($password2);
                    //Insert User information
                    $code = 'D';
                    $power = 'D';
                    $sqlRegister = "INSERT INTO adminer(userName, password, firstName, lastName, code, 
                                            power, adminer, serverAdmin, viewAccounts, registerNewAdmins, deleteAccounts) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                if($stmt = $con->prepare($sqlRegister)){
                    $stmt->bind_param('sssssssssss', $userName, $password, $firstName, $lastName, $code, 
                                            $power, $powerGiveAdmin, $powerServer, $powerAccounts, $powerRegisterAdmins, $powerDeleteAccounts);
                    $stmt->execute();
                    $stmt->close();
                    echo "User-account ($userName) has been created. Ask a SuperUser to add any other needed permission.";
                }
            }//if count error is 0 END
    }//RegNewAdmin function end

    function CheckUserNameAvailability(){
        file_get_contents("php://input");
            //Declaring Variables
        $userName = $_POST['Username'];
        $error = array();
            //Preparing statement
        $newquery = "SELECT * FROM adminer WHERE userName = ? ";
            if($userCheckstmt = $GLOBALS['conn']->prepare($newquery)){
                $userCheckstmt->bind_param('s', $userName);
                $userCheckstmt->execute();
                $userCheckstmt->store_result();
                $rows = $userCheckstmt->num_rows;
                    if($rows != 0 && !empty($userName)){
                        array_push($error, ' - Username is taken ,');                        
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
                    array_push($error, '- Username is to short or to long ,');
                    echo 'Username must be 4-20 characters ,';
                }
            }
            if (!preg_match('#^[a-zA-Z0-9äöüÄÖÜ]+$#', $userName) && !empty($userName)) {
                array_push($error, '- Username must only contain letters and numbers ,');
                echo 'Username can only contain letters and numbers ,';
            }   
    }
}//Register class end



//CALLING CLASSES_____________________CALLING CLASSES_______________ CALLING CLASSES_____________________ CALLING CLASSES__________ CALLING CLASSES____
$Register = new Register();
?>