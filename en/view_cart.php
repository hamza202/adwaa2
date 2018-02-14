<?php
session_start(); //start session
include("config.inc.php");
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Review Your Cart Before Buying</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
</head>
<script>        $(document).ready(function(){
        $(".form-item").submit(function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Adding...'); //Loading button text
            window.location.reload();
            $.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType:"json", //expect json value from server
                data: form_data
            }).done(function(data){ //on Ajax success
                $("#cart-info").html(data.items); //total items in cart-info element
                button_content.html('Add to Cart'); //reset button text to original text
                if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
                    $(".cart-box").trigger( "click" ); //trigger click to update the cart box.

                }
            })
            e.preventDefault();

        });
        //Show Items in Cart
        $( ".cart-box").click(function(e) { //when user clicks on cart box
            e.preventDefault();
            $(".shopping-cart-box").fadeIn(); //display cart box
            $("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
            $("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results

        });

        //Close Cart
        $( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
            e.preventDefault();
            $(".shopping-cart-box").fadeOut(); //close cart-box
        });

        //Remove items from cart
        $("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
            e.preventDefault();
            var pcode = $(this).attr("data-code"); //get product code
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
                $("#cart-info").html(data.items); //update Item count in cart-info
                $(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
            });
        });

    });</script>
<body>
<div align="center">
    <h3>Ajax Shopping Cart Example</h3>
</div>

<a href="#" class="cart-box" id="cart-info" title="View Cart">
    <?php
    if(isset($_SESSION["products_a"])){
        echo count($_SESSION["products_a"]);
    }else{
        echo 0;
    }
    ?>
</a>


<div class="shopping-cart-box">
    <a href="#" class="close-shopping-cart-box" >Close</a>
    <h3>Your Shopping Cart</h3>
    <div id="shopping-cart-results">
    </div>
</div>
<h3 style="text-align:center">Review Your Cart Before Buying</h3>

<?php
if(isset($_GET["remove"]) && isset($_SESSION["products_a"]))
{
    $product_code   = filter_var($_GET["remove"], FILTER_SANITIZE_STRING); //get the product code to remove

    if(isset($_SESSION["products_a"][$product_code]))
    {
        unset($_SESSION["products_a"][$product_code]);
    }
    echo "<script> window.location='view_cart.php';</script>";

    $total_items = count($_SESSION["products_a"]);
    die(json_encode(array('items'=>$total_items)));

}

if(isset($_SESSION["products_a"]) && count($_SESSION["products_a"])>0){
	$total 			= 0;
	$list_tax 		= '';
	$cart_box 		= '<ul class="view-cart">';

	foreach($_SESSION["products_a"] as $product){ //Print each item, quantity and price.
        $product_name = $product["product_title"];
        $product_price = $product["product_id"];
        $product_code = $product["product_model"];
        $product_qty = $product["product_qty"];
        $product_photo = $product["product_photo"];
		
		$item_price 	= sprintf("%01.2f",($product_price * $product_qty));  // price x qty = total item price
		
        $cart_box .=  "<form  class='form-item'> <li><img width='80' height='80' src='admin/pic_product/$product_photo'> $product_name (Qty : $product_qty ) 
                           <input type=\"number\" value='$product_qty' name=\"product_qty\"  min=\"1\" max=\"1000000\" >
                        <input name=\"product_model\" type=\"hidden\" value=\"$product_code\">
                        <button  type=\"submit\">Update quantity</button>  <a href='?remove=$product_code' class='remove-item' >Remove</a>&times;</li></form>";

        $subtotal 		= ($product_price * $product_qty); //Multiply item quantity * price
		$total 			= ($total + $subtotal); //Add up to total price
	}

	$grand_total = $total + $shipping_cost; //grand total
	
	foreach($taxes as $key => $value){ //list and calculate all taxes in array
			$tax_amount 	= round($total * ($value / 100));
			$tax_item[$key] = $tax_amount;
			$grand_total 	= $grand_total + $tax_amount; 
	}
	
	foreach($tax_item as $key => $value){ //taxes List
		$list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
	}
	
	$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
	
	//Print Shipping, VAT and Total
	$cart_box .= "<li class=\"view-cart-total\">$shipping_cost  $list_tax <hr>Payable Amount : $currency ".sprintf("%01.2f", $grand_total)."</li>";
	$cart_box .= "</ul>";
	
	echo $cart_box;
}else{
	echo "Your Cart is empty";
}
?>
</form>
</body>
</html>