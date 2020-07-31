<?php include('serverPharmacy.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: pharmacyLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Order Requests</title>
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
						<!--
                       <h3><br>ePharmacy Bangladesh</h3>
                        <p>Join with us & make your life easy.</p>
                        <script>
                            document.write(Date());
                        </script>
						-->
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
                       <p><strong>ePharmacy, </strong>Welcome pharmacy <strong><?php echo $_SESSION['userName']; ?></strong>
						   <br>
                        <a href="pharmacyLogin.php" style="color: red;">Logout</a>
						<a href="pharmacyIndex.php" style="color: green;">Back</a></p>
                            
                    <?php endif ?>
		              </div>
                        
                        
						
						
						
						
						
						
						<form method = "post" action = "pharmacyOrdersRequest.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          
						<h6>Select a Order</h6>
							 <?php
							$name = $_SESSION['userName'];
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
                            $tableName = "orders";
                            $columnName = "orderNumber";
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $query = "select distinct orderNumber from $tableName where submit = 1 and pharmacyUserName = '$name'";
                            $result = mysqli_query($conn, $query);
                        ?>
                        
                            
                            <div class = "form-group">
                                <select name = "oName" value = "<?php echo $pName; ?>">
                                    <?php
                                        if($result)
                                        {
                                            while($row = mysqli_fetch_array($result))
                                            { 
                                                $orderNumber = $row["$columnName"];
                                                echo"<option>$orderNumber<br></option>";
                                            }
                                        }
                                    ?>
									<option value="">0</option>
                                </select>
                            </div>
							
							
							 <button type = "submit" class = "btn btn-primary" name  = "selectOrder" onclick="">See Details</button>
							
							<br>
							<br>
                            
                            
                            <?php
                    //if the see button is clicked
                        
                    if(isset($_POST['selectOrder'])){
                        $orderNumber = $_POST['oName'];
                     $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 
                        $sql = "SELECT distinct productName, productCompany, productPrize, productQuantity, productTotalAmount from orders where orderNumber = '$orderNumber'";
                             
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
							//Order  Number
						
                            echo "<br>Order NUmber: " . $orderNumber;
						//Customer Name
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT customerName from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Customer Name: " . $row["customerName"];

                                }
                            } else {
                                echo "0 results";
                            }
						
						
						//Customer Phone Number
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT customerPhoneNumber from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Phone Number: " . $row["customerPhoneNumber"];

                                }
                            } else {
                                echo "0 results";
                            }
						
						
						
						
						//Total amount
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT sum(productTotalAmount) from orders where orderNumber = '$orderNumber'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Total Amount: " . $row["sum(productTotalAmount)"]." BDT";

                                }
                            } else {
                                echo "0 results";
                            }
						
						//Order Date
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT orderDate from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Order Date: " . $row["orderDate"]. "<br>";

                                }
                            } else {
                                echo "0 results";
                            }
						
                        } else {
                            echo "No orders!";
                        }
						
					
						
					}
                        $conn->close();
                        ?>
							
								
							
							
							<?php
						//Ready Order
                            if(isset($_POST['readyOrder'])){
							//$pharmacyUserName = $_SESSION['pharmacyUserName'];
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

                            $sql = "Update orders set submit = 3, status = 'ready' where orderNumber = '$orderNumber'";
							mysqli_query($db, $sql);
								
							echo $orderNumber." is ready to deliver!";
							header('location: pharmacyIndex.php');	
                            }
                            ?>
						
						
							
							<br>
							
							<button type = "submit" class = "btn btn-primary" name  = "readyOrder" onclick="">Ready</button>
                        </div>
                        </form>
						
                        
						
						
						
						
                        
                        </div>
                    
                       
                    <div class = "col-md-7 register-right">
                         <!-- Serch Part Code -->
                       
                         <form method = "post" action = "customerSelectPharmacy.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          
						<h5>Check Orders Request</h5>
						<?php
						$name = $_SESSION['userName'];
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "ePharmacy";
							 
							 
					//ordersTable		 

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 
                        $name = $_SESSION['userName'];
                        $sql = "SELECT distinct orderNumber, customerUserName, customerName,customerPhoneNumber, orderDate, status from orders where pharmacyUserName = '$name' and submit = 1";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Order Number</th>
									<th>Customer Username</th>
									<th>Customer Name</th>
									<th>PhoneNumber</th>
									<th>Order Date</th>
                                    <th>Status</th>
                                    
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["orderNumber"]. "</td><td>" . $row["customerUserName"]. "</td><td>" . $row["customerName"]. "</td><td>" . $row["customerPhoneNumber"]. "</td><td>" . $row["orderDate"]. "</td><td>" . $row["status"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "You have no order yet!";
                        }

                        $conn->close();
                        ?> 
                            
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
	</body>
</html>
                    