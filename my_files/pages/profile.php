
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
    
?>
<body>
    
    <div id='profile_wrapper' class='position-relative mx-auto'>
        <?php 
        include '../php/config.php';    
        if(isset($_SESSION['logged_user'])){
            $users=$db->users;
            $user=$users->findOne(array("username"=>$_SESSION['logged_user']));            
            ?>    
        <h2 style='font-family:"Lobster";text-shadow: 0px 2px 2px rgba(0, 0, 0, 0.4); ' class='pl-3'>Profile info</h2>

        <button onclick="no_display(document.getElementById('profile_info'));display(document.getElementById('go_back'));display(document.getElementById('profile_update_form'));no_display(this)" type='button' id="edit_button"  class="clear_button edit_profile_button mr-2"><i class='fa fa-pencil'></i></button>
        
        <button onclick="no_display(this);display(document.getElementById('edit_button'));display(document.getElementById('profile_info'));no_display(document.getElementById('profile_update_form'))" id='go_back' type='button' style='display:none' class="clear_button edit_profile_button mr-2">X</button>
        <div class='d-flex flex-column align-content-center'>
            <div class='position-relative' id='profile_div' class='mx-auto'>
            <i id='edit_profile_icon' class="fa fa-user-circle-o d-block"></i>
                <div style='max-width:max-content'>
                                                            
                    <ul id='profile_info'>
                        <li><b>Username:</b><?php echo $user['username']; ?></li>
                        <li><b>Fullname:</b><?php echo $user['fullname']; ?></li>
                        <li><b>E-mail:</b><?php echo $user['mail']; ?></li>
                        <li><b>Phone:</b><?php if($user['phone']=='')
                        {
                            echo "-";
                        } 
                        else{
                            echo $user['phone'];
                        }
                        ?></li>
                    </ul>
                    <form style='display:none' id='profile_update_form' action="../php/update_profile.php" method="post">
                        <ul>
                            <li><b>Username:</b> <input class='inputs' name='new_username' required value='<?php echo $user['username']; ?>' type="text"> </li>
                            <li><b>Fullname:</b> <input class='inputs' name='new_fullname' required value='<?php echo $user['fullname']; ?>' type="text"> </li>
                            <li><b>E-mail:</b> <input class='inputs' name='new_mail' required value='<?php echo $user['mail']; ?>' type="text"> </li>
                            <li><b>Phone:</b> <input class='inputs' name='new_phone' value='<?php echo $user['phone']; ?>' type="text"> </li>
                            <li><button id='save_changes_button' class='w-100 mt-3 d-block mx-auto' type="submit">Save changes</button></li>
                        </ul>
                    </form>             
                </div>
            </div>
            <?php if ($user['trusted']=='no'){ ?>
            <div class='text-center'>
                <h6>Become Trusted Member for 10-15% discount on your purchases.</h6>
                <a href="#!trusted_member">
                    <button class='result_product_buttons'>Click here to become <i>Trusted Member</i></button>
                </a>
            </div>
            <?php }
            ?>
        </div>
        <?php }
        else{
            ?>            
            <h2 style='font-family:Sriracha' class='text-center'>To access your order profile details you need to log in.</h2> 
                <div class='d-flex flex-column text-center'>
                    <button onclick="form_appear(document.getElementById('log_in_form'))" style='width:fit-content;outline:unset' class='second_log_sign stroke mx-auto'>Click here to log in</button> 
                        or 
                    <button onclick="form_appear(document.getElementById('sign_up_form'))" style='width:fit-content;outline:unset' class='second_log_sign stroke mx-auto'>Click here to sign up</button>
                </div>
            <?php
        } ?>
    </div>
</body>
</html>