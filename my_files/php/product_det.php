<?php 

    include "config.php";

    $_SESSION['product_name']=$_POST['product_name'];
    header("Location:".$_SERVER['HTTP_REFERER']."#!/product_page");


?>