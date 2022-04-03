<?php

session_start();


function isLoggedIn(){
    $res = false;
    if (isset($_SESSION['account_id']) || isset($_SESSION['id']) ) {
        $res  = true;
    }
    return $res;
}
