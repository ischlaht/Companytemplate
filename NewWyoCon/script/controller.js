

$('#RegisterSystem').hide();    
$(document).ready( function() {
        $('#RegShowBTN').click( function(){
            $('#RegisterSystem').slideToggle();
        });
});
      

var RegisterApp = angular.module('RegisterSystem', ['ngSanitize']);

RegisterApp.controller('RegisterUser', ['$scope', '$http', function ($scope, $http) {
    $scope.RegNewAdmin = function(){
        if(confirm("Are You sure you want to register a new admin?")){
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
                    });
        }
    };
    $scope.UserAvailability = function(){
        var FD = new FormData();
        var Username = document.getElementById('Username').value;   
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
                    var usernamecss = $('#UsernameAvailability').text();        
                        if(usernamecss.length > 15){
                            $('#Username').css("border-color", "red");        
                                
                        }
                        if(usernamecss.length < 13){
                            $('#Username').css("border-color", "green");        
                                
                        }
                        if(Username.length == 0){
                            $('#Username').css("border-color", "red");        
                                
                        }
                    
                }); 
              
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
// var RegisterApp = angular.module('RegisterSystem', ['ngSanitize']);
// RegisterApp.controller('RegisterUser', ['$scope', '$http', function ($scope, $http) {
//     $scope.RegNewAdmin = function(){
//         //variables and binds
//         var FD = new FormData();
//         var Username = document.getElementById('Username').value;
//         var Password = document.getElementById('Password').value;
//         var Password2 = document.getElementById('Password2').value;
//         var Firstname = document.getElementById('Firstname').value;
//         var Lastname = document.getElementById('Lastname').value;
//         // var ERROR = document.getElementById('ERROR').value;
//         // var ERROR = $('#ERROR').text();
//         //apending the files to bind them
//         FD.append('Username', Username);
//         FD.append('Password', Password);
//         FD.append('Password2', Password2);
//         FD.append('Firstname', Firstname);
//         FD.append('Lastname', Lastname);
//         // AJAX request
//         $http({
//             method: 'POST',
//             url: '../control/test.php',
//             data: FD,
//             headers: {'Content-Type': undefined},
//         })
//             .then(function(response, data, header, status, config) {
//                 response.data;
//                 $scope.response = response.data;
//                 console.log(response.data);
//                 console.log('Jquery Success');
//                 // $scope.errorA = response.data;
//                 // document.getElementById("ERROR").textContent = response.data;
//                 // $('#ERROR').text(response.data);
//                 alert(response.data);
//             })
//     };
// }]);

// //Manually Bootstraping REGISTER SYSTEM app^^^^^^^^^^^^^^^^
// $('#RegisterSystem').ready( function() {
// angular.bootstrap($('#RegisterSystem'), ['RegisterSystem']);
// });

// // Reg user Controller
// $(document).ready( function() {

// });

// $('document').ready( function() {

// });

// $('document').ready( function() {

// });


// $('document').ready( function() {

// });


// $('document').ready( function() {

// });


// $('document').ready( function() {

// });


// $('document').ready( function() {

// });


// $('document').ready( function() {

// });


// $('document').ready( function() {

// });