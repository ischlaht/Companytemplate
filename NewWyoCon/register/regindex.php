<?php  require('../control/session.php'); ?>

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
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  <!-- Anguular/maybe ajax??? CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  <!-- Angular animate -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>
       <!--  Allows you to sanatize all angular data :D -->
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>

  <!-- Linking files -->
    <link href="reg.css" rel="stylesheet">

    <!-- Javascript testing -->
</head>



<body>
<script src="../script/controller.js"></script>
    <div id="HeadingContainer">
        <h1>Admin Master Page</h1>
        <p>Use this page to &#9758; Manage Account, &#9758; Add new Admins, &#9758; Delete Admins, &#9758; View Websites Details </p>
        <a id="HomeBTN" class="HeadingBTN" href="../Index/Index.php"><label>Home</label></a>
    </div>

    <input type="button" id="RegShowBTN" class="HideAndSeek" value="Register a New Admin"/>


    <form method="POST" enctype="multipart/form-data" id="RegisterSystem">
        <div id="RegInfoContainer" ng-controller="RegisterUser">
            <ul><label>UserName :</label>
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
            <ul><label>View User Accounts</label>
                <input type="checkbox" id="ViewAccountsCheck" name="ViewAccountsCheck"/>
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
    </form><!--Login Container -->




    <?php

    ?>


<script>
var RegisterApp = angular.module('RegisterSystem', ['ngSanitize']);

RegisterApp.controller('RegisterUser', ['$scope', '$http', function ($scope, $http) {
    $scope.RegNewAdmin = function(RegUser){
        //variables and binds
        var FD = new FormData();
        var Username = document.getElementById('Username').value;
        var Password = document.getElementById('Password').value;
        var Password2 = document.getElementById('Password2').value;
        var Firstname = document.getElementById('Firstname').value;
        var Lastname = document.getElementById('Lastname').value;
        var RegUser = document.getElementById('RegUser').value;
            //User Permissions Bariables
        var GiveAdminCheck = document.getElementById('GiveAdminCheck').checked;
        var GiveServerCheck = document.getElementById('GiveServerCheck').checked;
        var ViewAccountsCheck = document.getElementById('ViewAccountsCheck').checked;
        var RegisterAdminsCheck = document.getElementById('RegisterAdminsCheck').checked;
        var DeleteAccountsCheck = document.getElementById('DeleteAccountsCheck').checked;
            //appending the files to bind them
        FD.append('Username', Username);
        FD.append('Password', Password);
        FD.append('Password2', Password2);
        FD.append('Firstname', Firstname);
        FD.append('Lastname', Lastname);
            //User permission binding and appending
        FD.append('GiveAdminCheck', GiveAdminCheck);
        FD.append('GiveServerCheck', GiveServerCheck);
        FD.append('ViewAccountsCheck', ViewAccountsCheck);
        FD.append('RegisterAdminsCheck', RegisterAdminsCheck);
        FD.append('DeleteAccountsCheck', DeleteAccountsCheck);
            // AJAX request
            $http({
                method: 'POST',
                url: '../control/functions.php?functionRegUser="true"',
                data: FD,
                headers: {'Content-Type': undefined},
            })
                .then(function(response, data, header, status, config) {
                    console.log('Agnular Success');
                    response.data;
                    $scope.response = response.data;
                    $('#RegERROR').text(response.data);
                    console.log(response.data);
                    console.log(response.header); 
                });
    };
    $scope.UserAvailability = function(){
        var FD = new FormData();
        var Username = document.getElementById('Username').value;   
        // var usernamecsss = $('#UsernameAvailability').text();        
        FD.append('Username', Username);             
            $http({
                method: 'POST',
                url: '../control/functions.php?functionUserNameAvailability="true"',
                data: FD,
                headers: {'Content-Type': undefined},
            })
                .then(function(response, data, header, status, config) {
                        response.data;
                        $scope.response = response.data;
                        console.log(response.data);
                        $('#UsernameAvailability').text(response.data);
                });
    // var usernamecss = document.getElementById('UsernameAvailability').value;
    
    //             if(usernamecss.length < 5){
    //                     alert('hay');
    //             }
    //             else{ alert('it works');}
    }
    $scope.CheckPassword = function(password){
        var password = document.getElementById('Password').value;
        var password2 = document.getElementById('Password2').value;                
        var checkpassword = document.getElementById('CheckPassword').value;
            if(password.length < 6){
                $('#CheckPassword').text('Password must be atleast 6 characters!');
                $('#Password').css("border-color", "red");
            }
            if(password.length != 0 && password.length > 5){
                $('#CheckPassword').text('');     
                $('#Password').css("border-color", "green");                       
            }
            if(password === password2 && password2.length > 5 && password.length != 0){
                $('#Password2').css("border-color", "green");
                $('#CheckConfirmPassword').text('');                                                                            
            }
            if(password != password2 && password2.length > 5  && password.length != 0){
                $('#Password2').css("border-color", "red");  
                $('#CheckConfirmPassword').text('Passwords do not match');                                                                    
            }
            if(password.length == 0){
                $('#CheckPassword').text('');     
                $('#Password').css("border-color", "red"); 
            }
    }
    $scope.CheckConfirmPassword = function(password2){
        var password = document.getElementById('Password').value;
        var password2 = document.getElementById('Password2').value;        
            if(password === password2){
                $('#Password2').css("border-color", "green");
                $('#CheckConfirmPassword').text('');                     
            }
            if(password != password2){
                $('#Password2').css("border-color", "red");
                $('#CheckConfirmPassword').text('Passwords do not match');               
            }
            if(password2.length < 6){
                $('#Password2').css("border-color", "red");                       
            }
            if(password2.length == 0){
                $('#Password2').css("border-color", "red");    
                $('#CheckConfirmPassword').text('');                                                        
            }

    }
    $scope.CheckName = function(firstname, lastname){
        var firstname = document.getElementById('Firstname').value;
        var lastname = document.getElementById('Lastname').value;        
            if(firstname.length == 0){
                $('#Firstname').css("border-color", "red");
            }
            if(firstname.length > 0){
                $('#Firstname').css("border-color", "green");
            }
            if(lastname.length == 0){
                $('#Lastname').css("border-color", "red");                       
            }
            if(lastname.length > 0){
                $('#Lastname').css("border-color", "green");    
            }

    }

}]);
//Manually Bootstraping REGISTER SYSTEM app^^^^^^^^^^^^^^^^
$('#RegisterSystem').ready( function() {
angular.bootstrap($('#RegisterSystem'), ['RegisterSystem']);
});

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