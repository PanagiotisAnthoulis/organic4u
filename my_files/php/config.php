<?php
    session_start();

    require '../vendor/autoload.php';

    $m = new MongoDB\Client("mongodb://127.0.0.1/");

    $db=$m->organic4u;

    
?>