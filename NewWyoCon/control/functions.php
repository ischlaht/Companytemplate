
<?php
include('class.php');



if(isset($_GET['functionRegUser'])){
        $Register->RegNewAdmin();
    }
    

if(isset($_GET['functionUserNameAvailability'])){
    $Register->CheckUserNameAvailability();    
}
    
if(isset($_GET['GetAdminNames'])){
    $AdminInfo->GetAdmins();
}

if(isset($_GET['ChangeAdminer'])){
    $AdminInfo->ChangeAdminer();
}

if(isset($_GET['DeleteAdmin'])){
    $AdminInfo->DeleteAdminAccount();
}

if(isset($_GET['BanAdmin'])){
    $AdminInfo->BanAdminAccount();
}



?>