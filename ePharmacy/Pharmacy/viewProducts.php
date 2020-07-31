<?php include('serverPharmacy.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: pharmacyLogin.php');
    
}
?>
<?php include('server2Pharmacy.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | View Products</title>
		<link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
            width: 100%;
           width: 100%;
           color: #2E86C1;
           font-family: monospace;
           font-size: 15px;
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
                       <p>Welcome pharmacy, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                        <a href="pharmacyIndex.php?logout='1'" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="pharmacyIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                        <!-- Serch Part Code -->
                            <!-- Search Customer -->
                        <p ><?php
                            if(isset($_POST['searchProduct'])){
                            $name = $_POST['productName'];
                            $userName = $_SESSION['userName'];    
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
								
							if(empty($name)){
								array_push($errors, "Product name is required!");
							}
								
							if(count($errors) == 0){	

                            $sql = "SELECT sl, productName, productCompany, productPrize, addDate FROM products where userName = '$userName' and productName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>SL: " . $row["sl"]."<br>Product Name: " . $row["productName"]."<br>Product Company: " . $row["productCompany"]."<br>Product Prize: " . $row["productPrize"]."<br>Add Date: " . $row["addDate"]."";

                                }
								
							//remain quqntity  check	
							$checkProductQuantity1 = "SELECT productQuantity FROM products WHERE productName = '$name' and userName = '$userName'";
							$result4 = mysqli_query($db, $checkProductQuantity1);
							$res14 = mysqli_fetch_assoc($result4);

							$totalQuantity12 = $res14['productQuantity'];
							//	
							//echo "TQ".$totalQuantity12;	
								

							$checkSoldQuantity1 = "SELECT sum(productQuantity) FROM orders WHERE productName = '$name' and submit in (1, 3, 4) and pharmacyUserName = '$userName'";
							$result24 = mysqli_query($db, $checkSoldQuantity1);
							$res21 = mysqli_fetch_assoc($result24);
							$soldQuantity1 = $res21['sum(productQuantity)'];
							//	
							echo "<br>Sold Quantity: ".$soldQuantity1;
								
							echo "<br>Remain Quantity: ".($totalQuantity12 - $soldQuantity1);	
								
								
                            } else {
								array_push($errors, "Product not found!");
                            }
							}
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        
                         <form method = "post" action = "viewProducts.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productName" placeholder="Enter Product Name" value = "<?php echo $productName; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchProduct" onclick="">Search</button>
                          
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5>Product List</h5>
                        <?php
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
                        $name = $_SESSION['userName'];
                        $sql = "SELECT sl, productName, productCompany, productQuantity, productPrize, addDate FROM products where userName = '$name'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Quantity</th>
                                    <th>Prize</th>
                                    <th>Add Date</th>
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["sl"]. "</td><td>" . $row["productName"]. "</td><td>" . $row["productCompany"]. "</td><td>" . $row["productQuantity"]. "</td><td>" . $row["productPrize"]. "</td><td>" . $row["addDate"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No products stored in database! To add products, click on Back and then go to Add Products.";
                        }

                        $conn->close();
                        ?> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
	</body>
</html>