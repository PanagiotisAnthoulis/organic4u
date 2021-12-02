<?php 
    include '../php/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div class='pb-3 pt-3' id='history_wrapper'>
            
            <h3 style='font-family:"Lobster"' class='text-center'>My History</h3>
        <?php 
            if(!isset($_SESSION['logged_user'])){
                ?>
                    
                    <h2 class='text-center'>To access your order history you need to log in.</h2> 
                        <div class='d-flex flex-column text-center'>
                            <button onclick="form_appear(document.getElementById('log_in_form'))" style='width:fit-content;outline:unset' class='stroke mx-auto second_log_sign'>Click here to log in</button> 
                            or 
                            <button onclick="form_appear(document.getElementById('sign_up_form'))" style='width:fit-content;outline:unset' class='stroke mx-auto second_log_sign'>Click here to sign up</button>
                        </div>
                        <?php
            }
            else{
                
                $orders=$db->orders;
                
                $order_check=$orders->findOne(array("username"=>$_SESSION['logged_user']));
                
                $orders=$orders->find(array("username"=>$_SESSION['logged_user']));
                
                
                $products=$db->products;
                
                if($order_check){
                    
                    ?>
                
                <div id='order_history' class='w-75 mx-auto d-flex flex-column'>

                        <?php

                        foreach( $orders as $order){
                            $i=0;
                            ?>
                            <table class='history_order'>
                                <tr><td colspan='5'><h4 class='text-center'> <?php echo $order['date']; ?></h4></td></tr>
                                <tr class='text-center'><td colspan='2'>Product</td><td>Shop</td><td>Price</td><td>Quantity</td></tr>
                                    <?php
                                    foreach($order['products_dets'] as $product_dets){ ?>
                                        <tr class='text-center'>
                                            <?php 
                                            $product=$products->findOne(array("product_name"=>$product_dets['product_name']));
                                            if($product){
                                            ?>
                                            
                                            <td class='pt-3'> 
                                                <?php
                                                echo "<img style='border-radius: 12px;' width='100px' id='photo_".$product_dets['product_name']."' class='mx-auto cat_img d-block' src='data:image;base64,".$product['product_image']."'>";
                                                ?>
                                            </td>

                                            <td class='text-center'>
                                                <?php
                                                echo mb_convert_case(str_replace("_"," ",$product['product_name']),2,"UTF-8"); 
                                                ?>    
                                            </td>

                                            <td>
                                                <?php echo mb_convert_case(str_replace("_"," ",$order['cart_shops'][$i]),2,"utf-8"); ?>
                                            </td>
                                            
                                            <td>
                                                <?php
                                                    echo mb_convert_case(str_replace("_"," ",$product['product_price']),2,"UTF-8")."€"; 
                                                ?> 
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $product_dets['product_quantity'];
                                               ?>
                                            </td>
                                    </tr>
                                    <?php
                                    $i++;
                                     }
                                    else{
                                        ?>
                                    <tr><td colspan='3'><h3>This product has been removed.</h3></td></tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                    <td class='text-center' colspan='5'>
                                        <h2>Total:
                                            <?php 
                                            echo $order['total'].'€';
                                        ?>
                                        </h2>
                                    </td>
                                    </tr>
                            </table>
                        <?php }
                        }
                      
                        ?>
                </div>
                        
                <?php
                }
                else{
                    ?>
                    <i><h3 class='text-center mt-4' >No orders in history.</h3></i>
                <?php
                }
            }
        ?>
    </div>

</body>
</html>