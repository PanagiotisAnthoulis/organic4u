<?php 


    include 'config.php';

    $users=$db->users;

    $users->updateOne(array("username"=>$_SESSION['logged_user']),
    array('$set'=>array("trusted"=>"yes")));

    header("Location:".$_SERVER['HTTP_REFERER']."#!/trusted_member_successful");


?>