<?php

    include "config.php";

    $users=$db->users;

    $new_username=$_POST['new_username'];
    $new_fullname=$_POST['new_fullname'];
    $new_mail=$_POST['new_mail'];
    $new_phone=$_POST['new_phone'];

    $users->updateOne(array(
        "username"=>$_SESSION['logged_user']),
        array('$set'=>array(
                    "username"=>$new_username,
                    "fullname"=>$new_fullname,   
                    "mail"=>$new_mail,   
                    "phone"=>$new_phone,       
                )));
    
    $_SESSION['logged_user']=$new_username;
    
    header("Location:".$_SERVER['HTTP_REFERER']."#!/profile");

?>