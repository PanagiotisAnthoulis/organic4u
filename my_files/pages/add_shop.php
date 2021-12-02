<?php include "../php/config.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form style='border-color:var(--border-bisque) !important' method='post' class='w-50 mx-auto border p-4 mt-4 admin_forms' action="../php/add_shop.php" enctype="multipart/form-data">
        <ul>
            Name: <input required name='shop_name' type="text">
            Image: <input required name='shop_image' type="file">
            E-mail: <input required name='shop_mail' type="email">
            Address: <input required name='shop_address' type="text">
            Phone: <input required name='shop_phone' type="text">
        </ul>
        <button class='d-block mx-auto' type="submit">Add shop</button>
    </form>

    <?php 
        $shops = $db->shops;
        $cursor=$shops->find();
        $cursor_check=$shops->findOne();
    ?>
    <table class='mx-auto w-50 mt-4 admin_tables'>
    <tr><th>Name</th><th>E-mail</th><th>Address</th><th>Phone</th><th>Image</th></tr>
    <?php
    if($cursor_check){
        foreach($cursor as $document){
        ?>
        <tr>
            <td>
            <?php echo ucwords(strtolower(str_replace("_"," ",$document['shop_name']))); ?>
            </td>
            <td>
            <?php echo $document['shop_mail'] ?>
            </td>
            <td>
            <?php echo $document['shop_address'] ?>
            </td>
            <td>
            <?php echo $document['shop_phone'] ?>
            </td>
            <td>
            <?php
                echo "<img id='photo' class='cat_img' src='data:image;base64,".$document['shop_image']."'>";
            ?>
            </td>
        </tr>
     <?php }
    }
    else{
        ?>
        
        <td colspan='5'><i><h4> No shops found.</h4></i></td>

        <?php 
    } 
    ?>    
    </table>
</body>
</html>