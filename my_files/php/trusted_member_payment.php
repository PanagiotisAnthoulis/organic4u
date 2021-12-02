<?php

    include 'config.php';

    session_start();

    $_SESSION['member_price']=$_POST['price'];

    header("Location:".$_SERVER['HTTP_REFERER']."#!/trusted_member_payment");
?>