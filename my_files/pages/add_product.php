<?php include "../php/config.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method='post' class='admin_forms mx-auto p-4 mt-4' action="../php/add_product.php" enctype="multipart/form-data">
        <ul>
            Name: <input required name='product_name' type="text">
            Image: <input required name='product_image' type="file">
            Description: <textarea style='width:456px;' cols="80" rows="10" required name='product_desc' type="mail"></textarea>
            Price: <input required name='product_price' min='0' step='0.01' type="number">
            <div class='d-flex flex-column mt-2'>
                <div id='add_shop_wrapper'>
                    <div class='d-flex flex-row align-items-center justify-content-around add_shop_div' id='add_shop_div'>
                        <div id='shop_select_base' >
                        <div>Shop:</div>
                            <select onclick="shop_val()" class='mt-1 shop_select' id='product_shop' required class='mt-2' name='product_shop[]'>
                                <option></option>                         
                                    <?php 
                                        $shops= $db->shops;
                                        $cursor=$shops->find();
                                        foreach($cursor as $document){
                                            ?>
                                                <option value= <?php echo $document['shop_name']; ?>><?php echo mb_convert_case(str_replace("_"," ",$document['shop_name']),2,"UTF-8"); ?></option>
                                            <?php
                                        }
                                        
                                    ?>
                            </select>
                           
                        </div>
                        <div id='quantity_base'>
                            Stock: <input onchange="shop_val()" onclick="shop_val()" id='product_quant' required name='product_stock[]' min='1' max='200' type="number">
                        </div>
                    </div>
                </div>
                
                <small class='text-center d-block'> Leave "Shop" and "Stock" empty if you do not want to add another shop.</small>
                <button type='button' class='' id='add_shop_button' onclick='add_shop()'>+</button>
            
            </div>

        </ul>
        <button id='add_product_button' class='d-block mx-auto' type="submit">Add product</button>

    </form>

    <?php 
        $products = $db->products;
    ?>
    <table class='admin_tables mx-auto  mt-4'>
    <tr><th>Name</th><th>Price</th><th>Description</th><th>Shop</th><th>Image</th></tr>
    
    <?php
    if($products->findOne()){
        $cursor=$products->find();
        foreach($cursor as $document){
        ?>
        <tr>
            <td>
            <?php echo mb_convert_case(str_replace("_"," ",$document['product_name']),2,"UTF-8"); ?>
            </td>
            <td>
            <?php echo $document['product_price'] ?>€
            </td>
            <td>
            <?php echo $document['product_desc'] ?>
            </td>
            <td>
            <ol style='padding-left:1rem !important'>
            <?php
                
                foreach($document['product_shop'] as $shop){ ?> <li><?php
                echo mb_convert_case(str_replace("_"," ",$shop),2,"UTF-8");
                    ?></li> 
                    <?php
            } 
             ?>
            </ol>
            </td>
            <td>
            <?php
                echo "<img width='50px' height='50px' id='photo' class='cat_img' src='data:image;base64,".$document['product_image']."'>";
            ?>
            </td>
        </tr>

     <?php }
    }
    else{
        ?>

        <td colspan='5'><i><h4> No products found.</h4></i></td>
        <?php 
    } 
    ?>    
    </table>

    <script>
    function shop_val(){
    $(".secondary_input input").change(function(){
    
        class_name=$(this).parent().attr('class').split(/\s+/);
        class_name=class_name[0];

       if($(this).val()!=""){
            $("."+class_name+" select").attr("required","true")
        }        
        else{

            $("."+class_name+" select").removeAttr("required")
        }
        });
        
        $(".secondary_input select").change(function(){
        
            class_name=$(this).parent().attr('class').split(/\s+/);
            class_name=class_name[0];
    
           if($(this).val()!=""){
                $("."+class_name+" input").attr("required","true")
            }        
            else{
    
                $("."+class_name+" input").removeAttr("required")
            }
            });
    }
    

    </script>
</body>
</html>