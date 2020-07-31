<?php include('serverCustomer.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: customerLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Select Pharmacy</title>
		<link rel = "stylesheet" type = "text/css" href = "">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
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
                       <p>Welcome user, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                        <a href="customerLogin.php" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="customerIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
						
						
                        
                        
                        </div>
                    
                       
                    <div class = "col-md-7 register-right">
                         <!-- Serch Part Code -->
                       
                         <form method = "post" action = "customerSelectPharmacy.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                            <!--Get Pharmacy Name-->
                        <?php
							$name = $_SESSION['userName'];
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ePharmacy";
                            //$tableName = "pharmacy";
                            $columnName = "pharmacyName";
                            $conn = new mysqli($servername, $username, $password, $dbname);
							
							 $user_check_query = "SELECT * FROM users WHERE userName = '$name' LIMIT 1";
							  $result = mysqli_query($conn, $user_check_query);
							  $user = mysqli_fetch_assoc($result);

							  if ($user) { // if user exists
								if ($user['buy'] == "off") {
								  array_push($errors, "You can't buy now! For bad reveiw, your opder option is blocked. Contact with admin to active it.");
								}

							  }
        
							 
							 
							 if(count($errors) == 0){
                            $query = "Select distinct pharmacy.pharmacyName From pharmacy INNER JOIN products ON pharmacy.userName = products.userName where pharmacy.sell = 'on'";
							 
						
                            $result = mysqli_query($conn, $query);
							 }
                        ?>
                        
                            
                             <!--Search Part -->
                            	<br>
							<h6>Select a Pharmacy</h6>
                            
                            <div class = "form-group">
                                <select name = "pName" value = "<?php echo $pName; ?>">
                                    <?php
                                        if($result)
                                        {
                                            while($row = mysqli_fetch_array($result))
                                            { 
                                                $pharmacyName = $row["$columnName"];
                                                echo"<option>$pharmacyName<br></option>";
                                            }
                                        }
                                    ?>
									<option value = "">0</option>
                                </select>
                            </div>
                            
                            
                            <?php
                    //if the select pharmacy button is clicked
                        $pharmacyName1 = '';
                        $pharmacyUsername1 = '';
                    if(isset($_POST['selectPharmacy'])){
                        $pName = $_POST['pName'];
						$uName = $_SESSION['userName'];
                        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
                        $sql = "SELECT userName, pharmacyName, phoneNumber from pharmacy where pharmacyName = '$pName'";
                        $result = mysqli_query($db, $sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                          while ($row = mysqli_fetch_array($result))
                          {
                            $pharmacyUsername1 = $row['userName'];
							$pharmacyName1 = $row['pharmacyName'];
							$phoneNumber = $row['phoneNumber']; 
                          }  
                        }

                        else {
                           echo "not found!";
                        }
						
						

                        mysqli_free_result($result);
                        mysqli_close($db);
						
						$_SESSION['pharmacyUserName'] = $pharmacyUsername1;
						$_SESSION['pharmacyName'] = $pharmacyName1;
						$timestamp = time();
						$date = date("M,d,Y H:i:s A");
						$_SESSION['date'] = $date;
						$name = $_SESSION['userName'];
						$_SESSION['orderNumber'] = $name.$timestamp;
						$_SESSION['phoneNumber'] = 	$phoneNumber;
						header('location: customerMakeOrder.php'); 

                    }
                ?>
							 <button type = "submit" class = "btn btn-primary" name  = "selectPharmacy" onclick="">Continue</button>
							
                            <br>
                            <br>
                            <br>
							
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
                        $sql = "Select distinct pharmacy.pharmacyName, pharmacy.userName, pharmacy.phoneNumber From pharmacy INNER JOIN products ON pharmacy.userName = products.userName where pharmacy.sell = 'on'";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Phone Number</th>
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["pharmacyName"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["phoneNumber"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No pharmacy added in system!";
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
                    