<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Deactivation Info</title>
		<link rel = "stylesheet" type = "text/css" href = "style1.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
           width: 100%;
           color: #2E86C1;
           font-family: monospace;
           font-size: 14px;
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
                        <p ><?php
                            if(isset($_POST['search'])){
                            $name = $_POST['userName'];
                            $type = $_POST['type'];       
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
								array_push($errors, "Username is required!");
							}

							if(count($errors) == 0){

                            $sql = "SELECT sl, type, userName, reason, date, adminName from deactiveInfo where type = '$type' and userName = '$name'";
                             
                            $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>SL</th>
                                    <th>Account Type</th>
                                    <th>Username</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                    <th>By</th>
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>". $row["sl"]."</td><td>" . $row["type"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["reason"]. "</td><td>" . $row["date"]. "</td><td>" . $row["adminName"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No deactivation info found in database!";
                        }
							}
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        
                    
                        
                        <form method = "post" action = "deactiveInfo.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <p>Select account Type:</p>
                                 <select name="type" value = "<?php echo $type; ?>">
                                    <option value="admin">Admin</option>
                                    <option value="pharmacy">Pharmacy</option>
                                    <option value="customer">Customer</option>
                                  </select>
                                <br>
                                <br><input type = "text" class = "form-control" name = "userName" placeholder="Enter Username" value = "<?php echo $name; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "search" onclick="">Search</button>
                          
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5>Deactivation Info</h5>
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
                        $sql = "SELECT sl, type, userName, reason, date, adminName from deactiveInfo";
                             
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>SL</th>
                                    <th>Account Type</th>
                                    <th>Username</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                    <th>By</th>
                                    
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>". $row["sl"]."</td><td>" . $row["type"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["reason"]. "</td><td>" . $row["date"]. "</td><td>" . $row["adminName"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No deactivation info found in database!";
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