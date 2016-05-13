<?php
	// create short variable names
	error_reporting(E_ALL);
	$oilqty = 0;
	$sparkqty = 0;
	$tireqty = 0;
	
	$fp = fopen("$DOCUMENT_ROOT/../orders/orders.txt", "ab");
	
	if (is_numeric($_POST['tireqty'])) {
		$tireqty = (int) $_POST['tireqty'];
	}

	$oilqty = (int) $_POST['oilqty'];
	$sparkqty = (int) $_POST['sparkqty'];
	$address = $_POST['address'];
	$find = $_POST['find'];
	$totalqty = 0;
	$totalqty = $tireqty + $oilqty + $sparkqty;
	?>
<html>
    <head>
        <title>Bob's Auto PArts - Order Results</title>
    <link rel="stylesheet" src="styles/styles.css">
    </head>
    <body>
        <h1 style="font-family:Helvetica, sans-serif; color: #053897">Bob's Auto PArts</h1>
        <h2>Order Results</h2>
        <?php
	echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";
	
	if ($totalqty == 0) {
		echo '<p style="color:red">You did not order anything on the previous page! <br/></p>';
		return false;
	}

	
	if (!is_int($tireqty)) {
		echo '<p style="color:red">thank you for your order but please enter valid order quantity<br/></p>';
		return false;
	} else {
		echo '<p style="color:green">thank you for your order!</p>';
	}

	echo '<p> Your order is as follows: </p>';
	echo $tireqty.' tires<br />';
	echo $oilqty.' bottle of oil<br />';
	echo $sparkqty.' spark plugs<br />';
	echo "Items ordered: ".$totalqty."<br />";
	$totalamount = 0.00;
	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);
	$totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
	echo "Subtotal: $".number_format($totalamount,2)."<br />";
	$taxrate = 0.10;
	// local sales tax is 10%
	$totalamount = $totalamount * (1 + $taxrate);
	echo "Total including tax: $".number_format($totalamount,2)."<br /> <br />";
	switch($find) {
		case "a" :
			echo "<p style='color:pink'>Regular Customer.</p>";
			break;
		case "b" :
			echo "<p style='color:pink'>Customer referred by TV advert.</p>";
			break;
		case "c" :
			echo "<p style='color:pink'>Referred by phone directory.</p>";
			break;
		case "d" :
			echo "<p style='color:pink'>Referred by word of mouth.</p>";
			break;
		default :
			echo "<p style='color:pink'>No idea how customer heard about us.</p>";
			break;
	}

echo "<br/> <br/>";
?>
    </body>
</html>