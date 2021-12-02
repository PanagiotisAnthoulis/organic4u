<?php

    include "config.php";
    
    
    $_SESSION['update_find_shop']=strtolower($_POST['shop_name']);

    header("Location:".$_SERVER['HTTP_REFERER']."#!update_shop");

?>