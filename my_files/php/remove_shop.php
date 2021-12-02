<?php
    include "config.php";

    $shops=$db->shops;
    $products=$db->products;

    $shops->deleteOne(array("shop_name"=>$_POST['shop_name']));
    $products->deleteMany(array("product_shop"=>$_POST['shop_name']));

    header("Location:".$_SERVER['HTTP_REFERER']."#!remove_shop");

?>