<?php include "../php/config.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body id='cart_page'>


<form id='payment_form' name='payment_form' method='post' action="../php/submit_order.php">
    <div id='cart_div' class='p-3 d-flex flex-column mx-auto'>
        <div id='cart_div_wrapper' class='mb-4'>
            <div id='cart_div_inner_wrapper'>
                <div style='min-width:759px;min-height:236px' id='cart_div_content' class='cart_div_content'>
                    <h2 id='my_cart_header' class='text-center'>My Cart</h2>
                    <?php
                        if(isset($_SESSION['logged_user']))
                            $user=$_SESSION['logged_user'];
                        else
                            $user='unsigned';

                        if(isset($_COOKIE['cart_products_'.$user])){
                            
                            $products=$db->products;
                            $qwe=$_COOKIE['cart_products_'.$user];

                            $qwe=stripslashes($qwe);
                            $qwe=json_decode($qwe,true);
                            
                            foreach($qwe as $w){
                                foreach($w as $s){
                                    ?> 
                                        <input hidden name='cart_shops[]' value='<?php echo $s['product_shop']; ?>' type="text"> 
                                        <input hidden name='cart_product_names[]' value='<?php echo $s['product_name']; ?>' type="text"> 
                                   <?php
                                }
                            }
                        ?>
                    
                    <input name='cart_products' value='<?php echo $_COOKIE['cart_products'];  ?>' hidden value type="text">

                    <div class='mx-auto d-flex flex-row flex-grow-1'> 
                        <table id='cart_table' class='w-75 mx-auto text-center'>
                            <tr><th>Product</th><th>Shop</th><th>Price</th><th>Quantity</th><th>Product Image</th><th></th></tr>
                    <?php
                        $i=1;
                        foreach($qwe as $w){
                            foreach($w as $g){
                                $cursor=$products->findOne(array("product_name"=>$g['product_name']));
                                ?> 
                                <tr class="cart_product">
                                    <td>
                                        <?php echo  mb_convert_case(str_replace("_"," ",$cursor['product_name']),2,"UTF-8"); ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo  mb_convert_case(str_replace("_"," ",$g['product_shop']),2,"UTF-8");;
                                        ?>
                                    </td>
                                    <td id='price_<?php echo $i; ?>'>
                                        <?php echo $cursor['product_price']."€";?>

                                        <input hidden name='cart_product_prices[]' value='<?php echo $cursor['product_price'];?>' type="text">
                                    </td>
                                    <td id='quantity_<?php echo $i; ?>'>

                                        <input hidden name='cart_product_quantities[]' value='<?php echo $g['product_quantity']; ?>' type="text"> 

                                        <?php echo $g['product_quantity']; ?>
                                    </td>
                                    <td class='text-center'>
                                    <button form='product_dets' type="submit" style='outline:unset;border:none;'> 
                                        <?php 
                                        echo "<img width='50px' height='50px' id='photo' class='cat_img' src='data:image;base64,".$cursor['product_image']."'>";
                                        ?>
                                    </button>
                                    </td>
                                    <td>
                                            <button form="remove_from_cart" type='submit' >X</button>
                                       
                                    </td>
                                </tr>
                                <?php
                            $i++; 
                            }   
                        }?>
                        <tr><td></td></tr>
                        <tr>
                            <td class='p-3' colspan=6 id='total_td'>
                                Total:<span id="cart_total"></span> 
                                <br>
                                <div style='margin:auto;font-size:15px;height:fit-content;width:fit-content;font-style:italic' id='discount_display'></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=6>
                                <button class='result_product_buttons' type='button' onclick='next_cart_step(document.getElementById("cart_div_content"),document.getElementById("cart_div_content2"));progressbar(document.getElementById("cart_progress_bar"),50)'>Continue</button>
                            </td>
                        </tr>
                        </table>
                    </div>
                </div>
                    <div style='display:none;opacity:0;' class='cart_div_content' id='cart_div_content2'>
                        <div class='flex-grow-1'>
                            Full name:
                            <input ng-model='fullname' maxlength="50" required name='fullname' type="text">
                            <span ng-show='payment_form.fullname.$touched && payment_form.fullname.$error.required'><small><b>This input is required.</b></small><br></span>
                            Mail:
                            <input ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" maxlength="50" ng-model='mail' required name='mail' type="text">
                            <span ng-show='payment_form.mail.$touched && payment_form.mail.$error.required'><small><b>This input is required.</b></small><br></span>
                            <span ng-show='payment_form.mail.$dirty && payment_form.mail.$error.pattern'><small><b>Type in valid e-mail.</b></small><br></span>
                            Address:
                            <input ng-model='address' maxlength="50" required name='address' type="text">
                            <span ng-show='payment_form.address.$touched && payment_form.address.$error.required'><small><b>This input is required.</b></small><br></span>
                            City:
                            <input ng-model='city' maxlength="50" required name='city' type="text">
                            <span ng-show='payment_form.city.$touched && payment_form.city.$error.required'><small><b>This input is required.</b></small><br></span>
                            Zip:
                            <input ng-model='zip' ng-minlength="5" ng-maxlength="5" ng-pattern='/^[0-9]*$/' required name='zip' type="number">
                            <span ng-show='payment_form.zip.$touched && payment_form.zip.$error.required'><small><b>This input is required.</b></small><br></span>
                            <span ng-show='payment_form.zip.$touched && payment_form.zip.$error.pattern'><small><b>Only number in ZIP code.</b></small><br></span>
                            <span ng-show='payment_form.zip.$touched && payment_form.zip.$error.maxlength'><small><b>5 digits needed.</b></small><br></span>
                            <span ng-show='payment_form.zip.$touched && payment_form.zip.$error.minlength'><small><b>5 digits needed.</b></small><br></span>
                            <button ng-disabled="
                            payment_form.mail.$invalid || 
                            payment_form.mail.$invalid ||
                            payment_form.address.$invalid ||
                            payment_form.city.$invalid ||
                            payment_form.zip.$invalid 
                            "  class='mx-auto d-block mt-2 clear_button result_product_buttons' type='button' onclick='next_cart_step(document.getElementById("cart_div_content2"),document.getElementById("cart_div_content3"));progressbar(document.getElementById("cart_progress_bar"),90)'>Continue</button>
                        </div>
                      
                    </div>
                    <div style='display:none;opacity:0;' class='cart_div_content' id='cart_div_content3'>
                        <div class="col-50">
                            <h3 class='text-center'>Payment</h3>
                            <label for="fname">Accepted Cards:</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>
                            <label for="cname">Name on Card:</label>
                            <input ng-model='cardname'  required type="text" id="cname" name="cardname" placeholder="John More Doe">
                            <span ng-show='payment_form.cardname.$touched && payment_form.cardname.$error.required'><small><b>This input is required.</b></small><br></span>
                            
                            <label for="ccnum">Credit card number:</label>
                            <input type='number' ng-model='cardnumber' ng-minlength="16" ng-maxlength="16" maxlength="16" required type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                            <span ng-show='payment_form.cardnumber.$touched && payment_form.cardnumber.$error.required'><small><b>This input is required.</b></small><br></span>
                            <span ng-show='payment_form.cardnumber.$error.minlength || payment_form.cardnumber.$error.maxlength'><small><b>16 digits needed.</b></small><br></span>

                            <div class="row">
                            <div class="col-50">
                                <label for="expyear">Exp Month:</label> <br>
                                    <select required name="" id="">
                                    <option name="" value="" style="display:none;">MM</option>
                                    <option name="January" value="Jan">January</option>
                                    <option name="February" value="Feb">February</option>
                                    <option name="March" value="Mar">March</option>
                                    <option name="April" value="Apr">April</option>
                                    <option name="May" value="May">May</option>
                                    <option name="June" value="Jun">June</option>
                                    <option name="July" value="Jul">July</option>
                                    <option name="August" value="Aug">August</option>
                                    <option name="September" value="Sep">September</option>
                                    <option name="October" value="Oct">October</option>
                                    <option name="November" value="Nov">November</option>
                                    <option name="December" value="Dec">December</option>
                                    </select>                               <span ng-show='payment_form.cardyear.$touched && payment_form.cardyear.$error.required'><small><b>This input is required.</b></small><br></span>
                            </div>
                            <div class="col-50">
                                <label for="expyear">Exp Year:</label> <br>
                                    <select required placeholder="MM">
                                    <option value="2021">2021</option>
                                    <option value="2021">2022</option>
                                    <option value="2021">2023</option>
                                    <option value="2021">2024</option>
                                    <option value="2021">2025</option>
                                    <option value="2021">2026</option>
                                    <option value="2021">2027</option>
                                    <option value="2021">2028</option>
                                    <option value="2021">2029</option>
                                    <option value="2021">2030</option>
                                    </select>                                <span ng-show='payment_form.cardyear.$touched && payment_form.cardyear.$error.required'><small><b>This input is required.</b></small><br></span>
                            </div>
                            <div style='width:min-content' class="col-50">
                                <label for="cvv">CVV</label>
                                <input required maxlength="3" style='width:initial !important;' ng-model='cardcvv' required type="text" id="cvv" name="cvv" placeholder="352">
                                <span ng-show='payment_form.cardcvv.$touched && payment_form.cardcvv.$error.required'><small><b>This input is required.</b></small><br></span>
                            </div>
                            </div>
                        </div>
                            <button id='final_submit' ng-disabled='
                            payment_form.cardname.$invalid || 
                            payment_form.cardnumber.$invalid ||
                            payment_form.cardmonth.$invalid ||
                            payment_form.cardyear.$invalid ||
                            payment_form.cardcvv.$invalid 
                            ' class='d-block mx-auto mt-3 d-block mt-1 clear_button result_product_buttons'>Submit order</button>
                        </div>
            </div>
        </div>
            </form>
            <form hidden id='product_dets' action="../php/product_det.php" method="POST">
    <input class='m-3' name='product_name' hidden type="text" value='<?php echo $cursor['product_name']; ?>'>
   
</form>
                <form hiddden id='remove_from_cart' action="../php/remove_from_cart.php" method="post">
                                            <input value="<?php echo $cursor['product_name'];?>" hidden type="text" name='product_to_del'>
                </form>
                    <div class="progress">
                    <div id='cart_progress_bar' class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <?php
            }
            else{
                ?>
                <div class='w-50 text-center mx-auto mt-4'>
                    <h4><u>No products in cart.</u></h4>
                    <br>
                    <h3></h3>
                </div>
            
                <?php 
            }
        ?>
    </div>
    <script>
    $(document).ready(function(){

    var i=1,price=0,quantity=0,total=0;

    $('.cart_product').each( function(){
        
        price = parseFloat($.trim($('#price_'+i).text().replace('€', '')));
        quantity = parseFloat($.trim($('#quantity_'+i).text()));
        
        total=(price*quantity)+total;
        i++
    });
<?php
    if(isset($_SESSION['logged_user'])){ 
                  
        $users=$db->users;
        
        $user=$users->findOne(array("username"=>$_SESSION['logged_user']));
        
        if($user['trusted']=='yes'){

        ?>
            random=Math.floor(Math.random() * (15-10+1))+10;
            disc=random/100;
            total-=parseFloat(total*disc).toFixed(2);
            $("#discount_display").text('Congratulations! You got '+random+'% discount!'); 
        <?php 
            
        }
        else{

        ?>
            total-=parseFloat(total*0.05).toFixed(2);
            $("#discount_display").text('Congratulations! You got '+5+'% discount!'); 
        <?php 
            
        }
    }
    ?>

    $("#cart_total").text(total+"€");

    })

</script>
</body>
</html>