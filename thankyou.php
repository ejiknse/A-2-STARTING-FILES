<?php

/*******w******** 
    
    Name:Ejiknse Aubagha Ausaji
    Date:
    Description:

****************/

$fullname = $_GET['fullname'];
$address = $_GET['address'];
$city = $_GET['city'];
$province = $_GET['province'];
$postal = $_GET['postal'];
$email = $_GET['email'];
$qty1 = $_GET['qty1'];
$qty2 = $_GET['qty2'];
$qty3 = $_GET['qty3'];
$qty4 = $_GET['qty4'];
$qty5 = $_GET['qty5'];
$total = $_GET['total'];

$itemDescription = ["MacBook", "The Razer", "WD My Passport", "Nexus 7", "DD-45 Drums"];
$itemPrice = [1899.99, 79.99, 179.99, 249.99, 119.99];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Thanks for your order!</title>
</head>
<body>
    <div class="invoice">
    	<h2>Thanks for your order <?php echo htmlspecialchars($fullname); ?>.</h2>
    	<h3>Here's a summary of your order:</h3>
	    <table border="1" width="500">
	        <tr>
	            <td colspan="4"><h3>Address Information</h3></td>
	        </tr>
	        <tr>
	            <td><span class="bold">Address:</span></td>
	            <td><?php echo htmlspecialchars($address); ?></td>
	            <td><span class="bold">City:</span></td>
	            <td><?php echo htmlspecialchars($city); ?></td>
	        </tr>
	        <tr>
	            <td><span class="bold">Province:</span></td>
	            <td><?php echo htmlspecialchars($province); ?></td>
	            <td><span class="bold">Postal Code:</span></td>
	            <td><?php echo htmlspecialchars($postal); ?></td>
	        </tr>
	        <tr>
	            <td colspan="2"><span class="bold">Email:</span></td>
	            <td colspan="2"><?php echo htmlspecialchars($email); ?></td>
	        </tr>
	    </table>
	    <table border="1" width="500">
	        <tr>
	            <td colspan="3"><h3>Order Information</h3></td>
	        </tr>
	        <tr>
	            <td><span class="bold">Quantity</span></td>
	            <td><span class="bold">Description</span></td>
	            <td><span class="bold">Cost</span></td>
	        </tr>
	        <?php 
	        	for ($i=1; $i <= 5 ; $i++) { 
	        		if($_GET['qty'.$i]>0){
	        			?>
						<tr><td><?php echo htmlspecialchars($_GET['qty'.$i]); ?></td><td><?php echo $itemDescription[$i-1];  ?></td><td>$<?php echo ($_GET['qty'.$i]*$itemPrice[$i-1]); ?></td></tr>
	        		<?php
	        		}
	        		
	        	}

	        ?>
	        <tr>
	            <td colspan="2"><span class="bold">Totals</span></td>
	            <td><span class="bold">$ <?php echo htmlspecialchars($total); ?></span></td>
	        </tr>
	    </table>

    </div>

    
</body>
</html>
