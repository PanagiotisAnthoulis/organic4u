<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    include "../php/config.php";

   
?>

    <div class='d-flex out' id='chatbot_wrapper'>
        <div type='button' onclick='bot_appear()' id='small_div'>
            <span style='writing-mode:vertical-rl;text-orientation: upright;pointer-events:none'><b>ChatBot</b></span>
        </div>
        <div class='d-flex flex-grow-1 flex-column overflow-auto' style='overflow-x:hidden !important' id='main_div'>
            <div class='d-flex align-self-strech justify-content-around align-self-center mb-2'>
                <button onclick='bot_display(document.getElementById("diets_wrapper"),document.getElementById("price_limit"),document.getElementById("about"))' id='diets' class='d-block result_product_buttons'>Diets</button>
                <button onclick='bot_display(document.getElementById("price_limit"),document.getElementById("diets_wrapper"),document.getElementById("about"))' id='price_limit_button' class='d-block result_product_buttons'>Set Price Limit</button>
                <button onclick='bot_display(document.getElementById("about"),document.getElementById("price_limit"),document.getElementById("diets_wrapper"))' id='about_button' class='d-block result_product_buttons'>Learn about us</button>
            </div>
            <div class='position-relative'>
                <div class='position-absolute' id='diets_wrapper' style='display:none;transition-duration:.7s;overflow:auto;left:390px;'>
                    <ol>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("1"))' class="arrow right"></a></i> 7 Day Clean Eating</i></b> 
                                </div>
                                <div id='1' style='display:none;'>
                                    Day 1. Clean Eating Meals<br>
                                    Breakfast. Oats in soy Milk with chopped walnuts<br>
                                    Lunch. Spinach+red quinoa+canned beans<br>
                                    Dinner. Chicken Breast/ Organic Tofu<br>
                                    Day 2. Lentils+quinoa+Fresh Mint Juice<br>
                                    Day 3. Tuna Lettuce with Basil Pesto<br>
                                    Day 4. Mexican Salad with Corn, Avocados, Beans and Lime<br>
                                    Day 5. Shrimp in Coconut oil<br>
                                    Day 6. Spaghetti with Mushrooms and Tomatoes<br>
                                    Day 7. Pineapple Chicken
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("2"))' class="arrow right"></a></i> Go Organic</i></b> 
                                </div>
                                <div id='2' style='display:none;'>
                                Organic Breakfast. Organic cereals in milk, organic eggs, organic berries, organic eggs, yogurt and fruits
                                Organic Lunch. Organic fed farm fish with organic vegetables, chicken grilled breast with whole bread, organic egg salad sandwich with organic quinoa
                                Organic Dinner. Beef tacos, Grilled Salmon, Roasted Chicken with organic kidney beans.
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("3"))' class="arrow right"></a></i> 7 Day Flat Belly Dietg</i></b> 
                                </div>
                                <div id='3' style='display:none;'>
                                    <ul>
                                        <li>Day 1. Omelette, spinach, chicken breast, green salad, green beans and steamed broccoli</li>
                                        <li>Day 2. Stir fried kale, Turkey Breast, Green Salad and Salmon Steak</li>
                                        <li>Day 3. Smoked Salmon with Spinach and Avocado, One grilled lamb Steak with green salad</li>
                                        <li>Day 4. Scrambled eggs, green beans, green vegetables</li>
                                        <li>Day 5. Hard boiled eggs, grilled prawns, Almonds</li>
                                        <li>Day 6. Grilled Haddock Fillet, Steamed vegetables, Pecan Nuts</li>
                                        <li>Day 7. Egg white omelette, asparagus, broccoli, green salad</li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("4"))' class="arrow right"></a></i> 7 Day Soup Diet Plan</i></b> 
                                </div>
                                <div id='4' style='display:none;'>
                                Day 1. Only vegetable soup+Fruits except Bananas<br>
                                Day 2. All vegetables+Soup+baked potatoes<br>
                                Day 3. Fruits+Vegetables+Soup<br>
                                Day 4. 3 Bananas+Skim Milk+Soup<br>
                                Day 5. 20 ounces of Beef+Soup<br>
                                Day 6. Beef Steaks+Green leafy veggies+Soup<br>
                                Day 7. Brown Rice+Fruit Juice+Soup<br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("5"))' class="arrow right"></a></i>General Motors Diet Plan</i></b> 
                                </div>
                                <div id='5' style='display:none;'>
                                Day 1. Only Fruits+8-12 Glasses of Water<br>
                                Day 2. Only Boiled Vegetables+8-12 Glass of Water<br>
                                Day 3. Fruits+Vegetables+8-12 Glass of Water<br>
                                Day 4. 8-10 Bananas+3 Glass of Milk throughout the day<br>
                                Day 5. A cup of Rice+6-7 Tomatoes+15 Glass of Water<br>
                                Day 6. Cup of Rice+Veggie Diet+8-12 Glass of Water<br>
                                Day 7. Vegetables+Fruit Juices of your Choice
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("6"))' class="arrow right"></a></i> Detox Diet Week</i></b> 
                                </div>
                                <div id='6' style='display:none;'>
                                Day 1. Berry Delicious Detox Smoothie<br>
                                Day 2. Strawberry Pineapple Detox Smoothie<br>
                                Day 3. Green Protein Detox Smoothie<br>
                                Day 4. Glowing Green Detox<br>
                                Day 5. Strawberry Shake Weight loss<br>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class='d-flex flex-column'>
                                <div>
                                <b><a onclick='chatbot_diet(this,document.getElementById("7"))' class="arrow right"></a></i>Shred Meal Plan</i></b> 
                                </div>
                                <div id='7' style='display:none;'>
                                Meal 1. Oatmeal, Banana, Berries, Egg Whites, Spinach, Whole Grain Bread<br>
                                Meal 2. Veggies, Chicken Breast, Steamed Broccoli, Green Salad<br>
                                Meal 3. Tuna, Grilled Tofu, Kidney Beans, Walnuts<br>
                                Meal 4. Almond Milk, Carrots, Celery, Apple, Nut Butter<br>
                                Meal 5. Veggies, Beef Burger, Chickpeas Salad<br>
                                Meal 6. Cottage Cheese, Plain Yogurt, Protein Powder<br>
                                </div>
                            </div>
                        </li>

                    </ol>
                </div>
                <div class='d-flex flex-column position-absolute pl-2' id='price_limit' style='transition-duration:.7s;overflow:auto;left:390px;width:fit-content'>
                    
                    <form method='post' action="../php/price_limit.php">
                        <label for="customRange1" class="form-label pl-3 pt-2">Price:{{price_range}} € </label>
                        <input name='limit' ng-model='price_range' step='1' max='100' type="range" class="form-range" id="customRange1">
                        <button class='result_product_buttons' name='limt_price_search'>Search</button>
                    </form>
                    
                    <script>
                        body.onload=function click() {
                        window.onload = function() {
                            document.getElementById('price_limit_button').click();
                        };
                        };</script>
                    <div class='d-flex flex-column'>
                        <?php

                            if(isset($_SESSION['limit'])){
                    
                                $products=$db->products;
                                $products=$products->find(array("product_price"=>array('$lte'=>$_SESSION['limit'])));
                                
                                foreach($products as $product)
                                { ?>
                                    <div class='d-flex'>
                                        <div> 
                                        <form action="../php/product_det.php" method="POST">
                                            <input class='m-3' name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                                            <div class='result_prod_img_wrapper'  style='width:fit-content;'>
                                                <button type="submit" style='border:none;'> 
                                                    <?php 
                                                    echo "<img width='80px'  id='photo_".$product['product_name']."' class='flex-grow-1 cat_img d-block' src='data:image;base64,".$product['product_image']."'>";
                                                    ?>
                                                </button>
                                            </div> 
                                        </form>
                                        </div>
                                        <div class='d-flex flex-column flex-grow-1'>
                                            <h5 class='text-center d-block align-self-strech' style='font-family:Sriracha'>
                                                <?php
                                                echo mb_convert_case(str_replace("_", " ", $product['product_name']),2,"UTF-8");
                                                ?>
                                            </h5>
                                        <div class='d-flex align-items-center justify-content-around'>
                                            <span style='font-weight:500' class='d-block'>Price:<?php echo $product['product_price']; ?>€</span>
                                            <form action="../php/product_det.php" method="POST">
                                                <input class='m-3' name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                                                <button class='clear_button result_product_buttons' type="submit">See more...</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                            <?php  
                            unset($_SESSION['limit']);
                            }   
                        
                            
                            ?>  
                            <script>
                                document.getElementById('price_limit_button').click();
                                document.getElementById('chatbot_wrapper').style.right='0%';
                            </script> 
                            <?php }
                            ?>
                    </div>
                </div>
                <div class='position-absolute' id='about' style='transition-duration:.7s;overflow:auto;left:390px;'>
                    <h4 style='font-family:Sriracha' class='pl-2'>organic4u.com</h4>
                    <i>
                        <p class='pl-1'>
                            We give you the chance to buy high quality products since 2021.
                            The shops that we partner with have passed our experts' tests and they have been approved.<br>
                        </p>
                        <p class='pl-1'>
                            We make sure they meet the requirements like good quality, safe payment methods and good customer service.<br>
                        </p>
                        <p class='pl-1'>
                            If you want to get in touch with our customer service <a href="" style='color:green;font-weight: 650;' onclick='scrollto(document.getElementById("footer"))'> to help you with your online experience <a href="" style='color:green;font-weight: 650;' onclick='scrollto(document.getElementById("footer"))'>click here</a> 
                            to navigate to our contact information.
                        </p>
                    </i>
                </div>
            </div>
        </div>
        <div>

        </div>
    </div>

        <div class='position-fixed d-flex flex-row' id='compare_div'>          
            <div class='d-flex flex-column flex-grow-1 w-100'>
                <h3>Compare</h3>
                <div class='d-flex flex-column flex-grow-1'>
                    <div class='prod_comp d-flex flex-column flex-grow-1'>
                        <div class='d-flex flex-column justify-content-center flex-grow-1 position-relative'>
                            <div class='no_prod position-absolute' style='z-index:-1;'> <i>Choose a product</i> </div>
                            <img style='z-index:1;' id='compare_prod_1' src="" alt="">
                        </div>
                        <div class='text-right p-2' ><span id='comp_price_1'></span></div>
                    </div>
                    <div class='prod_comp d-flex flex-column  flex-grow-1'> 
                        <div class='d-flex flex-column justify-content-center position-relative flex-grow-1'>
                            <div class='no_prod position-absolute' style='z-index:-1;'><i>Choose a product</i> </div>
                                <img class='d-block'  id='compare_prod_2' src="" alt="">
                            </div>
                            <div  class='text-right p-2'><span id='comp_price_2'></span></div>
                    </div>
                    <div class='w-100' id='difference'>Diff:<span id='dif'></span>€</div>
                    <button onclick="compare_empty();clear_comp()" class='d-block compare_buttons clear_button flex-grow-1'>Clear</button>
                </div>
            </div>
            <button onclick='clear_comp();close_comp()' class='align-self-center clear_button compare_buttons p-2 d-block'>
                X
            </button>
        </div>

    <div>  
       
        <div id="search_bar_wrapper" class='position-relative d-flex'>
                <div id="search_bar_div" class='mx-auto position-relative'>
                    <form id='product_search' action="../php/search.php" method='POST'>
                        <input  name='search_input' placeholder="Search..." type="text" id='search_bar'>
                        <button name='search_submit' type='submit'  id='search_icon' class="fa fa-search position-absolute">
                        </button>
                    </form>
                </div>
            <button name='search_submit' type='submit' id='mic_btn' class="clear_button position-absolute"><i id='mic_icon' class='fa fa-microphone'></i></button>
        </div> 
            

            <!-- SEARCH RESULTS -->
            <div id='search_results_wrapper' class='mt-5 d-flex flex-column'>

            <?php 
                if(isset($_SESSION['search_input'])){
                    $search_input = $_SESSION['search_input'];
                    $products=$db->products;
                    $cursor=$products->
                    find(array('$or'=>array(
                        array( "product_name"=>array('$regex'=>"$search_input")),
                        array( "product_shop"=>array('$regex'=>"$search_input")),
                        array( "product_desc"=>array('$regex'=>"$search_input")),
                        array( "product_"=>array('$regex'=>"$search_input")),
                )));
                $cursor_check=$products->
                findOne(array('$or'=>array(
                    array( "product_name"=>array('$regex'=>"$search_input")),
                    array( "product_shop"=>array('$regex'=>"$search_input")),
                    array( "product_desc"=>array('$regex'=>"$search_input")),
                    array( "product_"=>array('$regex'=>"$search_input")),
            )));
                    if($cursor_check!=null){
                        ?>

                            <div id='search_results_table' class='mx-auto'>

                        <?php
                    foreach($cursor as $product){
                        ?>
                        <div class='d-flex flex-column search_product'>
                            <div class='d-flex'>
                                <div class='text-center d-flex'>
                                    <form class='align-self-end' action="../php/product_det.php" method="POST">
                                        <input class='m-3' name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                                        <div class='result_prod_img_wrapper'  style='width:fit-content;'>
                                            <button type="submit" style='border:none;'> 
                                                <?php 
                                                echo "<img width='200px'  id='photo_".$product['product_name']."' class='flex-grow-1 cat_img d-block' src='data:image;base64,".$product['product_image']."'>";
                                                ?>
                                            </button>
                                        </div> 
                                    </form>
                                </div>
                                <div class='d-flex flex-column flex-grow-1'>
                                    <div class='text-center product_title mt-2'>
                                        <?php
                                            echo mb_convert_case(str_replace("_", " ", $product['product_name']),2,"UTF-8");
                                        ?> 
                                    </div>
                                    <div class='text-left mt-4 search_product_desc'>
                                        <i><b>Description:</b></i>
                                        <?php
                                            echo $product['product_desc'];
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class='text-right pr-3' >
                                <span class='price_span' id=<?php echo 'price_'.$product['product_name'];?>><?php
                                    echo $product['product_price']."€";
                                ?> </span>
                            </div>
                     
                   
                            <div class='d-flex align-self-end pr-3 pt-3'>
                                <div class='mr-4'>
                                    <form action="../php/product_det.php" method="POST">
                                        <input class='m-3' name='product_name' hidden type="text" value='<?php echo $product['product_name']; ?>'>
                                        <button class='clear_button result_product_buttons' type="submit">See more...</button>
                                    </form>
                                </div>
                                <div>
                                    <button class='clear_button compare result_product_buttons' onclick='compare_empty();compare(document.getElementById("photo_<?php echo $product["product_name"]; ?>"),document.getElementById("<?php echo "price_".$product["product_name"];?>"))'>Compare</button>
                                    <button class='clear_button comparewith result_product_buttons' onclick='compare_empty();comparewith(document.getElementById("photo_<?php echo $product["product_name"]; ?>"),document.getElementById("<?php echo "price_".$product["product_name"];?>"))'>...with this product</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <h4 style='border-radius:15px;background-color:var(--bisque);width:fit-content;box-shadow:1px 1px 1px 1px rgba(0,0,0,20%)' class='mx-auto p-4 text-center'> <i>No products found</i> </h4>
                     <?php 
                }
            }
             ?>

                
            </div>
            <div class='position-relative'>
            
                <!--SHOPS-->
                <div class='mx-auto' id="index_shops">

                    <h2 style="box-shadow: 1px 8px 2px -1px rgba(0, 0, 0, 0.2);border-radius:50px;background-color:#e8c499" class='text-center'>Shops</h2>
                        <div id='index_shops_grid' class=' mx-auto d-flex justify-content-around align-items-center'>
                            <?php 
                            $shops=$db->shops;
                            $shops=$shops->find();
                            foreach($shops as $shop){?>
                            <div class='d-flex flex-column'>
                                <form action="../php/shop_det.php" method='POST'>
                                    <input type="hidden" name="shop_name" value='<?php echo $shop['shop_name']; ?>'>
                                    <button style='border:none;background:unset;' type='submit'>
                                        <?php echo "<img id='photo' class='flex-grow-1 cat_img d-block' src='data:image;base64,".$shop['shop_image']."'>";
                                        ?>
                                    </button>
                                </form>
                            
                                <div class='text-center justify-self-end'>
                                    <?php echo ucwords(strtolower(str_replace("_"," ",$shop['shop_name'])));?>
                                </div>
                        </div>
                    <?php } ?>
                </div>

                </div>  

            </div>
        </div>
</body>
<script src="../js/mic_search.js"></script>

</html>
