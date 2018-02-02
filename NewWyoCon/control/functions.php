
<?php
// require('conf.php');
include('class.php');

if(isset($_GET['functionRegUser'])){
        $Register->RegNewAdmin();
    }
    

    if(isset($_GET['functionUserNameAvailability'])){
        $Register->CheckUserNameAvailability();    
    }
    




?>