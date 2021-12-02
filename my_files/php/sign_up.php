<?php
    include 'config.php';


    if(isset($_POST['sign_up'])){
        
        $collection=$db->users;

        echo "Collection selected successfully";

        $username=$_POST['username'];
        $fullname=$_POST['fullname'];
        $mail=$_POST['mail'];
        $password=$_POST['password'];
        
        $users=$collection->findOne(array("username"=>$username));
        
        if(!$users)
        {
        
        $document=array(
            'username'=>$username,
            'fullname'=>$fullname,
            'mail'=>$mail,
            'password'=>$password,
            'phone'=>" ",
            'admin'=>'no'
        );
        $_SESSION['user_exists']='no';

        }
        else{
            $_SESSION['user_exists']='yes';
        }
        print_r($document);
    /*
        $collection->insertOne($document);
        
        header("Location:".$_SERVER['HTTP_REFERER']);
    */
    }
?>