<?php include('serverCustomer.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: customerLogin.php');
    
}
?>

							
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Cart</title>
		<link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
            width: 100%;
           width: 100%;
           color: #2E86C1;
           font-family: monospace;
           font-size: 18px;
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
                       <h3>ePharmacy Bangladesh</h3>
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
                       <p>Welcome user, <strong><?php echo $_SESSION['userName']; ?></strong></p>
						<p>Selected Pharmacy <strong><?php echo $_SESSION['pharmacyName']; ?></strong></p>
                        <a href="customerLogin.php" style="color: red;">Logout</a>
                             <br>
							 
							 
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="customerMakeOrder.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
						<br>
						
						<?php
						//Confrim Order
                            if(isset($_POST['confrimOrder'])){
							//$pharmacyUserName = $_SESSION['pharmacyUserName'];
							$orderNumber = $_SESSION['orderNumber'];	
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

                            $sql = "Update orders set submit = 1 where orderNumber = '$orderNumber'";
							mysqli_query($db, $sql);	
							header('location: customerIndex.php'); 
                            }
                            ?>
						
						<?php
						//Save Order
                            if(isset($_POST['saveOrder'])){
							//$pharmacyUserName = $_SESSION['pharmacyUserName'];
							$orderNumber = $_SESSION['orderNumber'];	
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

                            $sql = "Update orders set submit = 2 where orderNumber = '$orderNumber'";
							mysqli_query($db, $sql);	
							header('location: customerIndex.php'); 
                            }
                            ?>
						
						<?php
						//Discard Order
                            if(isset($_POST['discardOrder'])){
							//$pharmacyUserName = $_SESSION['pharmacyUserName'];
							$orderNumber = $_SESSION['orderNumber'];	
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

                            $sql = "Delete from orders where orderNumber = '$orderNumber'";
							mysqli_query($db, $sql);	
							header('location: customerIndex.php'); 
                            }
                            ?>
						
						<?php
                    //Edit Product Delete
                    if(isset($_POST['deleteProduct'])){
						$number = $_SESSION['orderNumber'];
                        $Name = $_POST['pName'];
                        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
                        $sql = "Delete from orders where orderNumber = '$number' and productName = '$Name'";
                        mysqli_query($db, $sql);
                    }
                ?>
						<?php
                    //Edit Product Update
                    if(isset($_POST['updateProduct'])){
						$pharmacyUserName = $_SESSION['pharmacyUserName'];
						$number = $_SESSION['orderNumber'];
                        $Name = $_POST['newProductName'];
						$Prize = $_POST['newProductPrize'];
						$Quantity = $_POST['newProductQuantity'];
						$Amount = (int)$Prize * (int)$Quantity;
						
						if(empty($Quantity)){
								array_push($errors, "Product Quantity is required!");
							}
						
							$checkProductQuantity = "SELECT productQuantity FROM products WHERE productName = '$Name' and userName = '$pharmacyUserName' LIMIT 1";
							$result = mysqli_query($db, $checkProductQuantity);
							$res1 = mysqli_fetch_assoc($result);

							$totalQuantity = $res1['productQuantity'];
						
//echo "TQ".$totalQuantity;
							$checkSoldQuantity = "SELECT sum(productQuantity) FROM orders WHERE productName = '$Name' and submit in (1, 3, 4)";
							$result2 = mysqli_query($db, $checkSoldQuantity);
							$res2 = mysqli_fetch_assoc($result2);
							
							$soldQuantity = $res2['sum(productQuantity)'];
						//echo "SQ".$soldQuantity;
						
							//$checkSoldQuantity2 = "SELECT productQuantity FROM orders WHERE productName = '$Name' and orderNumber = '$number' and submit in (1, 3, 4)";
							//$result21 = mysqli_query($db, $checkSoldQuantity2);
							//$res21 = mysqli_fetch_assoc($result21);	
						
							//$soldQuantity2 = $res21['productQuantity'];
							//echo "SQ2".$soldQuantity2;
								
							$buy = (int)$totalQuantity - (int)$soldQuantity;
						
						//echo "Buy".$buy;

							if ((int)$totalQuantity < (int)$soldQuantity + (int)$Quantity) {
								  array_push($errors, "Sorry this product is our of stock right now. So you can buy only " . $buy. " products right now.");
							}
						
							
							if(count($errors) == 0){
							$db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
							$sql = "Update orders set productQuantity = '$Quantity', productTotalAmount = '$Amount' where orderNumber = '$number' and productName = '$Name'";
							mysqli_query($db, $sql);
                    }
					}
                ?>
						
						
							<form method = "post" action = "cart.php">
                        <div class = "register-form" >
                            
                            <!--Get Ordered Product Name-->
                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
                            $tableName = "orders";
                            $columnName = "productName";
							$orderNumber = $_SESSION['orderNumber']; 
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $query = "select * from $tableName where orderNumber = '$orderNumber'";
                            $result = mysqli_query($conn, $query);
                        ?>
                        
                            
                             <!--Search Part -->
                            	<br>
							<h6>Select a Product</h6>
                            
                            <div class = "form-group">
                                <select name = "pName" value = "<?php echo $pName; ?>">
                                    <?php
                                        if($result)
                                        {
                                            while($row = mysqli_fetch_array($result))
                                            { 
                                                $productName = $row["$columnName"];
                                                echo"<option>$productName<br></option>";
                                            }
                                        }
                                    ?>
									<option>0</option>
                                </select>
                            </div>
							
							
                            
                            
                     <?php
                    //Edit Product Search
                        $newProductQuantity = '';
						$newProductName = '';
						$newProductPrize = '';	
                    if(isset($_POST['editProduct'])){
						$number = $_SESSION['orderNumber'];
                        $pName = $_POST['pName'];
                        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
                        $sql = "SELECT productName, productPrize, productQuantity from orders where orderNumber = '$number' and productName = '$pName'";
                        $result = mysqli_query($db, $sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                          while ($row = mysqli_fetch_array($result))
                          {
							$newProductName = $row['productName'];
							$newProductPrize = $row['productPrize'];  
							$newProductQuantity = $row['productQuantity'];
                          }  
                        }

                        else {
                           //echo "not found!";
                        }

                        mysqli_free_result($result);
                        mysqli_close($db);
						
						

                    }
                ?>
							
						
							 <button type = "submit" class = "btn btn-primary" name  = "editProduct" onclick="">Edit</button>
							
							<button type = "submit" class = "btn btn-primary" name  = "deleteProduct" onclick="">Delete</button>
							
							<div class = "form-group">
                                <br><input type = "text" class = "form-control" name = "newProductName" placeholder="Product Name" value = "<?php echo $newProductName; ?>" readonly>
                            </div>
							
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "newProductPrize" placeholder="Product Prize" value = "<?php echo $newProductPrize; ?>" readonly>
                            </div>
							
							<div class = "form-group">
                                <input type = "text" class = "form-control" name = "newProductQuantity" placeholder="Enter Product Quantity" value = "<?php echo $newProductQuantity; ?>">
                            </div>
                            
                 
                            <button type = "submit" class = "btn btn-primary" name  = "updateProduct" onclick="">Update</button>
							
                            <br>
                            <br>
                            <br>
						 
                            
                        </div>
                        </form>
				 
						
                        </div>
                    
                       
                    <div class = "col-md-7 register-right">
						
                         <form method = "post" action = "cart.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!-- Order Table -->
                        <?php
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
								//show total amount
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
                                    echo "<br>Total Amount: 0" . $row["sum(productTotalAmount)"]." BDT";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></strong></p>
							
							
							
							<button type = "submit" class = "btn btn-primary" name  = "confrimOrder" onclick="">Confirm</button>
							
							<button type = "submit" class = "btn btn-primary" name  = "discardOrder" onclick="">Discard</button>
							
							<button type = "submit" class = "btn btn-primary" name  = "saveOrder" onclick="">Save</button>
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
                    