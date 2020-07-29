<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Approve Admin</title>
		<link rel = "stylesheet" type = "text/css" href = "style1.css">
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
                       <p>Welcome admin, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                        <a href="adminLogin.php" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="adminIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                                                    <!-- Serch Part Code -->
                            <!-- Search Customer -->
                        <p ><?php
                            if(isset($_POST['approveAdmin'])){
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
								array_push($errors, "Admin username is required!");
							}
							
							if(count($errors) == 0){
								
                            $sql = "Update admin set request = 1 where userName = '$name'";
                            $result = $conn->query($sql);

							}
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        
                    
                        
                        <form method = "post" action = "adminApproveAdmin.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Enter Admin Username" value = "<?php echo $userName; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "approveAdmin" onclick="">Approve</button>
                          
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5>Amdin Approve Request List</h5>
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
                        $sql = "SELECT name, userName, email, phoneNumber, joinDate FROM admin where request = 0";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Join Date</th>
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["name"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["email"]. "</td><td>" . $row["phoneNumber"]. "</td><td>" . $row["joinDate"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No admin approve request!";
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