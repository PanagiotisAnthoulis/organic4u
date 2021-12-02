<?php 
    include "../php/config.php";

    $user=$_POST['user'];
    $rating=$_POST['rating'];
    $comment=$_POST['comment'];
    $shop_name=$_POST['shop_name'];

    $comments=$db->shop_comments;
    $comments->insertOne(array("shop_name"=>$shop_name,"comment"=>$comment,"rating"=>$rating,"user"=>$user));
    
    header("Location:".$_SERVER['HTTP_REFERER']."#!shop_page");

?>