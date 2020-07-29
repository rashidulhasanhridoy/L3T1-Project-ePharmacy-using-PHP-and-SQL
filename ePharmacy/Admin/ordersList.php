<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Search Orders</title>
		<link rel = "stylesheet" type = "text/css" href = "style1.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
           
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
                       <p><strong></strong>Welcome admin, <strong><?php echo $_SESSION['userName']; ?></strong>
						   <br>
                        <a href="adminLogin.php" style="color: red;">Logout</a>
						<a href="adminIndex.php" style="color: green;">Back</a></p>
                            
                    <?php endif ?>
		              
                        
                        
						
						
						
						
						
						
						<form method = "post" action = "ordersList.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          
							<h6>Search a Order</h6>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "number" placeholder="Enter Order Number">
                            </div>
							 <button type = "submit" class = "btn btn-primary" name  = "selectOrder" onclick="">See Details</button>
							
							<br>
							<br>
                            
                            
                            <?php
	
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
                            $conn = new mysqli($servername, $username, $password, $dbname);
                    
                        
                    if(isset($_POST['selectOrder'])){
                        $orderNumber = $_POST['number'];
                     $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
						if(empty($orderNumber)){
							array_push($errors, "Order Number is required!");
						}
						
						if(count($errors) == 0){
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
						
                            echo "Order Number: " . $orderNumber;
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
							
							//Pharmacy Name
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT pharmacyName from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Pharmacy Name: " . $row["pharmacyName"];

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

                            $sql = "SELECT phoneNumber from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Phone Number: " . $row["phoneNumber"];

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
						
						//Order Date
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT status from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "Status: " . $row["status"]. "<br>";

                                }
                            } else {
                                echo "0 results";
                            }
							
							
                        } else {
                            array_push($errors, "Not found!");
							//echo "Not found!";
                        }
						
						
						//Reveiw Pharmacy
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT pharmacyReveiw from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);
						
							if(mysqli_num_rows($result) > 0)
							{
							  while ($row = mysqli_fetch_array($result))
							  {	
                               echo "Pharmacy Reveiw: " . $row["pharmacyReveiw"];
								
							  }  
							}
						
						
						//Reveiw Customer
						// Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT customerReveiw from orders where orderNumber = '$orderNumber' limit 1";
                            $result = $conn->query($sql);
						
							if(mysqli_num_rows($result) > 0)
							{
							  while ($row = mysqli_fetch_array($result))
							  {	
                               echo "<br>Customer Reveiw: " . $row["customerReveiw"];
							 
							  }  
							}
							
						}
						
						
						
						
						
						
						
						
						
					}
                        $conn->close();
                        ?>
							
                        </div>
                        </form>
						
                        
						
						
						
						
                        
                        </div>
                    
                       
                    
                         <!-- Serch Part Code -->
                       
                         <form method = "post" action = "ordersList.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          <br>
						<h5>Orders List</h5>
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
                        $sql = "SELECT distinct orderNumber, customerUserName, customerName, customerPhoneNumber, pharmacyReveiw, pharmacyUserName, pharmacyName, phoneNumber, customerReveiw, orderDate, status from orders where submit in (1, 3, 4)";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Order Number</th>
									<th>Customer Username</th>
									<th>Customer Name</th>
									<th>PhoneNumber</th>
									<th>Reveiw</th>
									<th>Pharmacy Username</th>
									<th>Pharmacy Name</th>
									<th>PhoneNumber</th>
									<th>Reveiw</th>
									<th>Order Date</th>
                                    <th>Status</th>
                                    
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["orderNumber"]. "</td><td>" . $row["customerUserName"]. "</td><td>" . $row["customerName"]. "</td><td>" . $row["customerPhoneNumber"]. "</td><td>" . $row["pharmacyReveiw"]. "</td><td>" . $row["pharmacyUserName"]. "</td><td>" . $row["pharmacyName"]. "</td><td>" . $row["phoneNumber"]. "</td><td>" . $row["customerReveiw"]. "</td><td>" . $row["orderDate"]. "</td><td>" . $row["status"]. "</td></tr>";
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
	</body>
</html>
                    