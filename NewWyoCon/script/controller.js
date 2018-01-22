

$('#RegisterSystem').hide();    
$(document).ready( function() {
        $('#RegShowBTN').click( function(){
            $('#RegisterSystem').slideToggle();
        });
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