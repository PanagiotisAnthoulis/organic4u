<?php 

    include "config.php";

    $_SESSION['shop_name']=$_POST['shop_name'];
    
    header("Location:".$_SERVER['HTTP_REFERER']."#!/shop_page");


?>