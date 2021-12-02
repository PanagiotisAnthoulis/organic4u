<?php 
    include "../php/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $shop_name=$_SESSION['shop_name'];
        
        $shops=$db->shops;
        $shop=$shops->findOne(array("shop_name"=>$shop_name));
    
    ?>
    <!-- SHOP DISPLAY -->
    <div class='mx-auto mt-5 d-flex flex-column' id='shop_det_div'>
        <h2 class='text-center'><b><?php echo mb_convert_case(str_replace("_"," ",$shop['shop_name']),2,'UTF-8'); ?></b></h2>
        <div class='d-flex align-items-center'>
            <div class='flex-grow-1'>
            <?php 
                
                echo "<img width='200px' id='photo_".$shop['shop_name']."' class='mx-auto cat_img d-block' src='data:image;base64,".$shop['shop_image']."'>";


            ?>
            </div>
            <div class='flex-grow-1'>
                <ul>
                    <li>
                        Phone:
                        <?php echo  $shop['shop_phone']; ?>
                    </li>
                    <li>
                        Address:
                        <?php echo  $shop['shop_address']; ?>
                    </li>
                    <li>
                        Address:
                        <?php echo  $shop['shop_mail']; ?>
                    </li>
                    <li>
                        <?php 

                        $shop_comments=$db->shop_comments;
                        $shop_comments=$shop_comments->find(array("shop_name"=>$shop['shop_name']));
                        
                        $total=0;
                        $i=0;
                        
                        foreach($shop_comments as $comment){
                            $total=$comment['rating']+$total;
                            $i++;      
                        }
                        if($i==0){
                            echo 0;
                        }
                        else{
                            echo round($total/$i,1);
                        }
                        ?>&#9733;
                    </li>   
                </ul>
            </div>
        </div>
    </div>
    
    <!-- PRODUCTS DISPLAY -->
    <div id='prod_det_div' style='width:800px' class='mx-auto d-flex align-items-strech flex-column mt-5'>
        <h2 class='text-center' style='font-family:"Lobster";'>Products from this shop</h2>
        <?php 
            $products=$db->products;
            $products=$products->find(array("product_shop"=>$shop_name));

            foreach( $products as $product){
                ?>
                <div class='shop_page_product  d-flex align-items-center p-3 pl-2 pr-2'>
                    <div class='pr-2'>
                        <form action="../php/product_det.php" method="POST">
                            <input class='m-3' name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                            <div  style='width:fit-content;'>
                                <button type="submit" style='border:none;'> 
                                    <?php 
                                    echo "<img width='200px'  id='photo_".$product['product_name']."' class='flex-grow-1 cat_img d-block' src='data:image;base64,".$product['product_image']."'>";
                                    ?>
                                </button>
                            </div> 
                        </form>
                    </div>
                    <div class='flex-grow-1 align-self-start d-flex flex-column'>
                        <h2 class='text-center' style='font-family:Sriracha'><?php echo mb_convert_case(str_replace("_"," ",$product['product_name']),2,"utf-8"); ?></h2>
                        <div class='flex-grow-1'>
                            <?php echo $product['product_desc']; ?>
                        </div>
                        <div class='flex-grow-1 text-right'>
                            <h3>
                                <?php echo $product['product_price']; ?>€
                            </h3>
                        </div>
                        <form class='align-self-end' style='width:fit-content' action="../php/product_det.php" method="POST">
                            <input class='m-3' name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                            <div  style='width:fit-content;'>
                                <button style='border:none;' class='result_product_buttons' type="submit"> 
                                   See more...
                                </button>
                            </div> 
                        </form>
                    </div>
                </div>
                <?php 
            }
        ?>
    </div>
    
    <div class='mx-auto mt-5 d-flex flex-column' id='comments_div'>
        <h3 class='text-center'>Comments</h3>
        <form action="../php/submit_shop_comment.php" method="post">
            <div class='d-flex flex-column'>
                    <?php 
                    
                    if(!isset($_SESSION['logged_user'])){
                        ?>
                        <div class='d-flex align-items-center'>
                            <div class='flex-grow-1'>
                        <?php
                        $bought='yes';
                        
                        ?>Insert your name here: <input class='inputs' required type="text" name='user'>    
                        
                        <?php
                        }
                        else{ ?>
                            <div class='d-flex flex-column align-items-center'>
                                <div class='inputs flex-grow-1'>
                            <?php
                            $orders=$db->orders;
                            $orders=$orders->find(array("username"=>$_SESSION['logged_user']));
                            $bought='no';

                            foreach($orders as $order){
                                foreach($order['cart_shops'] as $cart_shop ){
                                    if($cart_shop==$shop['shop_name']){
                                        $bought='yes';
                                        break;
                                    }
                                    else{
                                        $bought='no';
                                    }
                                }
                            }
                            
                            if($bought=='yes'){
                            ?>
                            Comment as :
                            <input required hidden type="text" value='<?php echo $_SESSION['logged_user']; ?>' name='user'>
                            <?php
                            echo "<i><b>".$_SESSION['logged_user']."</b></i>";
                            }

                            elseif($bought=='no'){
                                ?>
                                <h5 style='width:max-content'>
                                    You need to buy from <b><i><?php echo  mb_convert_case(str_replace("_"," ",$shop['shop_name']),2,'utf-8'); ?></i></b> in order to leave a comment.
                                </h5>
                                <?php    
                            }
                        }
                        ?>                  
                    </div>
            <?php
                if(isset($bought) && $bought=='yes'){
            ?>  
                    <div class="rate">
                        <input required type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input required type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input required type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input required type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input required type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                  
                </div>
                <input hidden name="shop_name" value='<?php echo $shop['shop_name']; ?>'>
                <textarea class='w-100 inputs mt-3 mb-2' name="comment" id="comment_area" cols="30" rows="10"></textarea>
                    <button class='clear_button form_buttons mt-1 mb-3' type="submit">Upload Comment</button>
                </div>
                <?php }
                    ?>
            </form> 
            
            <!-- ALL COMMENTS -->
            
            <div class='w-100 d-flex flex-column'>
                <?php
            
            $shop_comments=$db->shop_comments;
            $comments=$shop_comments->find(array("shop_name"=>$shop['shop_name']));            
            
            foreach($comments as $comment){
                ?>

                <div class='comment_div'>
                    <div class='d-flex justify-content-between'>
                        <div class='user'>
                            <b>
                            <?php
                                echo $comment['user'];
                                ?>
                            </b>
                        </div>
                        
                        <div class='rating'>
                            <?php 
                                if($comment['rating']==""){
                                    ?> 
                                    <i>No rating</i> 
                                    <?php
                                }
                                else{
                                    echo $comment['rating'];
                                    ?>
                                    
                                    &#9733;

                                    <?php
                                }
                                
                            ?>
                        </div>
                    </div>
                    <div class='comment'>
                        <?php
                            echo  $comment['comment'];
                        ?>
                    </div>

                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
