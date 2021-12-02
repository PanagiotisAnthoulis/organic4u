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
    <div id='update_shop_div' class='mx-auto admin_forms p-4 mt-4'>
        <form id='search_form' hidden action='../php/update_shop_find.php' method='POST'>
        </form> 
            <input form='search_form' name='shop_name' type="text" placeholder="Shop Name">
            <button form='search_form' name='update_find' type='submit'>Find Shop</button>
            
            <button form='show_all' value='update_shop' name='submit' type="submit">Show all</button>
    </div>

    <form id='show_all' method='post' action="../php/unset.php">
    </form>
    
    <div  class='d-flex flex-column mx-auto'>
        <?php 
            $shops=$db->shops;
            
            if(isset($_SESSION['update_find_shop'])){
                $input=$_SESSION['update_find_shop'];
                $shops_results=$shops->find(array( "shop_name"=>array('$regex'=>"$input")));
                $shops_results_check=$shops->findOne(array( "shop_name"=>array('$regex'=>"$input")));
            }
            else{
                $shops_results=$shops->find();
                $shops_results_check=$shops->findOne();
            }
            if($shops_results_check){
                foreach($shops_results as $shop){
                    ?>
                 <form style='width:max-content' class='admin_forms mt-4 p-4 mx-auto' method='post' action="../php/update_shop.php" enctype="multipart/form-data">
             
                        Name: <input name='shop_name' required type="text" value='<?php echo ucwords(strtolower(str_replace("_"," ",$shop['shop_name'])));?>'>
                        <div class='d-flex flex-row'>
                            <div class='flex-grow-1'>
                                Current Image:<?php
                                echo "<img width='200px'  id='photo' class='flex-grow-1 cat_img d-block' src='data:image;base64,".$shop['shop_image']."'>";
                                ?>
                            </div>
                            <div class='flex-grow-1'>
                                New image:
                                <input class='d-inline' name='shop_image' type="file">
                            </div>     
                    </div>
                            E-mail: <input required name='shop_mail' type="text" value='<?php echo $shop['shop_mail'];?>'>
                            Address: <input required name='shop_address' type="text" value='<?php echo $shop['shop_address'];?>'>
                            Phone: <input required name='shop_phone' type="text" value='<?php echo $shop['shop_phone'];?>'>
                        
                        <input hidden name="prev_shop_name" value='<?php echo $shop['shop_name'];?>'>
                    <button class='d-block mx-auto mt-4' type="submit">Update Shop</button>
                </form>


                    <?php
                }
            }
                else{
                ?>
      <div class='mx-auto mt-3 p-4' style='box-shadow: 8px 9px 8px 1px rgba(0, 0, 0, 0.2);border-radius:15px;border-style:solid;border-color:var(--border-bisque);background-color:bisque'>
                    <h3><i> No shops found</i></h3>
                </div>                <?php
                }
                
            
        ?>
    </div>
</body>
</html>