<?php  
    require('../control/session.php'); 
    require('../control/Login.Controller.php'); 
    include('../AdminBar/Primary.php');  
  ?>

<?php 

if(isset($_COOKIE['UserName']) && $_COOKIE['Session'] === 'TRUELY'){
}

else{
    echo "Must be an admin to enter this page!";
    header('location: ../Index/index.php');
    echo $_COOKIE['Session'];
}


?>
<!Doctype html>
<html lang="en">
<head>
  <title>King Systems DEV. Pre-System</title>

  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">    
  <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <!-- jQuery CDN -->
    <script src="../Lib/JQuery/node_modules/jquery/dist/jquery.js"></script>
  <!-- Anguular/maybe ajax??? CDN -->
    <script src="../Lib/Angular/Ng-Main/node_modules/angular/angular.min.js"></script>    
  <!-- Angular animate -->
    <script src="../Lib/Angular/Ng-Animate/node_modules/angular-animate/angular-animate.js"></script>
       <!--  Allows you to sanatize all angular data :D -->
  <script src="../Lib/Angular/Ng-Sanitize/node_modules/angular-sanitize/angular-sanitize.js" type="text/javascript"></script>  
  <!-- Angular cookies service -->
  <script src="../Lib/Angular/Ng-Cookies/node_modules/angular-cookies/angular-cookies.js"></script>

  <!-- Linking files -->
    <link href="reg.css" rel="stylesheet">

    <!-- Javascript testing -->
</head>



<body>
<script src="../script/controller.js"></script>
    <div id="HeadingContainer">
        <h1>Admin Master Page</h1>
        <p>Use this page to &#9758; Manage Account, &#9758; Add new Admins, &#9758; Delete Admins, &#9758; View Websites Details </p>
        <a id="HomeBTN" class="HeadingBTN" href="../Index/index.php"><label>Home</label></a>
    </div>

    <input type="button" id="RegShowBTN" class="HideAndSeek" value="Register a New Admin"/>

    <form method="POST" class="ng-cloak" id="RegisterSystem">
        <div id="RegInfoContainer" ng-controller="RegisterUser">
            <ul><label>Username :</label>
                <input type="text" id="Username" class="form-control" ng-keyup="UserAvailability()" ng-controller="RegisterUser" name="Username"/>
            <div id="UsernameAvailability" class="AvailMessage"></div>
            </ul>
            <ul><label>Password :</label>
                <input type="password" id="Password" class="form-control" ng-keyup="CheckPassword()" ng-controller="RegisterUser" name="Password"/>
            <div id="CheckPassword" class="AvailMessage"></div>            
            </ul>
            <ul><label>Confirm Password :</label>
                <input type="password" id="Password2" class="form-control" ng-keyup="CheckConfirmPassword()"ng-controller="RegisterUser" name="Password2"/>
            <div id="CheckConfirmPassword" class="AvailMessage"></div>                        
            </ul>
            <ul><label>Firstname :</label>
                <input type="text" id="Firstname"  class="form-control"ng-keyup="CheckName()" ng-controller="RegisterUser" name="Firstname"/>
            </ul>
            <ul><label>Lastname :</label>
                <input type="text" id="Lastname" class="form-control" ng-keyup="CheckName()" ng-controller="RegisterUser" name="Lastname"/>
            </ul>
            <div id="RegERROR" name="ERROR" class="ERROR"></div>
        </div>
        
        <div id="RegPermissionsContainer">
            <?php //if(isset($_SESSION['Admin'])){ echo $_SESSION['Admin'];} ?>
            <ol> User Permissions</ol>
            <ul><label>Admin</label>
                <input type="checkbox" id="GiveAdminCheck" name="GiveAdminCheck" />
            </ul> <?php //`}  else{ echo "";}?>
            <ul><label>Server</label>
                <input type="checkbox" id="GiveServerCheck" name="GiveServerCheck"/>
            </ul>
            <ul><label>Ban Admins</label>
                <input type="checkbox" id="BanAdminsCheck" name="BanAdminsCheck"/>
            </ul>
            <ul>
            <label>Register Admins</label>
                <input type="checkbox" id="RegisterAdminsCheck" name="RegisterAdminsCheck"/>
            </ul>
            <ul><label>Delete Accounts</label>
            <input type="checkbox" id="DeleteAccountsCheck" ng-name="DeleteAccountsCheck"/>
            </ul>
                <input type="submit" id="RegUser" ng-controller="RegisterUser" name="RegUser" ng-click="RegNewAdmin()" value="Create Account"/>
            
        </div>
        <div id="PermissionInfo">
            <h2>Permission Information</h2>
                <label>Admin :</label>
                    <ul>Allows User to update, upload, and delete information on the public website.</ul>
                <label>Server :</label>
                    <ul>Allows user to View Webisite information like payments, due-dates, log-files, etc.</ul>
                <label>View User Accounts :</label>
                    <ul>Allows user to view Admin list</ul>
                <label>Register Admins :</label>
                    <ul>Allow user to register new admins</ul>
                <label>Delete Admins :</label>
                    <ul>Allow user to Delete Admin Accounts *Note: Only server owner can give this ability</ul>

        </div>

        <div id="RegRulesContainer">
            <h2>Rules For Registration</h2>
                <li>All fields are required.</li>
                <li>Username : must be between 4-20 letters/numbers long, Cannot use special characters.</li>
                <li>Password : must be atleast 6 characters long.</li>
        </div>





    </form><!--registration Container -->

    <form method="POST" ng-Controller="GetAdmins" class="ng-cloak" id="AdminEditSystem">
            <input style="width: 100%; height: 40px;" type="submit" ng-init="GetAdminNames()" ng-click="GetAdminNames()" value="Refresh"/>
        <div id="GetAdminNames" ng-init="GetAdminNames()">
                    <label class="editLabel">Firstname : </label>
                    <label class="editLabel">Lastname : </label>
                    <label class="editLabel">UserName : </label>
                    <label class="editLabel">Website Admin :</label>
                    <label class="editLabel">ServerAdmin</label>    
                    <label class="editLabel">Ban Admins</label>  
                    <label class="editLabel">Register Admins</label>  
                    <label class="editLabel">Delete Accounts</label>  
                    <label class="editLabel">Acc. Created</label>     
                <div id="retData" ng-repeat="Records in Records track by $index">
                        <ul>{{Records.user.firstname}}</ul>
                        <ul>{{Records.user.lastname}}</ul>
                        <ul>{{Records.user.username}}</ul>
    
                        <img ng-src="../Images/Buttons/KSDTruebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.adminer, 'adminer')" ng-if="Records.user.adminer == 'TRUE'" class="ChangePermissionsBTN ng-cloak" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDFalsebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.adminer, 'adminer')" class="ChangePermissionsBTN ng-cloak" ng-if="Records.user.adminer == 'FALSE'" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>
            
                        <img ng-src="../Images/Buttons/KSDTruebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.serveradmin, 'serveradmin')" ng-if="Records.user.serveradmin == 'TRUE'" class="ChangePermissionsBTN ng-cloak" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDFalsebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.serveradmin, 'serveradmin')" class="ChangePermissionsBTN ng-cloak" ng-if="Records.user.serveradmin == 'FALSE'" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>
                       
                        <img ng-src="../Images/Buttons/KSDTruebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.banadmins, 'banadmins')" ng-if="Records.user.banadmins == 'TRUE'" class="ChangePermissionsBTN ng-cloak" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDFalsebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.banadmins, 'banadmins')" class="ChangePermissionsBTN ng-cloak" ng-if="Records.user.banadmins == 'FALSE'" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDTruebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.registeradmins, 'registeradmins')" ng-if="Records.user.registeradmins == 'TRUE'" class="ChangePermissionsBTN ng-cloak" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDFalsebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.registeradmins, 'registeradmins')" class="ChangePermissionsBTN ng-cloak" ng-if="Records.user.registeradmins == 'FALSE'" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDTruebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.deleteaccounts, 'deleteaccounts')" ng-if="Records.user.deleteaccounts == 'TRUE'" class="ChangePermissionsBTN ng-cloak" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <img ng-src="../Images/Buttons/KSDFalsebtn.png" ng-click="ChangeAdmin(Records.user.username, Records.user.deleteaccounts, 'deleteaccounts')" class="ChangePermissionsBTN ng-cloak" ng-if="Records.user.deleteaccounts == 'FALSE'" style="width: 150px; height: 30px; color: green; font-size: 130%; margin-bottom: 0px; padding: 0px; margin-left: 25px; margin-right: 18px;"/>

                        <ul style="color: white">{{Records.user.accountcreated}}</ul>

                        <input type="button" ng-if="Records.user.code != 'BAN' && banAdminsCookie == 'TRUE'" class="BanAdminBTN" ng-click="BanAdmin(Records.user.username, Records.user.code)" value="Ban"/>

                         <input type="button" ng-if="Records.user.code == 'BAN' && banAdminsCookie == 'TRUE'" class="BanAdminBTN" ng-click="BanAdmin(Records.user.username, Records.user.code)" value="Un-ban"/>

                        <input type="button" class="DeleteAdminBTN" ng-click="DeleteAdmin(Records.user.username)" value="X"/>

                        

           
                        
                </div>
            
        </div>
    
    </form>


<script>






// $(document).ready( function() {
//     $(document).click( function() {
//         var check = document.getElementById('GiveAdminCheck').checked;
//             if(check === true){
//                 alert(check);
//             }
//     })
// });
</script>




</body>
</html>