<?php

include "../php/config.php";

    if(isset($_SESSION['logged_user'])){
        $user=$_SESSION['logged_user'];
    }
    else{
        $user='unsigned';
    }

    $fullname=$_POST['fullname'];
    $mail=$_POST['mail'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];
    $cart_shops=$_POST['cart_shops'];


    
    $products=$_POST['cart_product_names'];
    $quantities=$_POST['cart_product_quantities'];
    $prices=$_POST['cart_product_prices'];
    $product_dets=[];
    $total=0;

    echo "<br>Quants:<br>";
    print_r($quantities);

    $i=0;
    
    foreach($products as $product_name){
        
        $shop=$cart_shops[$i];
        
        $products_col=$db->products;
        $prod=$products_col->findOne(array("product_name"=>$product_name));
        $o=0;
        foreach($prod['product_shop'] as $prod_shop){
            
            if($prod_shop==$shop)
            {
                $prod['product_stock'][$o]-=$quantities[$o];
                
                $prod=$products_col->updateOne(array("product_name"=>$product_name),
                array('$set'=>array("product_stock"=>$prod['product_stock'])));
            }

        $o++;
        }


        $i++;
    }
    
    $today = date("F j, Y, g:i a"); ;

    for($i=0 ; $i<sizeof($products); $i++){
        array_push($product_dets,array("product_name"=>$products[$i],"product_quantity"=>$quantities[$i]));
        $total += floatval($prices[$i])*floatval($quantities[$i]); 
    }
    
    $orders=$db->orders;

    $order=array("username"=>$user,"customer_dets"=>array("fullname"=>$fullname,"mail"=>$mail,"address"=>$address,"city"=>$city,"zip"=>$zip),"products_dets"=>$product_dets,"cart_shops"=>$cart_shops,"date"=>$today,"total"=>$total);


    $orders->insertOne($order);
  
    setcookie('cart_products_'.$user,"", time()-36000,'/');

    header("Location:".$_SERVER['HTTP_REFERER']."#!/order_successful");

    ?>   
