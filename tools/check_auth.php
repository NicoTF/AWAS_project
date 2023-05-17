<?php

session_start();

if($_SESSION['auth'] != true) {
    header("Location: /login.php");
    exit();
}
/* else{
    global $DB;
    require_once("../tools/db_conn.php");

    $username = $_SESSION['username'];
    $uid = $_SESSION['uid'];

    $query = query("SELECT * FROM 'users' WHERE id = '$uid' and username = '$username'");
    $qresult = $query -> fetch(PDO::FETCH_ASSOC);


    if($qresult){

    }
    if($query == $username){
        header("Location: index.php");
        exit();
    }
    else{
        header("Location: login.php");
    }
} */
