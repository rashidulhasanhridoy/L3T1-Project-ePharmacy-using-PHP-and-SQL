<?php
	session_start();
    $name = "";
    $gender = "";
    $pharmacyName = "";
    $drugLicenseNumber = "";
    $NIDNumber = "";
    $userName = "";
    $email = "";
    $phoneNumber = "";
    $errors = array();
    
    //connect to database
	$db = mysqli_connect('localhost', 'root', '', 'ePharmacy');

    
    
    //if the sing up button is clicked
	if(isset($_POST['signUp'])){
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $pharmacyName = mysqli_real_escape_string($db, $_POST['pharmacyName']);
        $drugLicenseNumber = mysqli_real_escape_string($db, $_POST['drugLicenseNumber']);
        $NIDNumber = mysqli_real_escape_string($db, $_POST['NIDNumber']);
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
		$password1 = mysqli_real_escape_string($db, $_POST['password1']);
		$password2 = mysqli_real_escape_string($db, $_POST['password2']);
		
		
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
        if(empty($NIDNumber)){
			array_push($errors, "NID Number is required!");
		}
		if(empty($userName)){
			array_push($errors, "Username is required!");
		}
		
		if(empty($email)){
			array_push($errors, "Email is required!");
		}
        
        if(empty($phoneNumber)){
			array_push($errors, "Phone Number is required!");
		}
		
		if(empty($password1)){
			array_push($errors, "Password is required!");
		}

		if($password1 != $password2){
			array_push($errors, "The password do not match!");
		}
        
        
        //username and email check
        $user_check_query = "SELECT * FROM pharmacy WHERE username='$userName' OR email='$email' LIMIT 1";
          $result = mysqli_query($db, $user_check_query);
          $user = mysqli_fetch_assoc($result);
  
          if ($user) { // if user exists
            if ($user['userName'] === $userName) {
              array_push($errors, "Username already exists");
            }

            if ($user['email'] === $email) {
              array_push($errors, "Email already exists");
            }
          }

		//if there are no error, save user to database
		
		if(count($errors) == 0){
            $joinDate = date('m/d/Y', time());
            $request = 0;
			$password = md5($password1);//encrypt password
			$sql = "INSERT INTO pharmacy(name, gender, pharmacyName, drugLicenseNumber, NIDNumber, userName, email, phoneNumber, password, joinDate, request, sell) VALUES('$name', '$gender', '$pharmacyName', '$drugLicenseNumber', '$NIDNumber', '$userName', '$email', '$phoneNumber', '$password', '$joinDate', '$request', 'on')";
			mysqli_query($db, $sql);
            $_SESSION['userName'] = $userName;
            $_SESSION['success'] = "Kindly check your mail & follow the procedure. If you complete all steps, then wait for 72 hours. We will complete your pharmacy registration.";
			header('location: pharmacyRegistrationAfrerPage.php'); // redirect to homepage
		
		}	
	}

    //log user in from login page

    if(isset($_POST['login'])){
        
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		
		//ensure that the form fields are filled properly
		if(empty($userName)){
			array_push($errors, "Username is required!");
		}
		
		if(empty($password)){
			array_push($errors, "Password is required!");
		}
        
        if(count($errors) == 0){
            $password = md5($password);
            $query2 = "SELECT * FROM pharmacy WHERE userName = '$userName' AND password = '$password' AND request = 0";
            $result = mysqli_query($db, $query2);
            if(mysqli_num_rows($result) == 1){
                array_push($errors, "Account deactivated! Contact any other admin to active your account."); 
                header('location: pharmacyAccountDeactivePage.php');
            }
            
            $query = "SELECT * FROM pharmacy WHERE userName = '$userName' AND password = '$password' AND request = 1";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                //log user
                $_SESSION['userName'] = $userName;
				$_SESSION['success'] = "You are now logged in!";
			    header('location: pharmacyIndex.php'); // redirect to homepage
                
            }
            
            else{
                array_push($errors, "Wrong username or password!");  
            }
        }
    }
	
	//logout
	
	if (isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['userName']);
		header('location: pharmacyLogin.php'); 
	}	




?>