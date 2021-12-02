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
    <div id='remove_shop_div' class='mx-auto admin_forms p-4 mt-4'>
        <form id='find_shop' hidden action='../php/remove_shop_find.php' method='POST'>
        </form> 
            <input form='find_shop' name='shop_name' type="text" placeholder="Shop Name">
            <button form='find_shop' class='no_outline mt-3' name='update_find' type='submit'>Find Shop</button>
            
            <button form='show_all' class='no_outline mt-3' value='remove_shop' name='submit' type="submit">Show all</button>
    </div>

    <form hidden id='show_all' method='post' action="../php/unset.php">
    </form>

    <div id='find_results' class='d-flex flex-column mx-auto'>
        <?php 
            $shops=$db->shops;
            
            if(isset($_SESSION['remove_find_shop'])){
                $input=$_SESSION['remove_find_shop'];
                $shops_results=$shops->find(array("shop_name"=>array('$regex'=>"$input")));
                $shops_results_check=$shops->findOne(array("shop_name"=>array('$regex'=>"$input")));
            }
            else{
                $shops_results=$shops->find();
                $shops_results_check=$shops->findOne();
            }
            if($shops_results_check){
                foreach($shops_results as $shop){
                    ?>
                    <div class='admin_delete_shop w-100 d-flex'>
                        <div class='d-flex flex-grow-1 flex-column'>
                            <div class='flex-grow-1 text-center'> <h4> <?php echo ucwords(strtolower(str_replace("_"," ",$shop['shop_name']))); ?></h4></div>
                            <div class='p-3'>
                                <div class='flex-grow-1'>E-mail: <?php echo $shop['shop_mail']; ?></div>
                                <div class='flex-grow-1'>Phone: <?php echo $shop['shop_phone']; ?></div>
                                <div class='flex-grow-1'>Address: <?php echo $shop['shop_address']; ?></div>
                            </div>
                        </div>
                        <?php
                            echo "<img width='200px'  id='photo' class='delete_shop_img d-block mr-4' src='data:image;base64,".$shop['shop_image']."'>";
                        ?>
                        <form action="../php/remove_shop.php" method="post">
                            <input type="hidden" name="shop_name" value='<?php echo $shop['shop_name']; ?>'>
                            <div><button type='submit' class='m-1 btn btn-danger'>X</button></div>
                        </form>
                    </div>
               <?php }
            }
            else{ ?>
                <div class='mx-auto mt-3 p-4' style='box-shadow: 8px 9px 8px 1px rgba(0, 0, 0, 0.2);border-radius:15px;border-style:solid;border-color:var(--border-bisque);background-color:bisque'>
                <h3><i> No shops found</i></h3>
            </div>   
            <?php }
                ?>

    </div>
</body>
</html>