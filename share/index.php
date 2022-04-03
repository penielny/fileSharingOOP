<?php


include './../inc/session.php';
include './../inc/File.php';
include './../inc/Account.php';
include './../inc/DBconn.php';


$isAuth = isLoggedIn();
if ($isAuth == false) {
    header('Location: ./../login/');
    exit();
}


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share to public</title>
</head>
<body>
    
</body>
</html>