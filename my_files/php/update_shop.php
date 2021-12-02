<?php

    include 'config.php';

    $shops = $db->shops;

    $prev_shop_name=$_POST['prev_shop_name'];
    $shop_name=preg_replace( '/\s+/', '_',$_POST['shop_name'] );
    $shop_name=strtolower($shop_name);
    $shop_mail=$_POST['shop_mail'];
    $shop_address=$_POST['shop_address'];
    $shop_desc=$_POST['shop_desc'];
    $shop_phone=$_POST['shop_phone'];

    if($_FILES['shop_image']['size'] != 0){
        
        $shop_image=addslashes($_FILES['shop_image']['tmp_name']);
	    $shop_image=file_get_contents($shop_image);
        $shop_image=base64_encode($shop_image);
       
        $shops->updateOne(array("shop_name"=>$prev_shop_name),
        array('$set'=>array("shop_image"=>"$shop_image")));
    }
   
    
    $shops->updateOne(array("shop_name"=>$prev_shop_name),
    array('$set'=>array("shop_mail"=>$shop_mail)));
    
    $shops->updateOne(array("shop_name"=>$prev_shop_name),
    array('$set'=>array("shop_desc"=>$shop_desc)));
    
    $shops->updateOne(array("shop_name"=>$prev_shop_name),
    array('$set'=>array("shop_address"=>$shop_address)));
    
    $shops->updateOne(array("shop_name"=>$prev_shop_name),
    array('$set'=>array("shop_phone"=>$shop_phone)));
    
    $shops->updateOne(array("shop_name"=>$prev_shop_name),
    array('$set'=>array("shop_name"=>$shop_name)));
    
   /*
    $prods=$products->find(array("product_name"=>$prev_product_name));
    foreach($prods as $a){
        echo $a['product_name'];    }*/
        header("Location:".$_SERVER['HTTP_REFERER']."#!update_shop");

?>