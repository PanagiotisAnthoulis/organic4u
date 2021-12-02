<?php include "../php/config.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id='product_div' class='mx-auto mt-5 d-flex flex-column'>
    <?php 

        $product_name=$_SESSION['product_name'];

        $products=$db->products;
        $product=$products->findOne(array("product_name"=>$product_name)); 

        $comments_col=$db->comments;
        
        $comment_ratings=$comments_col->find(array("product_name"=>$product['product_name']));            

        ?>            
        <div class='d-flex justify-content-between'>   
            <h5 class='text-center'><?php echo  ucwords(strtolower(str_replace("_"," ",$product['product_name']))); ?></h5>
            <div style='width:max-content;'>
            <?php 
                $total=0;
                $i=0;
                
                foreach($comment_ratings as $comment){
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
            </div>
        </div>
        <div class='d-flex flex-row'>
            <div class='d-flex flex-column'>
                <?php
                    echo "<img style='max-width: 457px;height: fit-content;' id='photo' class='cat_img' src='data:image;base64,".$product['product_image']."'>";
                    ?> 
            <div class='mt-5 justify-self-end'>
            <?php  
                    $shops=$db->shops;?>
                    From:  
                    <div class='pr-2 d-flex flex-column '>
                        <?php 
                        foreach($product['product_shop'] as $product_shop){ ?>
                            <div class='d-flex align-items-center'>
                                <input required value='<?php echo $product_shop;?>' form='add_to_cart_form' style='width:20px' type="radio" name="product_shop" >
                                <form action="../php/shop_det.php" method="POST">
                                    <div class='d-flex align-items-center mb-3'  style='width:min-content'>
                                        <input class='m-3' name='shop_name' hidden type="text" value='<?php echo $product_shop; ?>'>
                                        <div style='width:fit-content;'>
                                            <button type="submit" style='border:none;background:none;'> 
                                                    <?php
                                                    $shop=$shops->findOne(array("shop_name"=>$product_shop));    
                                                    echo "<img  width='100px'id='photo' class='cat_img' src='data:image;base64,".$shop['shop_image']."'>";
                                                    ?>
                                            </button>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
                    </div>
               
            </div>
        </div>
        <?php 
        $in_cart='no';
        if(isset($_SESSION['logged_user'])){
            $logged_user=$_SESSION['logged_user'];
        }
        else if(!isset($_SESSION['logged_user'])){
            $logged_user='unsigned';
        }
        if(isset($_COOKIE['cart_products_'.$logged_user])){
            $cookie=$_COOKIE['cart_products_'.$logged_user];
            $cookie=stripslashes($cookie);
            $cookie=json_decode($cookie,true);


            foreach($cookie as $cart_product){
                foreach($cart_product as $prod){
                    if($prod['product_name']==$product['product_name']){
                        $in_cart='yes';
                    }
                    else{
                        $in_cart='no';
                    }
                }
            }
        }
   
        ?>
        <div class='d-flex flex-column align-self-stretch'>
                    <div class='d-flex flex-column p-4 flex-grow-1'>
                        <div class='justify-self-center'> <h5>Description:</h5> <?php 
                        echo $product['product_desc'];
                        ?></div>
                    </div>
                    <div class='align-self-end d-flex align-items-center'>
                    <form id='add_to_cart_form' action="../php/add_to_cart.php" method="post">
                        <input hidden name='prod'>
                        <input name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                        <?php 
                            if($in_cart=='yes'){
                                ?>
                                <button disabled type='submit'style='pointer-events:none;opacity: 0.6;width: max-content' class='d-block mt-1 result_product_buttons'>
                                    In Cart
                                </button>
                            <?php
                            }
                            elseif($in_cart=='no'){
                                ?>
                                <input class='text-center' value='1' min='1' max='10' type="number" name='product_quantity'>
                                <button style='width:max-content'  class='d-block mt-1 clear_button result_product_buttons'>
                                    Add to Cart
                                </button>
                            <?php
                            }    
                        ?>
                    </form>
                    <span id='product_price' class='ml-3 d-block'><?php echo $product['product_price'];?>€</span>
                </div>
            </div> 

        </div>
    </div>
    <!-- USER COMMENT -->
    
    <div class='mx-auto mt-5 d-flex flex-column' id='comments_div'>
        <h3 class='text-center'>Comments</h3>
        <form action="../php/submit_product_comment.php" method="post">
        <div class='d-flex flex-column'>
                    <?php if(!isset($_SESSION['logged_user'])){
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
                                <div class='flex-grow-1'>
                            <?php
                            $orders=$db->orders;
                            $orders=$orders->find(array("username"=>$_SESSION['logged_user']));
                            $bought='no';

                            foreach($orders as $order){
                                foreach($order['products_dets'] as $cart_product ){
                                    if($cart_product['product_name']==$product['product_name']){
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
                                    You need to buy this product in order to leave a comment.
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
                <input hidden name="product_name" value='<?php echo $product['product_name']; ?>'>
                <div class='mt-3 mb-2'> Comment:
                <textarea class='w-100 inputs' name="comment" id="comment_area" cols="30" rows="10"></textarea>
                </div>
                    <button class='clear_button form_buttons' type="submit">Upload Comment</button>
                </div>
                <?php }
                    ?>
            </form> 
            
            <!-- ALL COMMENTS -->
            
            <div class='w-100 d-flex flex-column'>
                <?php
            
            
            $comments=$comments_col->find(array("product_name"=>$product['product_name']));            
            $comments_check=$comments_col->findOne(array("product_name"=>$product['product_name']));            
            
            foreach($comments as $comment){
                ?>

                <div class='comment_div mt-2'>
                    <div class='d-flex justify-content-between'>
                        <div class='user'>
                            By:<b>
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