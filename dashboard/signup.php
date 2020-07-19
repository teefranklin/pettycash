<?php
require "db/DB.php";
if(isset($_POST["signup"])){
	
	//post variables
	$phone = $_POST["phone"];
	$sponsor_id = $_POST["sponsor_id"];
	$gender  = $_POST["gender"];
	$country  = $_POST["country"];
	$email  = $_POST["email"];
	$password = $_POST["password"];
	$password2 = $_POST["cpassword"];
	$first_name = $_POST["firstname"];
	$last_name = $_POST["lastname"];
	$username = $first_name.'-'.$last_name;

	//variables to validate the password
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);
	
	//Check the strength of the password
	if( !$lowercase || !$number || strlen($password) < 8) {
		header("location:../signup.php?msg=Password should be at least 8 characters in length and should include at least one number&alert=danger");
	}else{
		//Strong password.';
		$user_exist = user_exist($username);
		if(user_exist($username)=="ok"){
			header("location:../signup.php?msg=The Username is taken&alert=danger");
		}
		else if(email_exist($email)=="ok"){
			header("location:../signup.php?msg=The Email is taken&alert=danger");	
		}
		else{
			if($password == $password2){ //password confirmation
			$create_user = create_user($email,$password,$first_name,$last_name,$username,$gender,$country,$phone,$sponsor_id);
      
			   if($create_user =="ok"){
				   header("location:../index.php#popup3");
			   }
			   else{
					die("".$create_user);
			   }
			} 
			else{
				header("location:../signup.php?msg=Passwords do not match&alert=danger");
			}
		}
	}
}

?> 
