<?php include('serverCustomer.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: customerLogin.php');
    
}
?>


							<?php
							//Buy Products
                            if(isset($_POST['addToCart'])){
                            $ProductName = $_POST['ProductName'];
							$CompanyName = $_POST['ProductCompany'];
							$ProductPrize = $_POST['ProductPrize'];
							$ProductQuantity = $_POST['productQuantity'];
							$ProductTotalAmount = (int)$ProductPrize * (int)$ProductQuantity;
                            $date = $_SESSION['date'];
							$orderNumber = $_SESSION['orderNumber'];
							$customerUserName = $_SESSION['userName'];
							$pharmacyUserName = $_SESSION['pharmacyUserName'];
							$pharmacyName = $_SESSION['pharmacyName'];
							$phoneNumber = $_SESSION['phoneNumber'];
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
								
							if(empty($ProductName)){
								array_push($errors, "Product Name is required!");
							}	
								
							if(empty($CompanyName)){
								array_push($errors, "Company Name is required!");
							}
							if(empty($ProductPrize)){
								array_push($errors, "Product Prize is required!");
							}
								
							if(empty($ProductQuantity)){
								array_push($errors, "Product Quantity is required!");
							}
								
							$checkProductQuantity = "SELECT productQuantity FROM products WHERE productName = '$ProductName' and userName = '$pharmacyUserName'";
							$result = mysqli_query($db, $checkProductQuantity);
							$res1 = mysqli_fetch_assoc($result);

							$totalQuantity = $res1['productQuantity'];

							$checkSoldQuantity = "SELECT sum(productQuantity) FROM orders WHERE productName = '$ProductName' and submit in (1, 3, 4)";
							$result2 = mysqli_query($db, $checkSoldQuantity);
							$res2 = mysqli_fetch_assoc($result2);

							$soldQuantity = $res2['sum(productQuantity)'];
								
							$buy = (int)$totalQuantity - (int)$soldQuantity;
								
								
								
							$sql7 = "SELECT name FROM users WHERE userName = '$customerUserName'";
							$result7 = mysqli_query($db, $sql7);
							$res7 = mysqli_fetch_assoc($result7);
							$customerName = $res7['name'];
							
							$sql8 = "SELECT phoneNumber FROM users WHERE userName = '$customerUserName'";
							$result8 = mysqli_query($db, $sql8);
							$res8 = mysqli_fetch_assoc($result8);
							$customerPhoneNumber = $res8['phoneNumber'];
							
							

							if ((int)$totalQuantity < (int)$soldQuantity + (int)$ProductQuantity) {
								  array_push($errors, "Sorry our stock is limited for this product! You can buy only ".$buy. " products right now.");
							}	
							
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 
							if(count($errors) == 0){
                            $sql = "insert into orders (orderNumber, pharmacyUserName, pharmacyName, phoneNumber, customerUserName, customerName, customerPhoneNumber, productName, productCompany, productPrize, productQuantity, productTotalAmount, orderDate, status, submit) values('$orderNumber', '$pharmacyUserName','$pharmacyName', '$phoneNumber', '$customerUserName', '$customerName', '$customerPhoneNumber', '$ProductName', '$CompanyName', '$ProductPrize', '$ProductQuantity', '$ProductTotalAmount', '$date', 'pending', '0')";    
                            $result = $conn->query($sql);    
                                
                            $conn->close();
                            }
							}
                            ?>
                        


<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Make a Order</title>
		<link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
            width: 100%;
           width: 100%;
           color: #2E86C1;
           font-family: monospace;
           font-size: 16px;
           text-align: left;
             } 
          th {
           background-color: #2E86C1;
           color: white;
            }
          tr:nth-child(even) {background-color: #f2f2f2}
        </style>
	</head>
    
		
	<body>
        <br>
         <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br>ePharmacy Bangladesh</h3>
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
                       <p>Welcome <strong><?php echo $_SESSION['userName']; ?></strong></p>
							 <p>Selected Pharmacy <strong><?php echo $_SESSION['pharmacyName']; ?></strong></p>
							 
							 
                        <a href="customerLogin.php" style="color: red;">Logout</a>
                             <br>
							 
							 
							 <?php
							if(isset($_POST['seeCart'])){
								$pharmacyUsername1 = $_SESSION['pharmacyUserName'];
								$pharmacyName1 = $_SESSION['pharmacyName'];
								$orderNumber = $_SESSION['orderNumber'];
								$phoneNumber = $_SESSION['phoneNumber'];
								$_SESSION['pharmacyUserName'] = $pharmacyUsername1;
								$_SESSION['pharmacyName'] = $pharmacyName1;
								$_SESSION['orderNumber'] = $orderNumber;
								$_SESSION['phoneNumber'] = 	$phoneNumber;
								header('location: cart.php'); 
							}
                
							?>
							 
							 
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="customerIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
						
					
						
						
						<br>
						<br>
						<?php
						//Order Table
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "ePharmacy";
						$orderNumber = $_SESSION['orderNumber'];	 

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 
                        $sql = "SELECT productName, productCompany, productPrize, productQuantity, productTotalAmount from orders where orderNumber = '$orderNumber'";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Company</th>
                                    <th>Product Prize</th>
                                    <th>Product Quantity</th>
                                    <th>Amount</th>
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["productName"]. "</td><td>" . $row["productCompany"]. "</td><td>" . $row["productPrize"]. "</td><td>" . $row["productQuantity"]. "</td><td>" . $row["productTotalAmount"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "";
                        }

                        $conn->close();
                        ?>
						
						<p> <strong><?php
							//Show total amount
                            $number = $_SESSION['orderNumber']; 
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT sum(productTotalAmount) from orders where orderNumber = '$number'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Total Amount: " . $row["sum(productTotalAmount)"]." BDT";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></strong></p>
						
                        </div>
					
					
                    
                       
                    <div class = "col-md-7 register-right">
						<p ><?php
							//Search Product
							$ProductName = '';
							$CompanyName = '';
							$ProductPrize = '';
							$ProductQuantity = '';
							$totalAmount = '';
                            if(isset($_POST['searchProduct'])){
                            $name = $_POST['pName'];
							$pharmacyUserName = $_SESSION['pharmacyUserName'];	
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
							$orderNumber = $_SESSION['orderNumber'];	
							if(empty($name)){
								array_push($errors, "Product Name is required!");
							}
								
								
							
								
							if(count($errors) == 0){
							$checkProductQuantity1 = "SELECT productQuantity FROM products WHERE productName = '$name' and userName = '$pharmacyUserName'";
							$result4 = mysqli_query($db, $checkProductQuantity1);
							$res14 = mysqli_fetch_assoc($result4);

							$totalQuantity12 = $res14['productQuantity'];
							//	
							//echo "TQ".$totalQuantity12;	
								

							$checkSoldQuantity1 = "SELECT sum(productQuantity) FROM orders WHERE productName = '$name' and submit in (1, 3, 4) and pharmacyUserName = '$pharmacyUserName'";
							$result24 = mysqli_query($db, $checkSoldQuantity1);
							$res21 = mysqli_fetch_assoc($result24);

							$soldQuantity1 = $res21['sum(productQuantity)'];
							//	
							//echo "SQ".$soldQuantity1;	
								
							if ((int)$totalQuantity12 <= (int)$soldQuantity1) {
								  array_push($errors, "Sorry this product is out of stock right now!");
							}		

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

							if(count($errors) == 0){	
                            $sql = "SELECT productName, productCompany, productPrize FROM products where productName = '$name' and userName = '$pharmacyUserName'";
                            $result3 = $conn->query($sql);

                             if(mysqli_num_rows($result) > 0)
							{
							  while ($row = mysqli_fetch_array($result3))
							  {
								$ProductName = $row['productName'];
								$CompanyName = $row['productCompany'];
								$ProductPrize = $row['productPrize'];
							  }  
							}
                        	else {
                            echo "Not found!";
                        }
                            $conn->close();
								
                            }
							}
							}
                            ?></p>
						
                         <form method = "post" action = "customerMakeOrder.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!-- Serch Part Code -->
                        
                            <h6>Search a Product</h6>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "pName" placeholder="Enter Product Name" value = "<?php echo $name; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchProduct" onclick="">Search</button>
                            
                            <br>
							
                            <div class = "form-group">
                                <br><input type = "text" class = "form-control" name = "ProductName" placeholder="Product Name" value = "<?php echo $ProductName; ?>" readonly>
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "ProductCompany" placeholder="Company Name" value = "<?php echo $CompanyName; ?>" readonly>
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "ProductPrize" placeholder="Product Prize" value = "<?php echo $ProductPrize; ?>" readonly>
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productQuantity" placeholder="Enter Product Quantity" value = "<?php echo $ProductQuantity; ?>">
                            </div>
                            
                 
                            <button type = "submit" class = "btn btn-primary" name  = "addToCart" onclick="">Add to Cart</button>
							
							 <button type = "submit" class = "btn btn-primary" name  = "seeCart" onclick="">See Cart</button>
                          
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
                    