<?php include('serverPharmacy.php')?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Pharmacy Registration</title>
    <link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3><br><br><br><br><br><br><br>ePharmacy Bangladesh</h3>
                        <p>Join with us and make your life easy.</p>
                        <a href=""><button type = "button" class = "btn btn-primary" >Home</button></a>
                        <p><br>Already have a account? <a href = "pharmacyLogin.php">Login</a></p>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h5><br>Sign Up Now!</h5>
                        <form method = "post" action = "pharmacyRegistration.php">
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
                                <input type = "text" class = "form-control" name = "NIDNumber" placeholder="NID Number" value = "<?php echo $NIDNumber; ?>">
                            </div>
                            
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Username" value = "<?php echo $userName; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "email" class = "form-control" name = "email" placeholder="Email" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "phoneNumber" placeholder="Phone Number" value = "<?php echo $phoneNumber; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "password" class = "form-control" name = "password1"
                                       placeholder="Password">
                            </div>
                            <div class = "form-group">
                                <input type = "password" class = "form-control" name = "password2"
                                       placeholder="Confirm Password">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "signUp">Sign Up</button>
                            
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
</body>
</html>