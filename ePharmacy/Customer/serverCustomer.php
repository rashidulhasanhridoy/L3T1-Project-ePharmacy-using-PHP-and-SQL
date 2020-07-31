<?php
	session_start();
    $name = "";
    $gender = "";
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
        $user_check_query = "SELECT * FROM users WHERE username='$userName' OR email='$email' LIMIT 1";
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
			$password = md5($password1);//encrypt password
			$sql = "INSERT INTO users(joinDate, userName, name, gender, email, phoneNumber, password, buy) VALUES('$joinDate', '$userName', '$name', '$gender', '$email', '$phoneNumber', '$password', 'on')";
			mysqli_query($db, $sql);
             $_SESSION['userName'] = $userName;
			 $_SESSION['success'] = "Account successfully created.You are now logged in!";
			header('location: customerIndex.php'); // redirect to homepage
		
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
            $query = "SELECT * FROM users WHERE userName = '$userName' AND password = '$password'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                //log user
                $_SESSION['userName'] = $userName;
				$_SESSION['success'] = "You are now logged in!";
			    header('location: customerIndex.php'); // redirect to homepage
                
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
		header('location: customerLogin.php'); 
	}	




?>