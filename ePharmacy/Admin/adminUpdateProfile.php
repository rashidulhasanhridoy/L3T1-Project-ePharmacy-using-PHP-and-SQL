<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>

<?php
    //if the search button is clicked
	if(isset($_POST['seeProfile'])){
        $userName = $_SESSION['userName'];
        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
        $sql = "SELECT name, email, phoneNumber from admin where userName = '$userName'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['name'];
            $email = $row['email'];
            $phoneNumber = $row['phoneNumber'];
          }  
        }
        
        else {
           echo "not found!";
        }
        
        mysqli_free_result($result);
        mysqli_close($db);
        
	}

    else{
        //
    }

?>

<?php
    //update profile
	if(isset($_POST['updateProfile'])){
            $userName = $_SESSION['userName'];
            $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
            $email = $_POST['email'];
            $name = $_POST['name1'];
            $phoneNumber = $_POST['phoneNumber'];
        
		//ensure that the form fields are filled properly
        if(empty($name)){
			array_push($errors, "Name is required!");
		}
        if(empty($email)){
			array_push($errors, "Email is required!");
		}
        if(empty($phoneNumber)){
			array_push($errors, "Phone Number is required!");
		}
		
		if(count($errors) == 0){
			$sql = "UPDATE admin set name = '$name', email = '$email', phoneNumber = '$phoneNumber' WHERE userName = '$userName'";
			mysqli_query($db, $sql);
            echo "updated!";
            header('location: adminIndex.php');
		}
        
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Update Profile</title>
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
                        <form method = "post" action = "adminUpdateProfile.php">
                             <h5>Update Profile</h5>
							<!-- display errors -->
		                 <?php include('errors.php')?>
                           
                        <div class = "register-form" >
                            
                             <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name1" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "email" class = "form-control" name = "email" placeholder="Email" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="Phone Number" value = "<?php echo $phoneNumber; ?>">
                            </div>
                            
                             <button type = "submit" class = "btn btn-primary" name  = "seeProfile">See Profile</button>
                            
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