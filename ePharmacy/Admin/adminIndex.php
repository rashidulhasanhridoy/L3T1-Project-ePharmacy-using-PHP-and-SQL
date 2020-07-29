<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
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
                       <h3><br><br><br>ePharmacy Bangladesh</h3>
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
                       <p>Welcome admin, <strong><?php echo $_SESSION['userName']; ?></strong></p>
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

                            $sql = "SELECT name, email, phoneNumber, joinDate FROM admin where userName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["name"]."<br>Email: " . $row["email"]."<br>Phone Number: " . $row["phoneNumber"]."<br>Join Date: " . $row["joinDate"]. "<br>";

                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?></p>



                            <!-- logout -->
                        <a href="adminLogin.php" style="color: red;">Logout</a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <button href="#" type = "button" class = "btn btn-primary" >Home</button>
                        <br>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                       <br><br><br>
                        <form method = "post" action = "adminIndex.php">
                        <div class = "register-form" >
                            <a href="adminUpdateProfile.php"><button type = "button" class = "btn btn-primary" >Update Profile</button></a>
                            <a href="adminChangePassword.php"><button type = "button" class = "btn btn-primary" >Change Password</button></a>
                            <a href="adminUpdateCustomerProfile.php"><button type = "button" class = "btn btn-primary" >Update Customer Profile</button></a>
							<br><br>
                            <a href="adminUpdatePharmacyProfile.php"><button type = "button" class = "btn btn-primary" >Update Pharmacy Profile</button></a>
							 <a href="adminChangeCustomerPassword.php"><button type = "button" class = "btn btn-primary" >Change Customer Password</button></a>
							<br><br>
                            <a href="adminChangePharmacyPassword.php"><button type = "button" class = "btn btn-primary" >Change Pharmacy Password</button></a>
							 <a href="adminCustomerList.php"><button type = "button" class = "btn btn-primary" >Customer List</button></a>
                            <a href="adminPharmacyList.php"><button type = "button" class = "btn btn-primary" >Pharmacy List</button></a>
							<br><br>
							<a href="adminProductList.php"><button type = "button" class = "btn btn-primary" >Product List</button></a>
							<a href="ordersList.php"><button type = "button" class = "btn btn-primary" >Orders List</button></a>
							<br><br>
							<a href="adminDeactiveCustomerReveiw.php"><button type = "button" class = "btn btn-primary" >Reveiw Based Customer Deactivation</button></a>
							<a href="adminApproveCustomer.php"><button type = "button" class = "btn btn-primary" >Active a Customer</button></a>
							<br><br>
                            <a href="adminDeactivePharmacyReveiw.php"><button type = "button" class = "btn btn-primary" >Review Based Pharmacy Deactivation</button></a>
							 <a href="adminActivePharmacy.php"><button type = "button" class = "btn btn-primary" >Active a Pharmacy</button></a>
							<br><br>
							<a href="adminApproveAdmin.php"><button type = "button" class = "btn btn-primary" >Approve a Admin</button></a>
                            <a href="adminDeactiveAdmin.php"><button type = "button" class = "btn btn-primary" >Deactive a Admin</button></a>
                            <br><br>
							<a href="adminApprovePharmacy.php"><button type = "button" class = "btn btn-primary" >Approve a Pharmacy</button></a>
                            <a href="adminDeactivePharmacy.php"><button type = "button" class = "btn btn-primary" >Deactive a Pharmacy</button></a>
							<br><br>
							<a href="deactiveInfo.php"><button type = "button" class = "btn btn-primary" >Deactive Info</button></a>
                           
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>