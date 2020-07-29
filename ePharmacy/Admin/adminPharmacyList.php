<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Pharmacy List</title>
		<link rel = "stylesheet" type = "text/css" href = "style1.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
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
                       <p>Welcome admin, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                        <a href="adminIndex.php?logout='1'" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="adminIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                                                    <!-- Serch Part Code -->
                            <!-- Search Customer -->
                        <p ><?php
                            if(isset($_POST['searchPharmacy'])){
                            $name = $_POST['userName']; 
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
								array_push($errors, "Pharmacy username is required!");
							}

							if(count($errors) == 0){	

                            $sql = "SELECT name, email, phoneNumber, userName, pharmacyName, drugLicenseNumber, NIDNumber, joinDate, sell FROM pharmacy where userName = '$name'";
                            //  
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Name: " . $row["name"]."<br>Email: " . $row["email"]."<br>Phone Number: " . $row["phoneNumber"]."<br>Username: " . $row["userName"]."<br>Pharmacy Name: " . $row["pharmacyName"]."<br>Drug License Number: " . $row["drugLicenseNumber"]."<br>NID Number: " . $row["NIDNumber"]."<br>Join Date: " . $row["joinDate"]. "<br>Sale: " . $row["sell"]. "";

                                }
								
								//reveiw
								$reveiw = "SELECT avg(pharmacyReveiw) FROM orders WHERE pharmacyUserName = '$name' and submit = 4 and not pharmacyReveiw = 0 ";
                            	$result = $conn->query($reveiw);
                            	if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>Reveiw: " . $row["avg(pharmacyReveiw)"];

                                }
                            }	
                            } else {
                                echo "Not found!";
                            }
							}
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        
                    
                        
                        <form method = "post" action = "adminPharmacyList.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Enter Pharmacy Username" value = "<?php echo $userName; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchPharmacy" onclick="">Search</button>
                          
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5>Pharmacy List</h5>
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
                        $sql = "SELECT name, userName, email, phoneNumber, pharmacyName, drugLicenseNumber, NIDNumber, joinDate, sell FROM pharmacy";
                    
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Pharmacy Name</th>
                                    <th>Drug License Number</th>
                                    <th>NID Number</th>
                                    <th>Join Date</th>
                                    <th>Sale</th>
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["name"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["email"]. "</td><td>" . $row["phoneNumber"]. "</td><td>" . $row["pharmacyName"]. "</td><td>" . $row["drugLicenseNumber"]. "</td><td>" . $row["NIDNumber"]. "</td><td>" . $row["joinDate"]. "</td><td>" . $row["sell"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No pharmacy added in database!";
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