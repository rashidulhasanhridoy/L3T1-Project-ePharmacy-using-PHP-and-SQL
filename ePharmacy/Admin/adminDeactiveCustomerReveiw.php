<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Deactive Customer Based on Reveiw</title>
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		<link rel = "stylesheet" type = "text/css" href = "style1.css">
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
                            if(isset($_POST['searchCustomer'])){
                            $name = $_POST['userName'];
                            $by = $_SESSION['userName'];
                            $date = date("M,d,Y h:i:s A");
                            $reason = $_POST['reason'];    
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
								array_push($errors, "Customer username is required!");
							}
							if(empty($reason)){
								array_push($errors, "Reason is required!");
							}	

							if(count($errors) == 0){	

                            $sql = "Update users set buy = 'off' where userName = '$name'";
                            $result = $conn->query($sql);
                            $sql2 = "insert into deactiveinfo (type, userName, reason, date, adminName) values('customer', '$name', '$reason', '$date', '$by')";    
                            $result = $conn->query($sql2);     
							}
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        
                    
                        
                        <form method = "post" action = "adminDeactiveCustomerReveiw.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Enter Customer Username" value = "<?php echo $userName; ?>">
                            </div>
                            
                            <div class = "form-group">
                               <input type = "text" class = "form-control" name = "reason" placeholder="Enter Reason Here">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchCustomer" onclick="">Deactive</button>
                          
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5>Customer List</h5>
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
                        $sql = "Select customerName, customerUserName, customerPhoneNumber, avg(customerReveiw) FROM orders GROUP by customerName";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
									<th>Phone Number</th>
                                    <th>Reveiw</th>
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>". $row["customerUserName"]."</td><td>" . $row["customerName"]. "</td><td>" . $row["customerPhoneNumber"]. "</td><td>" . $row["avg(customerReveiw)"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No customer find in database!";
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