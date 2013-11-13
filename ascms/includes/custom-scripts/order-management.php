<?php

// Get Complete Order Details

// Get Customer Details
$sql = "SELECT * FROM `CUSTOMERS` WHERE `id` = '".mysql_real_escape_string($r['CUSTOMER-ID'])."' ";
if($res = mysql_query($sql,$conn)) {
	$customer = mysql_fetch_array($res);	
}

echo "<div style=\"float:left;\">\n";
echo "<div class=\"lineHolder\"><label>Order Status</label>".htmlspecialchars($r['ORDER-STATUS'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Customer</label><a href=\"".BASE_URL_CMS."module.php?module=customer-management&ID=".$customer['ID']."\">".htmlspecialchars($customer['FIRST-NAME'])." ".htmlspecialchars($customer['LAST-NAME'])." - ".htmlspecialchars($customer['EMAIL'])."</a></div><br />";
echo "<div class=\"lineHolder\"><label>Distrib Reference</label>".htmlspecialchars($r['DISTRIB-REF'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Date Submitted</label>".htmlspecialchars($r['DATE-SUBMITTED'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Date Processed</label>".htmlspecialchars($r['DATE-PROCESSED'])."</div><br /><br />";

// Get the Order Data
$orderData = json_decode($r['ORDER-DATA'],true);

echo "<div class=\"lineHolder\"><label>Name On Card</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['nameOnCard'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Card Number</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['cardNumDisplay'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Card Expiry</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['expiryMonth'])." / ".htmlspecialchars($orderData['CHECKOUT_INFO']['expiryYear'])."</div><br /><br />";

echo "<div class=\"lineHolder\"><label>Shipping Name</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['FIRST_NAME'])." ".htmlspecialchars($orderData['CHECKOUT_INFO']['LAST_NAME'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Shipping Address 1</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['DELIVERY_ADDRESS_1'])."</div><br />";
if($orderData['CHECKOUT_INFO']['DELIVERY_ADDRESS_2']) {
	echo "<div class=\"lineHolder\"><label>Shipping Address 2</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['DELIVERY_ADDRESS_2'])."</div><br />";
}
echo "<div class=\"lineHolder\"><label>Shipping Suburb</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['DELIVERY_SUBURB'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Shipping State</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['DELIVERY_STATE'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Shipping Postcode</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['DELIVERY_POSTCODE'])."</div><br />";
echo "</div>\n";

echo "<div style=\"float:left;margin-left:200px;\">\n";
echo "<table cellpadding=\"5\" width=\"500\">";
echo "<tr align=\"left\"><th><strong>Product</strong></th><th><strong>Qty</strong></th><th><strong>Price</strong></th></tr>\n";
if(is_array($orderData['CART'])) {
	foreach($orderData['CART'] as $cart) {
		$product = getProductData($cart[0]);
		echo "<tr align=\"left\"><td>".$product['TITLE']." (".htmlspecialchars($cart[0]).")</td><td>".htmlspecialchars($cart[2])."</td><td>".htmlspecialchars($cart[1])."</td></tr>\n";
	}
}
echo "</table><br /><br />\n";
echo "<div class=\"lineHolder\"><label>Order Shipping</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['BASKET_SHIPPING'])."</div><br />";
echo "<div class=\"lineHolder\"><label>Order Total</label>".htmlspecialchars($orderData['CHECKOUT_INFO']['BASKET_TOTAL'])."</div><br />";
echo "</div>\n";
?>