<?php include('serverPharmacy.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: pharmacyLogin.php');
    
}
?>
<?php include('server2Pharmacy.php'); ?>


<!-- search data on database -->

<?php
    //if the search button is clicked
	if(isset($_POST['searchProduct'])){
        $searchProductName = $_POST['searchProductName'];
        $userName = $_SESSION['userName'];
        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
		
		if(empty($searchProductName)){
			array_push($errors, "Product Name is required!");
		}
		
		
		if(count($errors) == 0){
		
        $sql = "SELECT productName, productCompany, productQuantity, productPrize FROM products where userName = '$userName' and productName = '$searchProductName'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $productName = $row['productName'];
            $productCompany = $row['productCompany'];
            $productQuantity = $row['productQuantity'];
            $productPrize = $row['productPrize'];
          }
			
			
								
        }
        
        else {
			array_push($errors, "Not found in database!");
            //echo "<font color='red'>Not found in database!</font>";
            $productName = "";
            $productCompany = "";
            $productQuantity = "";
            $productPrize = "";
        }
		
        
        mysqli_free_result($result);
        mysqli_close($db);
		
        
	}
	

    else{
         $productName = "";
         $productCompany = "";
         $productQuantity = "";
         $productPrize = "";
    }
	}

?>
    

<?php
    //update products
	if(isset($_POST['updateProducts'])){
        $productName = $_POST['productName'];
        $productQuantity = $_POST['productQuantity'];
        $productPrize = $_POST['productPrize'];
        $userName = $_SESSION['userName'];
        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
        
		//ensure that the form fields are filled properly
        
        if(empty($productQuantity)){
			array_push($errors, "Product Quantity is required!");
		}
        if(empty($productPrize)){
			array_push($errors, "Product Prize is required!");
		}
        
		//if there are no error, save user to database
        
        $productName = strtoupper($productName);
        $productCompany = strtoupper($productCompany);
		
		//remain quqntity  check	
							$checkProductQuantity1 = "SELECT productQuantity FROM products WHERE productName = '$productName' and userName = '$userName'";
							$result4 = mysqli_query($db, $checkProductQuantity1);
							$res14 = mysqli_fetch_assoc($result4);

							//$totalQuantity12 = $res14['productQuantity'];
							//	
							//echo "TQ".$totalQuantity12;	
								

							$checkSoldQuantity1 = "SELECT sum(productQuantity) FROM orders WHERE productName = '$productName' and submit in (1, 3, 4) and pharmacyUserName = '$userName'";
							$result24 = mysqli_query($db, $checkSoldQuantity1);
							$res21 = mysqli_fetch_assoc($result24);
							$soldQuantity1 = $res21['sum(productQuantity)'];
							//	
							//echo "<br>Sold Quantity: ".$soldQuantity1;
								
							//echo "<br>Remain Quantity: ".($totalQuantity12 - $soldQuantity1);
			
							//$productQuantity = $totalQuantity12 - $soldQuantity1;
			
							if ((int)$productQuantity < (int)$soldQuantity1) {
								  array_push($errors, "Sorry! ".$soldQuantity1. " products are already sold. You quantiny must be equal or more than ".$soldQuantity1.".<br>");
							}
		
		
		
		if(count($errors) == 0){
							$sql = "UPDATE products set productQuantity = '$productQuantity', productPrize = '$productPrize' WHERE userName = '$userName' and productName = '$productName'";
			
							mysqli_query($db, $sql);
            				header('location: pharmacyIndex.php');
		}
        
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Update Products</title>
		<link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	</head>
    
		
	<body>
        <br>
         <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br><br><br>ePharmacy Bangladesh</h3>
                        <p>Join with us & make your life easy.</p>
                        <script>
                            document.write(Date());
                        </script>
                         <div class = "content">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class = "error success">
                            <h3>
                                <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                            </h3>
                        </div>

                    <?php endif ?>
                    <!-- welcome -->
                    <?php  if (isset($_SESSION['userName'])) : ?>
                       <p>Welcome pharmacy, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                        <a href="pharmacyIndex.php?logout='1'" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="pharmacyIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5><br><br>Update Products Information</h5>
                        <form method = "post" action = "updateProducts.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <br><input type = "text" class = "form-control" name = "searchProductName" placeholder="Enter Product Name" value = "<?php echo $searchProductName; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchProduct" onclick="">Search</button>
                                
                            <!--Update Part -->
                            
                          <div class = "form-group">
                                <input type = "hidden" class = "form-control" name = "userName1" placeholder="User Name" value = "<?php echo $_SESSION['userName']; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productName" placeholder="Product Name" value = "<?php echo $productName; ?>"readonly>
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productCompany" placeholder="Product Company" value = "<?php echo $productCompany; ?>"readonly>
                            </div>
                           <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productQuantity" placeholder="Quantity" value = "<?php echo $productQuantity; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productPrize" placeholder="Prize" value = "<?php echo $productPrize; ?>">
                            </div>
                            
                            
                            <button type = "submit" class = "btn btn-primary" name  = "updateProducts" onclick="">Update Products</button>
                            
                            
                            <br>
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
	</body>
</html>