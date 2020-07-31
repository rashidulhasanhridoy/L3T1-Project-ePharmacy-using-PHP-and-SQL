<?php
	//session_start();
    $userName1 = "";
    $productName = "";
    $productCompany = "";
    $productQuantity = "";
    $productPrize = "";
    $searchProductName = "";
    $errors = array();
    
    //connect to database
	$db = mysqli_connect('localhost', 'root', '', 'ePharmacy');

    
    //if the sing up button is clicked
	if(isset($_POST['addProducts'])){
        $userName1 = mysqli_real_escape_string($db, $_POST['userName1']);
        $productName = mysqli_real_escape_string($db, $_POST['productName']);
        $productCompany = mysqli_real_escape_string($db, $_POST['productCompany']);
        $productQuantity = mysqli_real_escape_string($db, $_POST['productQuantity']);
        $productPrize = mysqli_real_escape_string($db, $_POST['productPrize']);
        
        
		//ensure that the form fields are filled properly
        if(empty($productName)){
			array_push($errors, "Product Name is required!");
		}
        if(empty($productCompany)){
			array_push($errors, "Company is required!");
		}
        if(empty($productQuantity)){
			array_push($errors, "Product Quantity is required!");
		}
        if(empty($productPrize)){
			array_push($errors, "Product Prize is required!");
		}
        
		//if there are no error, save user to database
        
        $productName = strtoupper($productName);
        $productCompany = strtoupper($productCompany);
        
        //if product already exists
        //imcomplete part
		
		if(count($errors) == 0){
            $addDate = date("M,d,Y h:i:s A");
			$sql = "INSERT INTO products(userName, productName, productCompany, productQuantity, productPrize, addDate) VALUES('$userName1', '$productName', '$productCompany', '$productQuantity', '$productPrize', '$addDate')";
			mysqli_query($db, $sql);
			header('location: pharmacyIndex.php');
		
		}
        
	}

    
	//logout
	
	if (isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['userName']);
		header('location: pharmacyLogin.php'); 
	}	




?>