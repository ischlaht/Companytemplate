
<?php



// function Logout($LogOut){
    // $LogOut = $_POST['LogOut'];
    if(isset($_POST['LogOutt'])){
    $CookieFix = $GLOBALS['Cookie'];
                            //Setting Cookies
    setcookie('Session',       '', time()-10, '/', $CookieFix, false);
    setcookie('UserName',      '', time()-10, '/', $CookieFix, false);
    setcookie('Admin',         '', time()-10, '/', $CookieFix, false);
    setcookie('ServerAdmin',   '', time()-10, '/', $CookieFix, false);
    setcookie('ViewAccounts',  '', time()-10, '/', $CookieFix, false);
    setcookie('RegAdmins',     '', time()-10, '/', $CookieFix, false);
    setcookie('DeleteAccounts','', time()-10, '/', $CookieFix, false);
    setcookie('Code',          '', time()-10, '/', $CookieFix, false);
    echo "logged out";
    echo "<script>alert('You Have Logged-Out!');</script>";
}
// }

if(isset($_COOKIE['Session'])){

    if(isset($_COOKIE['UserName']) && $_COOKIE['Session'] === 'TRUELY'){
        
?>


        <form method='POST' id="AdminBarContainer"> 
            <h4> Welcome <?php echo $_COOKIE['UserName']?></h4>
            <input type='submit' name='LogOutt' value="Logout"/>
        </form>



<?php //";
        }
    

    else{
        
    }
}



?>
<style>
#AdminBarContainer{
    width: 360px;
    height: 70px;
    position: fixed;
    right: 10px;
    top: 5px;
    background-color: darkgrey;
    padding: 10px;
    border-radius: 5px;
}
input[name='LogOutt']{
    font-size: 110%;
    width: 80px;
    height: 60px;
    position: absolute;
    right: 5px;
    top: 5px;
    border-radius: 5px;
    color: white;
    background-color: red;
}
input[name='LogOutt']:hover{
    color: black;
    background-color: green;
}
</style>




