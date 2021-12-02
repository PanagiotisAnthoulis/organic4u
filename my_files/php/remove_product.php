<?php
    include "config.php";

    $products=$db->products;

    $products->deleteOne(array("product_name"=>$_POST['product_name']));

    header("Location:".$_SERVER['HTTP_REFERER']."#!remove_product");

?>