<?php include('serverCustomer.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: customerLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Reveiw</title>
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
                       <p>Welcome user, <strong><?php echo $_SESSION['userName']; ?></strong>
						   <br>
                        <a href="customerLogin.php" style="color: red;">Logout</a></p>
						
                            
                    <?php endif ?>
                        <a href="customerIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
						<br>
						<br>	 
		              </div>
                        
                        
						
						
						
						
						
						
						<form method = "post" action = "customerReveiw.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          
						<h6>Select a order to give reveiw.</h6>
							 <?php
							$name = $_SESSION['userName'];
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
                            $tableName = "orders";
                            $columnName = "orderNumber";
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $query = "select distinct orderNumber from $tableName where submit = 4 and customerUserName = '$name' and pharmacyReveiw = 0";
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
							

									<?php
								//if the continue button is clicked
								if(isset($_POST['selectOrder'])){
									$pName = $_POST['oName'];
									$order = $pName;
									$_SESSION['orderNumber'] = $order;
									header('location: customerGiveReveiw.php'); 

								}
							?>
							
							
							</div>
							 <button type = "submit" class = "btn btn-primary" name  = "selectOrder" onclick="">Continue</button>
							
							<br>
							<br>
                            
       					 
							
							
						</form>
						</div>
                        
                        
                    
                       
                    <div class = "col-md-7 register-right">
                         <!-- Serch Part Code -->
                       
                         <form method = "post" action = "customerReveiw.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          
						<h5>Reveiw List</h5>
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
                        $sql = "SELECT distinct orderNumber, pharmacyUserName, pharmacyName,phoneNumber, orderDate, status, pharmacyReveiw, customerReveiw from orders where customerUserName = '$name' and submit = 4";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Order Number</th>
									<th>Pharmacy Username</th>
									<th>Pharmacy Name</th>
									<th>Phone Number</th>
									<th>Order Date</th>
                                    <th>Status</th>
									<th>Pharmacy Reveiw</th>
									<th>Customer Reveiw</th>
                                    
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["orderNumber"]. "</td><td>" . $row["pharmacyUserName"]. "</td><td>" . $row["pharmacyName"]. "</td><td>" . $row["phoneNumber"]. "</td><td>" . $row["orderDate"]. "</td><td>" . $row["status"]. "</td><td>" . $row["pharmacyReveiw"]. "</td><td>" . $row["customerReveiw"]. "</td></tr>";
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
                    