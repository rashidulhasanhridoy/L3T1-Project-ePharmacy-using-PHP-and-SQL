<?php include('serverAdmin.php')?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Admin Sign Up</title>
    <link rel = "stylesheet" type = "text/css" href = "styleAdmin.css">
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
                       <h3>ePharmacy Bangladesh</h3>
                       <p>Join with us & make your life easy.<br>Already have a account?</p>
                       <a href = "adminLogin.php"><button type = "button" class = "btn btn-primary" >Login</button></a>
                        <br>
                        <button type = "button" class = "btn btn-primary" >Home</button>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h2>Sign Up Now!</h2>
                        <form method = "post" action = "adminRegistration.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "name" placeholder="Name" value = "<?php echo $name; ?>">
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
                            
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>