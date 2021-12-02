<?php

    include "config.php";
    
    $_SESSION['remove_find_product']=strtolower($_POST['product_name']);

    header("Location:".$_SERVER['HTTP_REFERER']."#!remove_product");

?>