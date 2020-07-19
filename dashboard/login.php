<?php
if(isset($_SESSION['id'])){
	header("Location:index.php");
}
require "db/DB.php";

//Login function ***Uses a login function in db/DB.php***
if(isset($_POST["login"])){
    $email  = $_POST["email"];
	$password = $_POST["password"];
	$date = new DateTime('now', new DateTimeZone('Africa/Harare'));
 	$date = $date->format('Y-m-d H:i:s');
    if(!empty($email) && !empty($password)){        
       $login = login($email,$password);
      
       if($login["status"]=="ok"){
            $updateLogin = updateLogin($email,$date);
            $a=checkAccount($_SESSION['id']);
            if($a=='yes'){
                header("location:index.php"); 
            }else if($a=='no'){
                createAccount($_SESSION['id']);
                header("location:index.php"); 
            }
			
       }
       else{
			$error = "Email or password incorrect.";
       }
    }
    else{
        $error = "Email or Password can not be empty";
    }
}
?>
