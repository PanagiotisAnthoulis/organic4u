<?php 
    session_start();
    $inp=$_POST['search_input'];
    $inp=str_replace(" ", "_",$inp);
    $inp=strtolower($inp);
    $_SESSION['search_input']=$inp;
    header("Location:".$_SERVER['HTTP_REFERER']);
    
?>