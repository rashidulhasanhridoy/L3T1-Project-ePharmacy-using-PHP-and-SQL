<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy</title>
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3 style="color:blue;"><br><br><br>ePharmacy Bangladesh</h3>
                        <script>
                            document.write(Date());
                        </script>
                        <div class = "content">
                    <p>Join with us &amp; make your life safe and easy.</p>
							<!-- count customer -->
                        
								
							<p style="color : blue"><?php
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

                            $sql = "SELECT count(buy) FROM users";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo $row["count(buy)"]."+ registered customers!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
							<!-- count pharmacy -->
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

                            $sql = "SELECT count(sell) FROM pharmacy";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(sell)"]."+ registered pharmacy!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
							<!-- count company -->
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

                            $sql = "SELECT count(distinct productCompany) FROM products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(distinct productCompany)"]."+ medicine company!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							
							<!-- count product -->
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

                            $sql = "SELECT count(distinct productName) FROM products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>".$row["count(distinct productName)"]."+ medicines!";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>
							</p>


                            <!-- logout -->
                        
                   
		</div> 
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                      <br><br><br><br>
                        <form method = "post" action = "index.php">
                        <div class = "register-form" >
                            <p>Are you looking for a safe pharmacy or want to by orginal medicines? HURRY UP! <a href = "Customer/customerRegistration.php">Sign Up</a> now, already have a account? <a href="Customer/customerLogin.php">Sign In</a> now.</p>
							
							<p>Are you looking for a platfrom to increase your business? Join with us today! The biggest online medicine sale platfrom. <a href = "Pharmacy/pharmacyRegistration.php">Sign Up</a> now, <br>already have a account? <a href="Pharmacy/pharmacyLogin.php">Log In</a> now.</p>
							
							<p>Copyright &copy; 2019<a href = "https://github.com/e7hridoy">  Rashidul Hasan Hridoy</a>. All rights reversed.</p>
							
							
                        </div>
                        </form>
                    
                </div>
            
					</div>
			</div>
        </div>
    </div>
</body>
</html>