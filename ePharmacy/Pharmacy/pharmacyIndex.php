<?php include('serverPharmacy.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: pharmacyLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Welcome</title>
    <link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br><br>ePharmacy Bangladesh</h3>
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
                         <!-- main part------------------------------------------------ -->
                        <p ><?php
                            $name = $_SESSION['userName']; 
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

                            $sql = "SELECT name, email, phoneNumber, pharmacyName, drugLicenseNumber, joinDate FROM pharmacy where userName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["name"]."<br>Email: " . $row["email"]."<br>Phone Number: " . $row["phoneNumber"]."<br>Pharmacy Name: " . $row["pharmacyName"]."<br>Drug License Number: " . $row["drugLicenseNumber"]."<br>Join Date: " . $row["joinDate"]. "<br>";

                                }
								
								//reveiw
								$reveiw = "SELECT avg(pharmacyReveiw) FROM orders WHERE pharmacyUserName = '$name' and submit = 4 and not pharmacyReveiw = 0 ";
                            	$result = $conn->query($reveiw);
                            	if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "Reveiw: " . $row["avg(pharmacyReveiw)"];

                                }
                            }
                            }
							
							else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></p>



                            <!-- logout -->
                        <a href="pharmacyIndex.php?logout='1'" style="color: red;">Logout</a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <button type = "button" class = "btn btn-primary" >Home</button>
                        <br>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                       <br><br><br><br>
                        <form method = "post" action = "pharmacyIndex.php">
                        <div class = "register-form" >
                            <a href="updateProfile.php"><button type = "button" class = "btn btn-primary" >Update Profile</button></a>
							<a href="changePassword.php"><button type = "button" class = "btn btn-primary" >Change Password</button></a>
							 <a href="customerList.php"><button type = "button" class = "btn btn-primary" >Customer List</button></a>
							<br><br>
                             <a href="pharmacyList.php"><button type = "button" class = "btn btn-primary" >Pharmacy List</button></a>
							<br><br>
							<a href="addProducts.php"><button type = "button" class = "btn btn-primary" >Add Products</button></a>
                             <a href="viewProducts.php"><button type = "button" class = "btn btn-primary" >View Products</button></a>
                             <a href="updateProducts.php"><button type = "button" class = "btn btn-primary" >Update Products</button></a>
							<br><br>
							<a href="searchOrder.php"><button type = "button" class = "btn btn-primary" >Search Order</button></a>
							<a href="pharmacyOrdersRequest.php"><button type = "button" class = "btn btn-primary" >Orders Request</button></a>
							
							<a href="delivery.php"><button type = "button" class = "btn btn-primary" >Delivery</button></a>
							<br><br>
							<a href="completedOrders.php"><button type = "button" class = "btn btn-primary" >Completed Orders</button></a>
							<a href="pharmacyReveiw.php"><button type = "button" class = "btn btn-primary" >Reveiw</button></a>
                           
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>