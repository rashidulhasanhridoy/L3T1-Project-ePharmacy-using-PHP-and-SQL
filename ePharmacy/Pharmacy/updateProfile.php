<?php include('serverPharmacy.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: pharmacyLogin.php');
    
}
?>
<?php include('server2Pharmacy.php'); ?>

<?php
    //if the search button is clicked
	if(isset($_POST['seeProfile'])){
        $userName = $_SESSION['userName'];
        $db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
        $sql = "SELECT name, gender, pharmacyName, drugLicenseNumber, NIDNumber, email, phoneNumber from pharmacy where userName = '$userName'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 0)
        {
          while ($row = mysqli_fetch_array($result))
          {
            $name = $row['name'];
            $gender = $row['gender'];
            $pharmacyName = $row['pharmacyName'];
            $drugLicenseNumber = $row['drugLicenseNumber'];
            $NIDNumber = $row['NIDNumber'];
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
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $pharmacyName = $_POST['pharmacyName'];
            $drugLicenseNumber = $_POST['drugLicenseNumber'];
            $NIDNumber = $_POST['NIDNumber'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
        
		//ensure that the form fields are filled properly
        if(empty($name)){
			array_push($errors, "Name is required!");
		}
        if(empty($gender)){
			array_push($errors, "Gender is required!");
		}
        if(empty($pharmacyName)){
			array_push($errors, "Pharmacy name is required!");
		}
        if(empty($drugLicenseNumber)){
			array_push($errors, "Drug License Number is required!");
		}
		if(empty($email)){
			array_push($errors, "Email is required!");
		}
        
        if(empty($phoneNumber)){
			array_push($errors, "Phone Number is required!");
		}
		
		if(count($errors) == 0){
			$sql = "UPDATE pharmacy set name = '$name', gender = '$gender', pharmacyName = '$pharmacyName', drugLicenseNumber = '$drugLicenseNumber', NIDNumber = '$NIDNumber', email = '$email', phoneNumber = '$phoneNumber' WHERE userName = '$userName'";
			mysqli_query($db, $sql);
            echo "updated!";
            header('location: pharmacyIndex.php');
		}
        
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Update Profile</title>
		<link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
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
                       <p>Welcome pharmacy, <strong><?php echo $_SESSION['userName']; ?></strong></p>    
                        <a href="pharmacyIndex.php?logout='1'" style="color: red;">Logout</a>
                             <br>
                    <?php endif ?>
		              </div>
                        <br>
                        <a href="pharmacyIndex.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5><br>Update Profile</h5>
                        <form method = "post" action = "updateProfile.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name" placeholder="Name" value = "<?php echo $name; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "gender" placeholder="Gender" value = "<?php echo $gender; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "pharmacyName" placeholder="Pharmacy Name" value = "<?php echo $pharmacyName; ?>">
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "drugLicenseNumber" placeholder="Drug License Number" value = "<?php echo $drugLicenseNumber; ?>">
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "NIDNumber" placeholder="NID Number" value = "<?php echo $NIDNumber; ?>" readonly>
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Username" value = "<?php echo $userName; ?>" readonly>
                            </div>
                            <div class = "form-group">
                                <input type = "email" class = "form-control" name = "email" placeholder="Email" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="Phone Number" value = "<?php echo $phoneNumber; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "seeProfile" onclick="">See Profile</button>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "updateProfile" onclick="">Update Profile</button>
                            
                            
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
                alert("Profile updated successfully!");
        }
        </script>
	</body>
</html>