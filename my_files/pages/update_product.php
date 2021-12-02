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
    <div id='update_product_div' class='admin_forms p-3 mx-auto d-flex flex-column'>
        <form hidden  id='product_find'action='../php/update_product_find.php' method='POST'>
        </form> 
            Product Name:
            <input  form='product_find' name='product_name' type="text">
            <div class='w-50 d-flex mx-auto justify-content-around mt-3'>
                <button class='admin_buttons' form='product_find' name='update_find' type='submit'>Find product</button>
                <button class='admin_buttons' form='show_all' value='update_product' name='submit' type="submit">Show all</button>
            </div>
            <form  hidden id='show_all' method='post' action="../php/unset.php">
        </form>
    </div>
    <div id='update_find_results' class='d-flex flex-column mx-auto'>
        <?php 
         $products=$db->products;

            if(isset($_SESSION['update_find_product'])){  

                $input=$_SESSION['update_find_product'];
 
                $products_results=$products->find(array( "product_name"=>array('$regex'=>"$input")));
                $products_results_check=$products->findOne(array( "product_name"=>array('$regex'=>"$input")));
            }
            else{
                $products_results=$products->find();
                $products_results_check=$products->findOne();
            }
            if($products_results_check){
                foreach($products_results as $product){
                    ?>
                 <form class='mt-4 admin_forms' method='post' action="../php/update_product.php" enctype="multipart/form-data">
             
                        Name: <input name='product_name' required type="text" value='<?php echo ucwords(strtolower(str_replace("_"," ",$product['product_name'])));?>'>
                        <div class='d-flex flex-row'>
                            <div class='flex-grow-1'>
                                Current Image:<?php
                                echo "<img width='200px'  id='photo' class='flex-grow-1 cat_img d-block' src='data:image;base64,".$product['product_image']."'>";
                                ?>
                            </div>
                            <div class='flex-grow-1'>
                                New image:
                                <input class='d-inline' name='product_image' type="file">
                            </div>     
                    </div>
                        Price(€): <input required name='product_price' type="number" value='<?php echo $product['product_price'];?>'>
                        Shops:<br><div id='<?php echo $product['product_name']."_shops_div"; ?>'>
                        <?php 
                            $i=1;
                        foreach($product['product_shop'] as $shop){  ?>
                            <?php echo $i.")"; ?> 
                            <select class='update_add_shop' id='<?php echo $product['product_name'];  ?>_shop_select_base' required class='mt-2' name='product_shop[]'>
                                <option value='<?php echo $shop; ?>'><?php echo mb_convert_case(str_replace("_"," ",$shop),2,"UTF-8"); ?></option>

                                <?php 
                                    $shops= $db->shops;
                                    $cursor=$shops->find();
                                    
                                        foreach($cursor as $document){
                                                if($document['shop_name']!=$shop){
                                                ?>
                                                    <option class='' value='<?php echo $document['shop_name'];?>'><?php echo mb_convert_case(str_replace("_"," ",$document['shop_name']),2,"utf-8"); ?></option>
                                                    
                                                <?php
                                                }   
                                                if($i!=1){
                                                ?>
                                                    <option value=""><i>Delete</i></option>
                                                <?php
                                                }
                                        }
                                ?>

                                </select>
                                <br>
                                <?php 
                            $i++;   
                            }
                                ?>
                            </div>
                            <button type='button' class='' onclick='add_shop_update("<?php echo $product["product_name"]; ?>")'>+</button>

                            <br>
                            <div class='mx-auto d-flex flex-column'>
                                <div>Description:</div>
                                    <textarea required name="product_desc" id="" cols="80" rows="10"><?php echo $product['product_desc'];?></textarea>
                            </div>
                        <input hidden name="prev_product_name" value='<?php echo $product['product_name'];?>'>
                    <button class='d-block mx-auto' type="submit">Update product</button>
                </form>
                <?php }
                }
                else{
                ?>
                <div class='mx-auto mt-3 p-4' style='box-shadow: 8px 9px 8px 1px rgba(0, 0, 0, 0.2);
                    border-radius:15px;border-style:solid;border-color:var(--border-bisque);background-color:bisque'>
                    <h3><i> No products found</i></h3>
                </div>
                    <?php
                }
            
        ?>
    </div>
</body>
</html>