<?php


include './../inc/session.php';
include './../inc/File.php';
include './../inc/Account.php';
include './../inc/DBconn.php';

$uid = $_GET['id'];

$conn = new DBConnection(NULL);
$file =  new File($conn, null);
$file = $file->getUid($uid);




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

    <?php

    if ($file->privacy == 2) {
        echo " <b class=`font-bold text-center text-red-600 text-xl`> sorry this file is a private file and cant be downloaded </b>";
        exit();
    } else {
        echo "<a class=`p-3 bg-green-500 font-bold` download  href='./../store/$file->uid.$file->ext'>Download File</a>";
    }

    ?>


</body>

</html>