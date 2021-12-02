<?php 
    include '../php/config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <base href="#!market">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>organic4u.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body ng-app='myApp'>
    <div id='top-bar' class='w-100 d-flex justify-content-evenly align-items-center'>
        <h1 class='flex-grow-1 text-center' id='head' > <a href='index.php#!'>organic4u.com</a> </h1>
        <div class='flex-grow-1 d-flex justify-content-around align-baseline'>
            <div class='d-flex flex-row w-75 h-100 justify-content-around align-items-center'>
                
                <?php
                


                    if(isset($_SESSION['logged_user'])){ ?>
                    
                    <div id='username'><?php echo $_SESSION['logged_user']; ?>
                        
                    <?php 
                    
                    $users=$db->users;
                    
                    $user=$users->findOne(array("username"=>$_SESSION['logged_user']));
                    
                    if($user['trusted']=='yes'){
                        echo "<img style='filter: grayscale(0.3);' id='photo' width='50px' src='../pics/verified.png'>";
                    }
                    
                    ?>
                        
                    </div>
                    <form action="../php/log_out.php" method="post">
                        <button type='submit' class='log_sign_btn'><i id='log_icon' class="d-block fa fa-sign-out"></i></button>
                    </form>
                <?php
                
                }
                else{
                    ?>  

                    <button onclick="form_appear(document.getElementById('sign_up_form'))" class='log_sign_btn'><i id='sign_icon' class="d-block fa fa-user-plus"></i></button>
                    <button onclick="form_appear(document.getElementById('log_in_form'))" class='log_sign_btn'><i id='log_icon' class="d-block fa fa-sign-in"></i></button>
                    <?php 
                }

                ?>

            </div>
        </div>
    </div>
<!-- ALERTS  -->
    <?php 
    /* LOG IN FAIL */
    if(isset($_SESSION['log_fail'])){
        ?>
        <div class="mt-3 ml-3 position-absolute alert alert-danger alert-dismissible fade show w-25" role="alert">
            <strong>Log in failed.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php
        unset($_SESSION['log_fail']);
    }

    /* LOG IN SUCCESS */
    if(isset($_SESSION['log_success'])){
        ?>
        <div class="mt-3 ml-3 position-absolute alert alert-success alert-dismissible fade show w-25" role="alert">
            <strong>Logged in successfully.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php
        unset($_SESSION['log_success']);
    }

    /* SIGN UP FAIL */
    if(isset($_SESSION['user_exists']) && $_SESSION['user_exists']=='yes'){
        ?>
        <div class="mt-3 ml-3 position-absolute alert alert-danger alert-dismissible fade show w-25" role="alert">
            <strong>User already exists.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php
        unset($_SESSION['user_exists']);
    }
    
    /* SIGN UP SUCCESS */
    elseif(isset($_SESSION['user_exists']) && $_SESSION['user_exists']=='no'){ ?>
        <div class="mt-3 ml-3 position-absolute alert alert-danger alert-dismissible fade show w-25" role="alert">
            <strong>Sign up successful.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <?php
         unset($_SESSION['user_exists']);

    } 
    /* INSERT PRODUCT SUCCESS */
    if(isset( $_SESSION['add_success']) && $_SESSION['add_success']=='yes'){
    ?>
        <div class="mt-3 ml-3 w-25 position-absolute alert alert-success alert-dismissible fade show" role="alert">
            <strong>Product successfully inserted.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <?php
    unset( $_SESSION['add_success']);
    }
    /* INSERT PRODUCT FAIL */
    elseif(isset($_SESSION['add_success']) && $_SESSION['add_success']=='no'){ ?>
        <div class="mt-3  w-25  ml-3 position-absolute alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Product already registered.</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php
    unset( $_SESSION['add_success']);

    }
    /* UPDATE PRODUCT SUCCESS */
    if(isset( $_SESSION['update_prod']) && $_SESSION['update_prod']=='yes'){
    ?>
        <div class="mt-3 ml-3 w-25 position-absolute alert alert-success alert-dismissible fade show" role="alert">
            <strong>Product successfully updated.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <?php
    unset( $_SESSION['update_prod']);
    }
    /* UPDATE PRODUCT FAIL */
    elseif(isset($_SESSION['update_prod']) && $_SESSION['update_prod']=='no'){ ?>
        <div class="mt-3  w-25  ml-3 position-absolute alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Product already registered.</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php
    unset( $_SESSION['update_prod']);
    }
    
    /* INSERT SHOP SUCCESS */
    if(isset( $_SESSION['add_shop']) && $_SESSION['add_shop']=='yes'){
    ?>
        <div class="mt-3 ml-3 w-25 position-absolute alert alert-success alert-dismissible fade show" role="alert">
            <strong>Shop successfully inserted.</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <?php
    unset( $_SESSION['add_shop']);
    }
    /* INSERT SHOP FAIL */
    elseif(isset($_SESSION['add_shop']) && $_SESSION['add_shop']=='no'){ ?>
        <div class="mt-3  w-25  ml-3 position-absolute alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Shop already registered.</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php
    unset( $_SESSION['add_shop']);
    }
    ?>
    
    <!-- SING LOG DIV -->
    <div class='position-fixed bg-dark' id="form_background"> 
        <button id='x_button' onclick='disappear(document.getElementById("form_background"));disappear(document.getElementById("sign_log_wrapper"));
        disappear(document.getElementById("sign_up_form"));disappear(document.getElementById("log_in_form"))' class='position-absolute'>X</button>  </div>
        
        <div class='position-fixed' id="sign_log_wrapper">
            
            <form action='' id='sign_up_form' class='w-100 p-3 mx-auto' method="POST">
                
                <div class='w-50 mx-auto'>
                    <h2>Sign up</h2>
                    <h4>Username</h4>
                    <input name='username' required type="text">
                    <h4>Full Name</h4>
                    <input name='fullname' required type="text">
                    <h4>E-mail</h4>
                    <input name='mail' required type="email">
                    <h4>Password</h4>
                    <input name='password' required type="password">
                    <button type='submit' name='sign_up' class='d-block mx-auto mt-4 pl-3 pr-3 stroke'>Sign up</button>
                </div>
            </form>      

       

            <form id='log_in_form' class='w-100 p-3 mx-auto' action="../php/log_in.php" method="POST">
                
                <div class='w-50 mx-auto'>
                    <h2>Log in</h2>
                    <h4>E-mail</h4>
                    <input name='mail' required type="email">
                    <h4>Password</h4>
                    <input name='password' required type="password">
                    <button id='log_in_button' name='log_in' class='d-block mx-auto pl-3 pr-3 mt-4 stroke'>Log in</button>
                </div>

            </form>            
        
        </div>

        <!-- SIDE PROFILE -->

        <div class='h-50 position-fixed d-flex flex-row  justify-content-center align-items-center' id="profile">
            <div id='profile_icon'>
                <i class="fa fa-user-circle-o"></i>
            </div>
        
            <?php if(!isset($_SESSION['logged_user']) || (isset($_SESSION['logged_admin'])&& $_SESSION['logged_admin']=='no')){?>
            <!--USER  -->

            <div id='profile_icons_div' class='h-100 align-items-strech d-flex flex-column flex-grow-1 justify-content-around'>
                <div class='flex-grow-1'>
                    <a id="profile_link" href="#!profile">
                        <i class=" fa fa-address-card"></i>
                    </a>
                </div>
                <div class='flex-grow-1'>
                    <a id="market_link" href="#!market">
                        <i class=" fa fa-shopping-bag"></i>
                    </a>
                </div>
                <div class='flex-grow-1'>
                    <a active id="cart_link" href="#!cart">
                        <i href='#!cart' class="fa fa-shopping-cart"></i>
                    </a>
                </div>
                <div class='flex-grow-1'>
                    <a id="history_link" href="#!history">
                        <i class=" fa fa-history"></i>
                    </a>
                </div>
            </div>
            <?php }
            if(isset($_SESSION['logged_admin'])) {
            if($_SESSION['logged_admin']=='yes') {?>
                
                            <!--  ADMIN  -->
                <div id='profile_icons_div' class='h-100 align-items-strech d-flex flex-column flex-grow-1 justify-content-around'>
                    <div class='flex-grow-1'>
                        <a class='admin_profile_icons' id="profile_link" href="#!admin">
                            General
                        </a>
                    </div>
                    <div class='flex-grow-1'>
                        <a class='admin_profile_icons' id="market_link" href="#!admin_products">
                            Products
                        </a>
                    </div>
                    <div class='flex-grow-1'>
                        <a class='admin_profile_icons' active id="cart_link" href="#!admin_shops">
                            Shops
                        </a>
                    </div>
                </div>
            <?php }
                }
            ?>
        </div>


    
    <div id='wrapper'  class='pb-4' >
    <!-- SIGN UP -->
    <?php

        if(isset($_POST['sign_up'])){
            
 
            $users=$db->users;

            $username=$_POST['username'];
            $fullname=$_POST['fullname'];
            $mail=$_POST['mail'];
            $password=$_POST['password'];

            $mail_check=$users->findOne(array("mail"=>$mail));
            
            if($mail_check!=null){ ?>
                    <div class='mt-3 ml-3 fade in show position-absolute alert alert-danger alert-dismissible'>
                        <strong>This e-mail already signed up.</strong>      
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>               
                    </div>
            <?php
            }
            else{
                $document=array(
                    'username'=>$username,
                    'fullname'=>$fullname,
                    'mail'=>$mail,
                    'password'=>$password,
                    'admin'=>'no',
                    'phone'=>'',
                    'trusted'=>'no'
                );
                
                $users->insertOne($document);

                ?> 
                <div class='mt-3 ml-3 fade in show position-absolute alert alert-success alert-dismissible'>
                <strong> Sign up successful!</strong> 
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                </div>
                <?php
                unset($_POST['sign_up']);
            }
            unset($_POST['sign_up']);

           }
        

        ?>
             <!--SEARCH BAR-->
             
       <div ng-view>

       </div>
    </div> 
    <div id='footer' class=''>
           <ul class='p-3'>
            <li class='mb-3'><h3>Contact us:</h3></li>
            <h6>
            <li class='pl-1'>E-mail: organichelp@gmail.com</li>
            <li class='pl-1'>Customer service: 1234567890</li>
            <li class='pl-1'>Address: XXXXXXXX </li>
            <li></li>
            </h6>
           </ul>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script> 

    var app= angular.module("myApp",['ngRoute']);

    app.config(function($routeProvider){
        $routeProvider
        <?php 
        if(isset($_SESSION['logged_admin']) && $_SESSION['logged_admin']=="yes"){ 
            
            echo '.when("/",{templateUrl:"admin.php"})';
               
            }
        else{
            echo   '.when("/",{templateUrl:"market.php"})';
       }?> 
            .when("/market",{templateUrl:"market.php"})
            .when("/cart",{templateUrl:"cart.php"})
            .when("/admin",{templateUrl:"admin.php"})
            .when("/add_product",{templateUrl:"add_product.php"})
            .when("/add_shop",{templateUrl:"add_shop.php"})
            .when("/update_product",{templateUrl:"update_product.php"})
            .when("/update_shop",{templateUrl:"update_shop.php"})
            .when("/remove_product",{templateUrl:"remove_product.php"})
            .when("/remove_shop",{templateUrl:"remove_shop.php"})
            .when("/product_page",{templateUrl:"product_page.php"})
            .when("/admin_products",{templateUrl:"admin_products.php"})
            .when("/admin_shops",{templateUrl:"admin_shops.php"})
            .when("/shop_page",{templateUrl:"shop_page.php"})
            .when("/history",{templateUrl:"history.php"})
            .when("/order_successful",{templateUrl:"order_successful.php"})
            .when("/profile",{templateUrl:"profile.php"})
            .when("/trusted_member",{templateUrl:"trusted_member.php"})
            .when("/trusted_member_payment",{templateUrl:"trusted_member_payment.php"})
            .when("/trusted_member_successful",{templateUrl:"trusted_member_successful.php"})
    });

</script>
</html> 