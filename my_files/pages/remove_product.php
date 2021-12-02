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
    <div id='remove_product_div' class='mx-auto admin_forms p-3'>
        <form hidden id='remove_product_find' action='../php/remove_product_find.php' method='POST'>
    </form> 
            <input form='remove_product_find' name='product_name' type="text" placeholder="Product Name">
            <div class='d-flex mt-2'>
                <button form='remove_product_find' class='d-block mx-auto' name='update_find' type='submit'>Find product</button>
                <button id='show_all' value='remove_product' name='submit' type="submit">Show all</button>
            </div>
    </div>
    <form hidden id='show_all' method='post' action="../php/unset.php">
    </form>
    <div id='find_results' class='d-flex flex-column mx-auto'>
        <?php 
            
            $products=$db->products;

            if(isset($_SESSION['remove_find_product'])){
                $input=$_SESSION['remove_find_product'];
                $products_results=$products->find(array("product_name"=>array('$regex'=>"$input")));
                $product_check=$products->findOne(array("product_name"=>array('$regex'=>"$input")));
            }
            else{
                $products_results=$products->find();
                $product_check=$products->findOne();
            }
            if($product_check){
                foreach($products_results as $product){
                    ?>

                    <div class='d-flex flex-row delete_products position-relative'>
                         <div class='d-flex flex-column flex-grow-1' style='width:484px'>
                            <div class='flex-grow-1 text-center'><b> <?php echo mb_convert_case(str_replace("_"," ",$product['product_name']),2,'UTF-8'); ?></b></div>
                            <div class='flex-grow-1 p-3'><b>Shops:</b>
                                <div class='pl-3'><?php
                                $i=1;
                                    foreach($product['product_shop'] as $shop){
                                    echo "$i)";
                                    echo mb_convert_case(str_replace("_"," ",$shop),2,'UTF-8'); 
                                    $i++;
                                    echo "<br>";
                                    }
                                ?>
                                </div>
                            </div>
                            <div class='flex-grow-1 pr-2 p-3'><b><i>Description:</i></b> <?php echo $product['product_desc']; ?></div>
                            <div class='flex-grow-1 text-right pr-2'> <b><?php echo $product['product_price']; ?>€ </b> </div>
                        </div>
                        <div class='d-flex flex-grow-1'>
                        <?php
                            echo "<img width='200px'  id='photo' class='flex-grow-1 delete_product_image d-block' src='data:image;base64,".$product['product_image']."'>";
                        ?>
                        </div>
                        <form hidden id='remove_product_form_<?php echo $product['product_name'];?>' class='flex-grow-1' action="../php/remove_product.php" method="post">
                            <input type="hidden" name="product_name" value='<?php echo $product['product_name']; ?>'>
                        </form>
                        <button form='remove_product_form_<?php echo $product['product_name'];?>' type='submit' class='m-1 align-self-start btn btn-danger delete_product_button'>X</button>
                    </div>
               <?php }
            }
            else{
                ?>
<div class='mx-auto mt-3 p-4' style='box-shadow: 8px 9px 8px 1px rgba(0, 0, 0, 0.2);
border-radius:15px;border-style:solid;border-color:var(--border-bisque);background-color:bisque'>
                    <h3><i> No products found.</i></h3>
                </div>                <?php
            }
            ?>

    </div>
</body>
</html>