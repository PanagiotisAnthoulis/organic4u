<?php

    include 'config.php';

    $products = $db->products;

    $prev_product_name=$_POST['prev_product_name'];
    $product_name=preg_replace( '/\s+/', '_',$_POST['product_name'] );
    $product_name=strtolower($product_name);



    $product_price=$_POST['product_price'];
    $product_desc=$_POST['product_desc'];

    $product_shop=$_POST['product_shop'];
    
    $product_shop=array_filter($product_shop);


    if($_FILES['product_image']['size'] != 0){
        
        $product_image=addslashes($_FILES['product_image']['tmp_name']);
	    $product_image=file_get_contents($product_image);
        $product_image=base64_encode($product_image);
       
        $products->updateOne(array("product_name"=>$prev_product_name),
        array('$set'=>array("product_image"=>"$product_image")));
    }

        
    $products->updateOne(array("product_name"=>$prev_product_name),
    array('$set'=>array("product_price"=>"$product_price")));

    $products->updateOne(array("product_name"=>$prev_product_name),
    array('$set'=>array("product_desc"=>"$product_desc")));

    $products->updateOne(array("product_name"=>$prev_product_name),
    array('$set'=>array("product_shop"=>$product_shop)));

    $products->updateOne(array("product_name"=>$prev_product_name),
    array('$set'=>array("product_name"=>"$product_name")));

   /*
    $prods=$products->find(array("product_name"=>$prev_product_name));
    foreach($prods as $a){
        echo $a['product_name'];    }*/
    header("Location:".$_SERVER['HTTP_REFERER']."#!update_product");
    
?>