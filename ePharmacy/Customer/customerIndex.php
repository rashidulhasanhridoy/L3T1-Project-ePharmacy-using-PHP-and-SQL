<?php include('serverCustomer.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: customerLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Welcome</title>
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
                       <p>Welcome user, <strong><?php echo $_SESSION['userName']; ?></strong></p>
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

                            $sql = "SELECT buy, joinDate, userName, name, gender, email, phoneNumber from users where userName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["name"]."<br>Join Date: " . $row["joinDate"]."<br>Username: " . $row["userName"]."<br>Gender: " . $row["gender"]."<br>Email: " . $row["email"]. "<br>Phone Number: " . $row["phoneNumber"]. "<br>". "Buy Status: " . $row["buy"]. "<br>";

                                }
								
								//reveiw
								$reveiw = "SELECT avg(customerReveiw) FROM orders WHERE customerUserName = '$name' and submit = 4 and not customerReveiw = 0 ";
                            	$result = $conn->query($reveiw);
                            	if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "Reveiw: " . $row["avg(customerReveiw)"];

                                }
                            }
                            }
							
							
							
							else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></p>



                            <!-- logout -->
                            <a href="customerIndex.php?logout='1'" style="color: red;">Logout</a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <button type = "button" class = "btn btn-primary" >Home</button>
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br><br><br><br><br><br><br>
                        <form method = "post" action = "customerIndex.php">
                        <div class = "register-form" >
                            <a href="customerEditProfile.php"><button type = "button" class = "btn btn-primary" >Edit Profile</button></a>
                            <a href="customerChangePassword.php"><button type = "button" class = "btn btn-primary" >Change Password</button></a>
                            <a href="pharmacyList.php"><button type = "button" class = "btn btn-primary" >Pharmacy List</button></a>
                            <br><br>
                            <a href="searchMedicine.php"><button type = "button" class = "btn btn-primary" >Search Medicine</button></a>
                            <a href="customerSelectPharmacy.php"><button type = "button" name = "" class = "btn btn-primary" >Make a Order</button></a>
							<a href="customerOrderStatus.php"><button type = "button" name = "" class = "btn btn-primary" >Order Status</button></a>
							<br>
							<br>
							<a href="customerConfirmdOrders.php"><button type = "button" name = "" class = "btn btn-primary" >Submitted Orders</button></a>
							
							<a href="customerCompleteOrders.php"><button type = "button" name = "" class = "btn btn-primary" >Completted Orders</button></a>
							
							<a href="customerSavedOrder.php"><button type = "button" name = "" class = "btn btn-primary" >Saved Orders</button></a>
							<br>
							<br>
							
							<a href="customerReveiw.php"><button type = "button" name = "" class = "btn btn-primary" >Reveiw</button></a>
                            
                             

                           
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>