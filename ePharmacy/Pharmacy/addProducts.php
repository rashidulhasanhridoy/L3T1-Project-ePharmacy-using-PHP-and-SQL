<?php include('serverPharmacy.php'); 
//if user can not log in user can not access
if(empty($_SESSION['userName'])){
    header('location: pharmacyLogin.php');
    
}
?>
<?php include('server2Pharmacy.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>ePharmacy | Add Products</title>
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
                        <h4><br><br>Add Products</h4>
                        <form method = "post" action = "addProducts.php">
                        <!-- display errors -->
		                 <?php include('errors.php')?>
                        <div class = "register-form" >
                          <div class = "form-group">
                                <br><input type = "hidden" class = "form-control" name = "userName1" placeholder="User Name" value = "<?php echo $_SESSION['userName']; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productName" placeholder="Product Name" value = "<?php echo $productName; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productCompany" placeholder="Product Company" value = "<?php echo $productCompany; ?>">
                            </div>
                           <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productQuantity" placeholder="Quantity" value = "<?php echo $productQuantity; ?>">
                            </div>
                            <div class = "form-group">
                                <input type = "text" class = "form-control" name = "productPrize" placeholder="Prize" value = "<?php echo $productPrize; ?>">
                            </div>
                            
                            <button type = "submit" class = "btn btn-primary" name  = "addProducts" onclick="">Add Products</button>
                            
                            
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