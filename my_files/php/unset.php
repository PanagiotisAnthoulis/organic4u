<?php 
    session_start();
    
    if($_POST['submit']=='update_product'){

        unset($_SESSION['update_find_product']);
        
        header("Location:".$_SERVER['HTTP_REFERER']."#!update_product");

    }
    elseif($_POST['submit']=='remove_product'){

        unset($_SESSION['remove_find_product']);

        header("Location:".$_SERVER['HTTP_REFERER']."#!remove_product");
        
    }
    elseif($_POST['submit']=='update_shop'){

        unset($_SESSION['update_find_shop']);

        header("Location:".$_SERVER['HTTP_REFERER']."#!update_shop");
        
    }
    elseif($_POST['submit']=='remove_shop'){

        unset($_SESSION['remove_find_shop']);

        header("Location:".$_SERVER['HTTP_REFERER']."#!remove_shop");
        
    }
    

?>