<?php include('serverAdmin.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: adminLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
	<title>ePharmacy | Welcome</title>
    <link rel = "stylesheet" type = "text/css" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	</head>
		
	<body>
		
		<div class = "container">
        <div class = "row">
            <div class = "col-md-10 offset = md - 1">
                <div class = "row">
                    <div class = "col-md-5 register-left">
						
                       <h3 style="color: blue;"><br><br><br>ePharmacy Bangladesh</h3>
                        <script>
                            document.write(Date());
                        </script>
                            <h3 style="color: red;">Kindly check your mail & follow the procedure. If you complete all steps, then wait for 72 hours. We will complete your registration.</h3>

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


						<!-- logout -->
						<?php  if (isset($_SESSION['userName'])) : ?>
						   <p>Welcome <strong><?php echo $_SESSION['userName']; ?></strong></p>
						   <p> <a href="adminLogin.php" style="color: red;">Logout</a> </p>
						<?php endif ?>
                   
                    </div> 
                </div>
            </div>
        </div>
    </div>
		
		
	</body>
</html>