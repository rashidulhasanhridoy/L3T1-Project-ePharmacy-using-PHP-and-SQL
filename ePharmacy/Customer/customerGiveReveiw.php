<?php include('serverCustomer.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: customerLogin.php');
    
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Reveiw</title>
		<link rel = "stylesheet" type = "text/css" href = "stylePharmacy.css">
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
                       <p>ePharmacy,Welcome pharmacy <strong><?php echo $_SESSION['userName']; ?></strong>
						   <br>
                        <a href="customerLogin.php" style="color: red;">Logout</a></p>
						
                            
                    <?php endif ?>
                        <a href="customerReveiw.php"><button type = "button" class = "btn btn-primary" >Back</button></a>
						<br>
						<br>	 
		              </div>
                        
						</div>
					
					
						<?php
						//confrim
						if(isset($_POST['confirm'])){
								$orderNo = $_SESSION['orderNumber'];
								$reveiw = $_POST['reveiw'];
								$db = mysqli_connect('localhost', 'root', '', 'ePharmacy');
								$sql = "UPDATE orders set pharmacyReveiw = '$reveiw' WHERE orderNumber = '$orderNo'";
								mysqli_query($db, $sql);
								header('location: customerReveiw.php');
							}

					?>
                        
                        
                    
                       
                    <div class = "col-md-7 register-right">
                         <!-- Serch Part Code -->
                       
                         <form method = "post" action = "customerGiveReveiw.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          
						<h5>Give Reveiw</h5>
							<p>Order Number: <strong><?php echo $_SESSION['orderNumber']; ?></strong> </p>
							
							<select name = "reveiw">
							  	<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							 
							</select>
							<br>
							<br>

							
							<button type = "submit" class = "btn btn-primary" name  = "confirm">Confrim</button>
					 
                            
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
	</body>
</html>
                    