<?php

    include "config.php";
    
    $_SESSION['remove_find_shop']=strtolower($_POST['shop_name']);

    header("Location:".$_SERVER['HTTP_REFERER']."#!remove_shop");

?>