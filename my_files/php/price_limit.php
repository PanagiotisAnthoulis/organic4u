<?php

    include "config.php";

    $_SESSION['limit']=$_POST['limit'];

    header("Location:".$_SERVER['HTTP_REFERER']."#!/market");

?>