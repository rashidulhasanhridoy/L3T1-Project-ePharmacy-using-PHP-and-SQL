<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>



<?php
    //update profile
	if(isset($_POST['updateProfile'])){
            $userName = $_POST['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
            $name = $_POST['name1'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
        
		//ensure that the form fields are filled properly
        if(empty($name)){
			array_push($errors, "Name is required!");
		}
        if(empty($gender)){
			array_push($errors, "Gender is required!");
		}
        if(empty($phoneNumber)){
			array_push($errors, "Phone Number is required!");
		}
        
		if(empty($email)){
			array_push($errors, "Email is required!");
		}
        
		if(count($errors) == 0){
			$sql = "UPDATE users set name = '$name', gender = '$gender',  email = '$email', phoneNumber = '$phoneNumber' WHERE userName = '$userName'";
			mysqli_query($db, $sql);
            echo "updated!";
            header('location: adminIndex.php');
		}
        
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Update Customer Profile</title>
    <link rel = "stylesheet" type = "text/css" href = "style1.css">
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
                       <p>Welcome admin, <strong><?php echo $_SESSION['userName']; ?></strong></p>
                         <!-- main part------------------------------------------------ -->
                       

                            <!-- logout -->
                            <a href="adminIndex.php?logout='1'" style="color: red;">Logout</a>
                    <?php endif ?>
		</div>
                        <br>
                        
                        <a href="adminIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <br><br><br>
                        <form method = "post" action = "adminUpdateCustomerProfile.php">
                            <!-- display errors -->
		                 <?php include('errors.php')?>
                            <h5>Update Customer Profile</h5>
                                                    <?php
                            //if the search button is clicked
                            if(isset($_POST['seeProfile'])){
                                $userName = $_POST['userName'];
								if(empty($userName)){
									array_push($errors, "Customer username is required!");
								}

								
                                $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
                                $sql = "SELECT name, gender, email, phoneNumber from users where userName = '$userName'";
                                $result = mysqli_query($db, $sql);
                                if(mysqli_num_rows($result) > 0)
                                {
                                  while ($row = mysqli_fetch_array($result))
                                  {
                                    $name = $row['name'];
                                    $gender = $row['gender'];
                                    $email = $row['email'];
                                    $phoneNumber = $row['phoneNumber'];
                                  }  
                                }

                                else {
                                   echo "Not found!";
                                }
								
								

                                mysqli_free_result($result);
                                mysqli_close($db);
								
                            }

                            else{
                                //
                            }

                        ?>
                        <div class = "register-form" >
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Enter Customer Username" value = "<?php echo $userName; ?>">
                            </div>
                            <button type = "submit" class = "btn btn-primary" name  = "seeProfile">See Profile</button>
                            
                          
                            <br>
                            <br>
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "gender" placeholder="Gender" value = "<?php echo $gender; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "email" class = "form-control" name = "email" placeholder="Email" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="Phone Number" value = "<?php echo $phoneNumber; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "updateProfile" onclick="">Update</button>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>