<?php

    include 'config.php';

    $shops = $db->shops;

    $shop_name=preg_replace( '/\s+/', '_',$_POST['shop_name'] );
    $shop_name=mb_convert_case($shop_name,1,'UTF-8');
    $shop_mail=$_POST['shop_mail'];
    $shop_address=$_POST['shop_address'];
    $shop_phone=$_POST['shop_phone'];

    $shop_check=$shops->findOne(array("shop_name"=>$shop_name));

    if($shop_check==null){

	$shop_image=addslashes($_FILES['shop_image']['tmp_name']);
	$shop_image=file_get_contents($shop_image);
	$shop_image=base64_encode($shop_image);
    
    $document= array(
        "shop_name"=>$shop_name, 
        "shop_address"=>$shop_address, 
        "shop_mail"=>$shop_mail, 
        "shop_phone"=>$shop_phone, 
        "shop_image"=>$shop_image);
    
    $shops->insertOne($document);

    $_SESSION['add_shop']='yes';
    }
    
    else{
        $_SESSION['add_shop']='no';
    }
    header("Location:".$_SERVER['HTTP_REFERER']."#!/add_shop");

    
?>