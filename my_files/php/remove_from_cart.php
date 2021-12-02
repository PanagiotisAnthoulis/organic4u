<?php 
 include "../php/config.php";
 /* $qwe=$_COOKIE['cart_products'];
  $qwe=stripslashes($qwe);
  $qwe=json_decode($qwe,true);
    array_push($qwe,$cart_product);


    setcookie('cart_products',json_encode($qwe), time()+86400);
  

*/
    if(isset($_SESSION['logged_user'])){
        $cart_user=$_SESSION['logged_user'];
    }
    else{
        $cart_user='unsigned';
    }

    $product_to_del=$_POST['product_to_del'];
    
    $qwe=$_COOKIE['cart_products_'.$cart_user];
    $qwe=stripslashes($qwe);
    $qwe=json_decode($qwe,true);
    

    foreach($qwe as $eKey=>$e){
        foreach($e as $wKey=>$w){

            if($w['product_name']==$product_to_del){
                echo "in";
                unset($qwe[$eKey]);
                setcookie('cart_products_'.$cart_user,json_encode($qwe), time()+86400,'/');
                break;
            
            }
        }
    }
    if(empty($qwe)){        
        setcookie('cart_products_'.$cart_user,json_encode($qwe), time()-36000,'/');
    }

    header("Location:".$_SERVER['HTTP_REFERER']."#!/cart");


?> 