$(document).ready(function () {
    $('#market_link').toggleClass("active");
});

function form_appear(form){
    
    back=document.getElementById("form_background");
    wrapper=document.getElementById("sign_log_wrapper");
    var ar=[form,wrapper];

    back.style.display='block';
    back.style.opacity='.3';


    ar.forEach(element => {
        element.style.display='block';
        element.style.opacity='1';
    });
    
}

function next_cart_step(first_wrap,second_wrap){
   
    var wrap=document.getElementById("#cart_div_inner_wrapper");

    no_opacity(first_wrap);
    setTimeout(()=>{
        no_display(first_wrap);
        display(second_wrap);
        
    },1000);

    setTimeout(()=>{
        opacity(second_wrap);
    },1010);
    

}

function enable_button($button){
    $button.removeAttribute("disabled");
}

function opacity(el){
    el.style.opacity='1';
}

function progressbar(bar_el,value){
    bar_el.style.width=value+"%";
}

function no_opacity(el){
    el.style.opacity='0';
}


function disappear(x){
    x.style.display='none';
}

function display(x){
    x.style.display='block';
}

function no_display(x){
    x.style.display='none';
}

function compare(prod_image,prod_price){

    var source=prod_image.src;
    document.getElementById("compare_prod_1").src=source;

    var comp_price=document.getElementById("comp_price_1");
    comp_price.innerText=prod_price.innerText;

    $('.compare').hide();
    $('.comparewith').show();
}


function comparewith(prod_image,prod_price){

    var source=prod_image.src;
    document.getElementById("compare_prod_2").src=source;
    console.log(comp_price);

    var comp_price=document.getElementById("comp_price_2");
    comp_price.innerText=prod_price.innerText;

    
    var price1 = String(document.getElementById("comp_price_1").innerText);
    price1 = parseFloat(price1.replace('€',''));

    var price2 = String(parseFloat(document.getElementById("comp_price_2").innerText));
    price2 =  parseFloat(price2.replace('€',''));

    var dif = price1 - price2;

    document.getElementById("dif").innerText = dif.toFixed(2);
        
}


function clear_comp(){

    document.getElementById("compare_prod_1").src='';
    document.getElementById("compare_prod_2").src='';
    
    document.getElementById("comp_price_1").innerText='0€';
    document.getElementById("comp_price_2").innerText='0€';

    document.getElementById("dif").innerText='0.00'

    $('.compare').show();
    $('.comparewith').hide();
    
}

function compare_empty(){
    
    var prod=document.getElementById("compare_prod_1");
    var div=document.getElementById("compare_div");

    if(prod.src!=""){
        div.style.left='0';
    }
    if(prod.src==""){
        div.style.left='-180px';
    }
}

function close_comp(){
    var div=document.getElementById("compare_div");
    div.style.left='-180px';

    $('.compare').show();
    $('.comparewith').hide();

}

function add_shop(){
    
    var shop_num = document.getElementsByClassName("add_shop_div").length;

    var shop_div = document.getElementById("add_shop_div");
    
    var classes = shop_div.classList;
  
    
    var new_shop_div = document.createElement("div");
    

    classes.forEach(element => {
        new_shop_div.classList.add(element);
    });

    new_shop_div.classList.add("secondary_shop_div");

    var select = document.getElementById("shop_select_base");     
    
    var new_select = select.cloneNode(true);

    new_select.classList.add("shop_inputs"+shop_num);
    
    var quantity = document.getElementById("quantity_base");
    
    var new_quantity = quantity.cloneNode(true);

    new_quantity.value=0;

    new_quantity.classList.add("shop_inputs"+shop_num);
    
    new_quantity.classList.add("secondary_input");

    new_select.setAttribute("id","select"+shop_num);
   
    new_select.classList.add("secondary_input");
    
    new_quantity.setAttribute("id","quant"+shop_num);

    new_shop_div.appendChild(new_select);
    
    new_shop_div.appendChild(new_quantity);

    var add_shop_wrapper = document.getElementById("add_shop_wrapper");
    
    add_shop_wrapper.appendChild(new_shop_div);

    $(".secondary_input input, .secondary_input select").removeAttr("required");
    
}

function add_shop_update(product_name){

    var num=document.getElementsByClassName("update_add_shop");
    var shop_div = document.getElementById(product_name+"_shops_div");
    
    var select = document.getElementById(product_name+"_shop_select_base");

    var new_select = select.cloneNode(true);
    
    var delete_option=document.createElement("option");

    delete_option.text='Delete';

    new_select.appendChild(delete_option);

    new_select.required=false;

    new_select.innerHTML+="<option value='' disabled selected hidden>Select Shop</option>";
    
    num=num.length+1;
    
    shop_div.innerHTML+=""+num+")  ";

    shop_div.appendChild(new_select);

    shop_div.innerHTML+="<br>";
    
}

function chatbot_diet(arrow,dets){
    if(arrow.classList.contains("right")){
        arrow.style.transform='rotate(45deg)';
        dets.style.display='block';
        arrow.classList.add("down");
        arrow.classList.remove("right");
    }
    else if(arrow.classList.contains("down")){
        arrow.style.transform='rotate(-45deg)';
        dets.style.display='none';
        arrow.classList.add("right");
        arrow.classList.remove("down");
    }
}

function bot_display(div,disap_div1,disap_div2){
    div.style.display='block';
    setTimeout(function(){
        div.style.left='0px';
    },100)

    disap_div1.style.left='390px';
    disap_div2.style.left='390px';
    setTimeout(function(){
        disap_div1.style.display='none';
        disap_div2.style.display='none';
    },500)
}

function scrollto(element){
element.scrollIntoView();
}

function bot_appear(){
    bot_wrap=document.getElementById("chatbot_wrapper");
    if(bot_wrap.classList.contains("in")){
        bot_wrap.style.right='0px';
        bot_wrap.classList.add("out");
        bot_wrap.classList.remove("in");
    }
    else if(bot_wrap.classList.contains("out")){
        bot_wrap.style.right='-395px';
        bot_wrap.classList.add("in");
        bot_wrap.classList.remove("out");
    }
}

function mic_search(){

}
