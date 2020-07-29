<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Products List</title>
		<link rel = "stylesheet" type = "text/css" href = "style1.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            table {
           border-collapse: collapse;
            width: 100%;
           width: 100%;
           color: #2E86C1;
           font-family: monospace;
           font-size: 17px;
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
                        
                        
                        
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        
                         <form method = "post" action = "adminProductList.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                             
                        <!-- Serch Part Code -->
                        <p ><?php
                            if(isset($_POST['searchProduct'])){
                            $name = $_POST['productName'];
                            $userName = $_SESSION['userName'];    
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
								array_push($errors, "Product Name is required!");
							}

                             if(count($errors) == 0){
								$sql = "SELECT products.productName, products.productCompany, products.productQuantity, products.productPrize, products.addDate,
                        pharmacy.pharmacyName, pharmacy.userName, pharmacy.sell 
                        FROM products INNER JOIN pharmacy ON
                        pharmacy.userName = products.userName where products.productName = '$name';";  
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Quantity</th>
                                    <th>Prize</th>
                                    <th>Add Date</th>
                                    <th>Pharmacy Name</th>
                                    <th>Username</th>
                                    <th>Sale</th>
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["productName"]. "</td><td>" . $row["productCompany"]. "</td><td>" . $row["productQuantity"]. "</td><td>" . $row["productPrize"]. "</td><td>" . $row["addDate"]. "</td><td>" . $row["pharmacyName"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["sell"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                                                        
							array_push($errors, "Not found!");
							//echo "No found!";
                        }
							 }
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        <div class = "register-form" >
                             <!-- display errors -->
		                 <?php include('errors.php')?>
                             <!--Search Part -->
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productName" placeholder="Enter Product Name" value = "<?php echo $name; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchProduct" onclick="">Search</button>
                          
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                       
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
                        //$sql = "SELECT sl, productName, productCompany, productQuantity, productPrize, userName FROM products";
                        $sql = "SELECT products.productName, products.productCompany, products.productQuantity, products.productPrize, products.addDate,
                        pharmacy.pharmacyName, pharmacy.userName, pharmacy.sell 
                        FROM products INNER JOIN pharmacy ON
                        pharmacy.userName = products.userName;";  
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Quantity</th>
                                    <th>Prize</th>
                                    <th>Add Date</th>
                                    <th>Pharmacy Name</th>
                                    <th>Username</th>
                                    <th>Sale</th>
                            </tr>";
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["productName"]. "</td><td>" . $row["productCompany"]. "</td><td>" . $row["productQuantity"]. "</td><td>" . $row["productPrize"]. "</td><td>" . $row["addDate"]. "</td><td>" . $row["pharmacyName"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["sell"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No product added in system!";
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