<?php
    include "config.php";
    
    $product_name=$_POST['product_name'];
    
    $product_quantity=$_POST['product_quantity'];

    if(isset($_SESSION['logged_user'])){
        $cart_user=$_SESSION['logged_user'];
    }
    else{
        $cart_user='unsigned';
    }
    
    $shop=$_POST['product_shop'];
    
    $cart_product=array("cart_product"=>array(
        "cart_id"=>uniqid(),
        "product_shop"=>$shop,
        "product_name"=>$product_name,
        "product_quantity"=>$product_quantity,
        "cart_user"=>$cart_user));
    
        if(!isset($_COOKIE['cart_products_'.$cart_user])){
            $array=array();
            array_push($array,$cart_product);
            setcookie('cart_products_'.$cart_user,json_encode($array), time()+86400,'/');
        }
        
        elseif(isset($_COOKIE['cart_products_'.$cart_user])){

            $qwe=$_COOKIE['cart_products_'.$cart_user];
            $qwe=stripslashes($qwe);
            $qwe=json_decode($qwe,true);
            
            array_push($qwe,$cart_product);

            setcookie('cart_products_'.$cart_user,json_encode($qwe), time()+86400,'/');
        
        }
        echo $_COOKIE['cart_products_'.$cart_user];

        if(isset($_POST['prod'])){
            header("Location:".$_SERVER['HTTP_REFERER']."#!/product_page");
        }
        else{
            header("Location:".$_SERVER['HTTP_REFERER']);
        }

?>