<?php include('serverAdmin.php')?>
<!DOCTYPE html>
<html>
<head>
    <title>ePharmacy | Admin Login</title>
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
                       <p>Join with us & make your life easy.<br>Don't have a account?</p>
                       <a href="adminRegistration.php"><button type = "button" class = "btn btn-primary" >Sign Up</button></a>
                        <br>
                        <button type = "button" class = "btn btn-primary" >Home</button>
                        
                        
                    </div>
                    <div class = "col-md-7 register-right">
                        <h2>Login Now!</h2>
                        <form method = "post" action = "adminLogin.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "userName" placeholder="Username" value = "<?php echo $userName; ?>">
                            </div>
                            
                            <div class = "form-group">
                                <input type = "password" class = "form-control" name = "password"
                                       placeholder="Password">
                            </div>
                            <button type = "submit" class = "btn btn-primary" name  = "login">Login</button>
                            
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>