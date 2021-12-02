<?php include "../php/config.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id='admin_general_table_wrapper'>
    <table id='admin_general_table' class='text-center mx-auto'>
        <tr><th colspan='2'><u> General </u> </th></tr>
        <?php
        
        $users=$db->users;
        
        $cursor=$users->count(array('admin'=>'no'));

        ?>    

        <tr>
            <td>Number of Users:<?php echo $cursor; ?> </td>
        </tr>
        <?php
        
        $products=$db->products;
        
        $cursor=$products->count();

        ?>    

        <tr>
            <td>Number of Products:<?php echo $cursor; ?> </td>
        </tr>
        <?php
        
        $shops=$db->shops;
        
        $cursor=$shops->count();

        ?>    

        <tr>
            <td>Number of Shops:<?php echo $cursor; ?> </td>
        </tr>
    </table>
    </div>
</body>
</html>