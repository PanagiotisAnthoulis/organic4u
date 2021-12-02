<?php

    include 'config.php';

    $products = $db->products;

    $product_name=preg_replace( '/\s+/', '_',$_POST['product_name'] );
    $product_name=mb_strtolower($product_name,'UTF-8');
    $product_price=$_POST['product_price'];
    $product_desc=$_POST['product_desc'];
    $product_quantity=$_POST['product_quantity'];
    
    $product_stock=$_POST['product_stock'];
    
    $product_stock=array_filter($product_stock);
    
    $product_shop=$_POST['product_shop'];

    $product_shop=array_filter($product_shop);

	$product_image=addslashes($_FILES['product_image']['tmp_name']);
	$product_image=file_get_contents($product_image);
	$product_image=base64_encode($product_image);
    
    $document= array(
        "product_name"=>$product_name, 
        "product_price"=>$product_price, 
        "product_desc"=>$product_desc, 
        "product_shop"=>$product_shop,
        "product_stock"=>$product_stock, 
        "product_image"=>$product_image);
    
    $products->insertOne($document);

    $_SESSION['add_success']='yes';

    header("Location:".$_SERVER['HTTP_REFERER']."#!/add_product");

    
?>