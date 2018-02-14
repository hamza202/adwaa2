    <?php
session_start(); //start session
include_once("config.inc.php"); //include config file
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
############# add products to session #########################
if(isset($_POST["product_model"]))
{
	foreach($_POST as $key => $value){
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
	}
	
	//we need to get product name and price from database.
	$statement = $mysqli_conn->prepare("SELECT product_title,product_id,product_photo FROM product_add WHERE product_model=? LIMIT 1");
	$statement->bind_param('s', $new_product['product_model']);
	$statement->execute();
	$statement->bind_result($product_name, $product_price,$product_photo);
	

	while($statement->fetch()){ 
		$new_product["product_title"] = $product_name; //fetch product name from database
		$new_product["product_id"] = $product_price;  //fetch product price from database
        $new_product["product_photo"] = $product_photo;  //fetch product price from database

        if(isset($_SESSION["products_a"])){  //if session var already exist
			if(isset($_SESSION["products_a"][$new_product['product_model']])) //check item exist in products array
			{
				unset($_SESSION["products_a"][$new_product['product_model']]); //unset old item
			}			
		}
		
		$_SESSION["products_a"][$new_product['product_model']] = $new_product;	//update products with new item array
	}
	
 	$total_items = count($_SESSION["products_a"]); //count total items
	die(json_encode(array('items'=>$total_items))); //output json 

}

################## list products in cart ###################
if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1)
{

	if(isset($_SESSION["products_a"]) && count($_SESSION["products_a"])>0){ //if we have session variable
		$cart_box = '<ul class="cart-products-loaded">';
		$total = 0;
		foreach($_SESSION["products_a"] as $product){ //loop though items and prepare html content
			
			//set variables to use them in HTML content below
			$product_name = $product["product_title"];
			$product_price = $product["product_id"];
			$product_code = $product["product_model"];
			$product_qty = $product["product_qty"];
            $product_photo = $product["product_photo"];



            $cart_box .=  "<li class='posr'><img width='80' height='80' src='admin/pic_product/$product_photo'> <span class='cart-name'> $product_name </span><span class='qty'>(Qty : $product_qty )</span> 
                          <a href=\"#\" class=\"remove-item\" data-code=\"$product_code\">&times;</a></li>";

            $subtotal = ($product_price * $product_qty);
			$total = ($total + $subtotal);
		}
		$cart_box .= "</ul>";
		$cart_box .= '<div class="cart-products-total"> <a href="view_cart.php" class="cart-checkout" title="Review Cart and Check-Out">Check Out</a></div>';

        die($cart_box); //exit and output content
	}else{
		die("Your Cart is empty"); //we have empty cart
	}
}


################# remove item from shopping cart ################
if(isset($_GET["remove_code"]) && isset($_SESSION["products_a"]))
{
	$product_code   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

	if(isset($_SESSION["products_a"][$product_code]))
	{
		unset($_SESSION["products_a"][$product_code]);
	}
	
 	$total_items = count($_SESSION["products_a"]);
	die(json_encode(array('items'=>$total_items)));
}