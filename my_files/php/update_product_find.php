<?php

    include "config.php";
    
    
    $_SESSION['update_find_product']=strtolower($_POST['product_name']);

    header("Location:".$_SERVER['HTTP_REFERER']."#!update_product");

?>