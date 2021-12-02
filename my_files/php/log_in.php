<?php

    include 'config.php';

    if(isset($_POST['log_in'])){
        
        $collection=$db->users;

        echo "Collection selected successfully";

        $mail=$_POST['mail'];
        $password=$_POST['password'];

        $document=array(
            'mail'=>$mail,
            'password'=>$password
        );

        $cursor=$collection->findOne($document);

        if($cursor){
            $_SESSION['logged_admin']=$cursor['admin'];
            $_SESSION['logged_user']=$cursor['username'];
            $_SESSION['log_success']='yes';
        }

        else{    
            $_SESSION['log_fail']='yes';
            header("Location:".$_SERVER['HTTP_REFERER']);
        }
        
 
        if($_SESSION['logged_admin']=='no'){
            header("Location:".$_SERVER['HTTP_REFERER']);}
        elseif($_SESSION['logged_admin']=='yes'){
            header("Location:".$_SERVER['HTTP_REFERER']."#!/admin");
   
        }

    }
?>