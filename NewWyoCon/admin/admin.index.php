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
        <a id="HomeBTN" class="HeadingBTN" href="../Index/index.php"><label>Home</label></a>
    </div>

    <input type="button" id="RegShowBTN" class="HideAndSeek" value="Register a New Admin"/>


    <form method="POST" id="RegisterSystem">
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