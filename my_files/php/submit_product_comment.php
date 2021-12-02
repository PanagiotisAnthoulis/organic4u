<?php 
    include "../php/config.php";

    $user=$_POST['user'];
    $rating=$_POST['rating'];
    $comment=$_POST['comment'];
    $product_name=$_POST['product_name'];

    $comments=$db->comments;
    $comments->insertOne(array("product_name"=>$product_name,"comment"=>$comment,"rating"=>$rating,"user"=>$user));
    
    header("Location:".$_SERVER['HTTP_REFERER']."#!product_page");

?>