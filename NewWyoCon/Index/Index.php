
<!-- PHP class files -->
<?php 
  require('../control/functions.php');
  require('../control/session.php');
  include('../control/Login.Controller.php');  
  include('../AdminBar/Primary.php');   

?>

<!Doctype html>
<html lang="en">
<head>
  <title>WYOConcrete</title>

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
    <!-- For ng sanitize -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>

  <!-- Linking files -->
    <script src="../script/controller.js"></script>
    <link href="main.css" rel="stylesheet">

    <!-- Javascript testing -->
    <script>
    </script>
</head>



<body>
    <form id="LoginSystem" method="POST" action="Index.php">
        <label>Username :</label>
        <input type="text" id="UserName" name="UserName" value="<?php  if(isset($_COOKIE['UserName'])){ echo $_COOKIE['UserName'];} elseif(isset($_POST['UserName'])){ echo $_POST['UserName'];} ?>">
        <label>Password</label>
        <input type="password" id="Password" name="Password" value="<?php if(isset($_POST['Password'])){ echo $_POST['Password'];} ?>">
        <input type="submit" id="LoginUser" name="LoginUser"/>
        <a href="Index.php" id="ReturnToIndex">Return to Index</a>
        <a href="../admin/admin.index.php">Register</a>
        
    </form><!--Login Container -->
</body>
</html>