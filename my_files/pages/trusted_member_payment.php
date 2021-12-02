<?php 
    session_start();
?>

<div class='cart_div_content mt-5 admin_forms p-4 mx-auto' id='member_payment_wrapper'>
    <form action="../php/set_membership.php" method='post'>
    <input type="hidden" name="price" value='<?php echo $_SESSION['member_price']; ?>'>
    <div class="col-50">
                <h3 class='text-center'><i>Payment</i> </h3>
                <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
                <label for="cname">Name on Card</label>
                <input required type="text" id="cname" name="cardname" placeholder="John More Doe">
                <label for="ccnum">Credit card number</label>
                <input required type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                <label for="expmonth">Exp Month</label>
                <input required type="text" id="expmonth" name="expmonth" placeholder="September">

                <div class="row">
                <div class="col-50">
                    <label for="expyear">Exp Year</label>
                    <input required type="text" id="expyear" name="expyear" placeholder="2018">
                </div>
                <div class="col-50">
                    <label for="cvv">CVV</label>
                    <input required type="text" id="cvv" name="cvv" placeholder="352">
                </div>
                </div>
            </div>
            <button style='color:black;' type='submit' id='final_submit'  class=' mt-3 d-block mx-auto  d-block mt-1 clear_button result_product_buttons'>Buy Membership</button>
    </form>
</div>