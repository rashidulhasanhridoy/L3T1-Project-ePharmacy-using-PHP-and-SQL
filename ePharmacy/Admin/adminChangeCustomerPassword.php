<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>


<!-- Change Password -->
<?php
     $newPassword = "";
     $confirmPassword = "";
     $errors = array();
     $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
	if(isset($_POST['changePassword'])){
        $name = mysqli_real_escape_string($db, $_POST['Name']);
        $newPassword = mysqli_real_escape_string($db, $_POST['newPassword']);
        $confirmPassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);
        
        //ensure that the form fields are filled properly
        if(empty($newPassword)){
			array_push($errors, "New password is required!");
		}
        if(empty($confirmPassword)){
			array_push($errors, "Comfirm password is required!");
		}
        if($newPassword != $confirmPassword){
			array_push($errors, "Password do not match!");
		}
        
        
        
         if(count($errors) == 0){
			$password = md5($newPassword);//encrypt password
			$sql = "UPDATE users set password = '$password' where userName = '$name'";
			mysqli_query($db, $sql);
			header('location: adminIndex.php'); // redirect to homepage
		
		}	
      
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Change Customer Password</title>
        <link rel = "stylesheet" type = "text/css" href = "style1.css">
        <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	</head>
    
		
	<body>
        <br>
         <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br><br><br>ePharmacy Bangladesh</h3>
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
                       <p>Welcome <strong><?php echo $_SESSION['userName']; ?></strong></p>
                        <a href="adminIndex.php" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        
                                             <!-- Search Customer -->
                        <p ><?php
                            if(isset($_POST['searchCustomer'])){
                            $name = $_POST['Name']; 
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

								if(count($errors) == 0){

                            $sql = "SELECT userId, userName, name, gender, email, phoneNumber FROM users where userName = '$name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<br>User ID: " . $row["userId"]."<br>Username: " . $row["userName"]."<br>Name: " . $row["name"]."<br>Gender: " . $row["gender"]."<br>Email: " . $row["email"]."<br>Phone Number: " . $row["phoneNumber"]."<br>";

                                }
                            } else {
                                echo "Not found!";
                            }
								}
                            $conn->close();
                            }
                            ?></p>
                            
                            <!-- end -->
                        
                        <a href="adminIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5><br><br>Change Customer Password</h5>
                        <form method = "post" action = "adminChangeCustomerPassword.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "Name" placeholder="Enter Customer Username" value = "<?php echo $name; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "searchCustomer" onclick="">Search</button>
                            <br>
                            <br>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "newPassword" placeholder="Enter new password" value = "<?php echo $newPassword; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "confirmPassword" placeholder="Confirm new password" value = "<?php echo $confirmPassword; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "changePassword" onclick="">Change Password</button>
                            
                            
                            <br>
                            <br>
                            <br>
                            <br>
                            
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
        <script>
            function alartFunction() {
                alert("");
        }
        </script>
	</body>
</html>