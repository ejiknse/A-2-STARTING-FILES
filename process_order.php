<?php 
	
	$itemDescription = ["MacBook", "The Razer", "WD My Passport", "Nexus 7", "DD-45 Drums"];
	$itemPrice = [1899.99, 79.99, 179.99, 249.99, 119.99];

	//validations

	function validatePostalCode($postalCode) {
	    $regex = '/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/';
	    return preg_match($regex, $postalCode);
	}

	function displayError($errors) {
	    echo '<h2>Form could not be processed due to the following errors:</h2>';
	    echo '<ul>';
	    foreach ($errors as $error) {
	        echo '<li>' . $error . '</li>';
	    }
	    echo '</ul>';
	}



	$errors = [];
	$currentYear = date('Y');
	$maxYear = $currentYear+5;
	//VALIDATE FULL NAME
	$fullName = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
	if (empty($fullName)) {
	    $errors[] = 'Full Name is required.';
	}
	//VALIDATE ADDRESS
	$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
	if (empty($address)) {
	    $errors[] = 'Address is required.';
	}
	//VALIDATE CITY
	$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
	if (empty($city)) {
	    $errors[] = 'City is required.';
	}

	//VALIDATE PROVINCE
	$province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
	$validProvinces = ['AB', 'BC', 'MB', 'NB', 'NL', 'NS', 'ON', 'PE', 'QC', 'SK', 'NT', 'NU', 'YT'];
	if (!in_array($province, $validProvinces)) {
	    $errors[] = 'Invalid province selected.';
	}
	//VALIDATE POSTAL CODE
	$postalCode = filter_input(INPUT_POST, 'postal', FILTER_SANITIZE_STRING);
	if (empty($postalCode) || !validatePostalCode($postalCode)) {
	    $errors[] = 'Invalid postal code.';
	}

	//VALIDATE EMAIL
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	if (empty($email)) {
	    $errors[] = 'Email is required.';
	} elseif (!$email) {
	    $errors[] = 'Invalid email address.';
	}

	//VALIDATE CARD TYPE
	$cardType = filter_input(INPUT_POST, 'cardtype', FILTER_SANITIZE_STRING);
	if (empty($cardType)) {
	    $errors[] = 'Card type is required.';
	}
	//VALIDATE CARD NAME
	$cardName = filter_input(INPUT_POST, 'cardname', FILTER_SANITIZE_STRING);
	if (empty($cardName)) {
	    $errors[] = 'Name on card is required.';
	}
	//VALIDARE EXPIRY
	$cardMonth = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 12]]);
	$cardYear = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT, ['options' => ['min_range' => $currentYear, 'max_range' => $maxYear]]);
	if (!$cardMonth) {
	    $errors[] = 'Invalid card expiry month.';
	}
	if (!$cardYear) {
	    $errors[] = 'Invalid card expiry year.';
	}
	//VALIDATE CARD NUMBER

	$cardNumber = filter_input(INPUT_POST, 'cardnumber', FILTER_VALIDATE_INT);
	if (!$cardNumber || strlen((string)$cardNumber) != 10) {
	    $errors[] = 'Invalid card number. Must be a 10-digit number.';
	}


	if(!empty($errors)){
		displayError($errors);
		exit();
	}else{
		$fullname = $_POST['fullname'];
		$address = $_POST['address'];
		$city = $_POST['city'];
	    $province = $_POST['province'];
	    $postal = $_POST['postal'];
	    $email = $_POST['email'];
	    $qty1 = $_POST['qty1'];
	    $qty2 = $_POST['qty2'];
	    $qty3 = $_POST['qty3'];
	    $qty4 = $_POST['qty4'];
	    $qty5 = $_POST['qty5'];
	    
	    $quantities = [];
	        $total = 0;
	        for ($i = 1; $i <= 5; $i++) {
	            $qty = filter_input(INPUT_POST, 'qty' . $i, FILTER_VALIDATE_INT);
	            if ($qty === false || $qty < 0) {
	                $errors[] = "Invalid quantity for item $i.";
	            } else {
	                $quantities[$i] = $qty;
	                $total += $itemPrice[$i - 1] * $qty; 
	            }
	        }

	    $form_data = array(
	        'fullname' => $fullname,
	        'address' => $address,
	        'city' => $city,
	        'province' => $province,
	        'postal' => $postal,
	        'email' => $email,
	        'qty1' => $qty1,
	        'qty2' => $qty2,
	        'qty3' => $qty3,
	        'qty4' => $qty4,
	        'qty5' => $qty5,
	        'total' => $total
	    );

	    $queryStr = http_build_query($form_data);
	    header("Location: thankyou.php?$queryStr");
		exit();

	}




?>
