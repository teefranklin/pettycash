<?php
include "includes/header.php"; 
$image = '<img class="avatar img-circle img-thumbnail my_avatar" src="images/'.$_SESSION['profile_picture'].'" alt=""></img>'; 
$avatar = '<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">';
//update profile
if(isset($_POST['change_first_name'])) {
	$email  = $_SESSION["email"];    
	$first_name = $_POST["new"];
	$first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
	$db_field = "first_name";
	$updateProfile=updateProfile($db_field,$first_name,$email);		
	if($updateProfile["status"]=="ok"){
		$reso = "Your Fist Name was updated";
		$storeSessions = storeSessions($email);
	}
	else{
		$reso = $updateProfile["status"];
	}
}
elseif(isset($_POST['change_last_name'])) {
	$email  = $_SESSION["email"];    
	$last_name = $_POST["new"];
	$last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
	$db_field = "last_name";
	$updateProfile=updateProfile($db_field,$last_name,$email);		
	if($updateProfile["status"]=="ok"){
		$reso = "Your Last Name was updated";
		$storeSessions = storeSessions($email);
	}
	else{
		$reso = $updateProfile["status"];
	}
}
elseif(isset($_POST['change_username'])) {
	$email  = $_SESSION["email"];    
	$username = $_POST["new"];
	$username = filter_var($username, FILTER_SANITIZE_STRING);
	$username= preg_replace('/\s+/', '_', $username);
	$db_field = "username";
	$updateProfile=updateProfile($db_field,$username,$email);		
	if($updateProfile["status"]=="ok"){
		$reso = "Your Username was updated";
		$storeSessions = storeSessions($email);
	}
	else{
		$reso = $updateProfile["status"];
	}
}
elseif(isset($_POST['change_email'])) {
	$email  = $_SESSION["email"];    
	$new_email = $_POST["new"];
	$db_field = "email";
	$updateProfile=updateProfile($db_field,$new_email,$email);		
	if($updateProfile["status"]=="ok"){
		$reso = "Your Email was updated";
		$storeSessions = storeSessions($new_email);
	}
	else{
		$reso = $updateProfile["status"];
	}
}
elseif(isset($_POST['change_password'])) {	
	$email  = $_SESSION["email"];    
	$password1 = $_POST["new1"];
	$password2 = $_POST["new2"];
	$db_field = "password";
	$uppercase = preg_match('@[A-Z]@', $password2);
	$lowercase = preg_match('@[a-z]@', $password2);
	$number    = preg_match('@[0-9]@', $password2);
	$specialChars = preg_match('@[^\w]@', $password2);
	$hash = hash('sha256',$password2); 
	//Check the strength of the password
	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password2) < 8) {
		$reso = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
	}
	elseif($password1 != $password2){
		$reso = "Confirmation password does not match";
	}
	elseif($_SESSION["password"] == $hash){
		$reso = "Failed to update your Password, Password is the same as the old one";
	}
	else{ 
		$password = hash('sha256',$password2); 
		$updateProfile=updateProfile($db_field,$password,$email);		
		if($updateProfile["status"]=="ok"){
			$reso = "Your Password was updated";
			$storeSessions = storeSessions($email);
		}
		else{
			$reso = $updateProfile["status"];
		}
	}
}
elseif(isset($_FILES['image'])){
	$email  = $_SESSION["email"];
	$db_field = "profile_picture";
	$errors= array();
	$file_name = $_SESSION['id']."_".$_FILES['image']['name'];
	$file_size =$_FILES['image']['size'];
	$file_tmp =$_FILES['image']['tmp_name'];
	$file_type=$_FILES['image']['type'];
	$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	
	$extensions= array("jpeg","jpg","png");
	
	if(in_array($file_ext,$extensions)=== false){
	   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	}
	
	if($file_size > 2097152){
	   $errors[]='File size must be excately 2 MB';
	}
	
	if(empty($errors)==true){
	   move_uploaded_file($file_tmp,"images/".$file_name);
	   $updateProfile=updateProfile($db_field,$file_name,$email);
	   if($updateProfile["status"]=="ok"){
		$reso = "Image updated Successifuly";
		$storeSessions = storeSessions($email);
	}
	else{
		$reso = $updateProfile["status"];
	}
}	   
	else{
	   print_r($errors);
	}
 }
?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
	<div class="row">
	<br>
		  <br>
  		<div class="col-sm-3"><!--left col-->
				  
	<div class="r3_counter_box">
	<form class="form" action="profile.php" method="POST" id="change_picture" enctype="multipart/form-data">
      <div class="text-center">
		<?php 
			if(isset($_SESSION["profile_picture"])){
				echo $image;
			}
			else{
				echo $avatar;
			}

		?>
		<br>
        <h6>Upload a different photo...</h6>
        <input type="file" name="image" class="text-center center-block file-upload">
		<br>
		<button class="btn btn-lg btn-warning"  type="submit"><i></i> Change picture</button>
      </div>
	  </form>
	  </div><br>
        </div><!--/col-3-->
		<br>
    	<div class="col-sm-9">		
			<div class="tab-content">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["first_name"];
									}
									else{
										echo "first_name";
									}?> 
								 data-toggle="modal" data-target="#firstname" data-whatever="@mdo">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control"  placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["last_name"];
									}
									else{
										echo "last_name";
									}?>  title="enter your last name if any." data-toggle="modal" data-target="#lastname" data-whatever="@mdo">
                          </div>
                      </div>
          
                      <div class="form-group">                      
                          <div class="col-xs-6">
                              <label for="username"><h4>Username</h4></label>
                              <input type="username" class="form-control"  placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["username"];
									}
									else{
										echo "username";
									}?>   data-toggle="modal" data-target="#username" data-whatever="@mdo">
                          </div>
                      </div>
					  <div class="form-group">                    
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control"  placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["email"];
									}
									else{
										echo "email";
									}?>  title="enter your email." data-toggle="modal" data-target="#email" data-whatever="@mdo">
                          </div>
                      </div>         
                    <div class="form-group">
                          <div class="col-xs-6">
                             <label for="Username"><h4>Date Joined</h4></label>
                              <input type="text" class="form-control" name="date_joined" id="mobile" placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["date_joined"];
									}
									else{
										echo "date_joined";
									}?>  title="date_joined." disabled>
                          </div>
                      </div>
					  <div class="form-group">
                          <div class="col-xs-6">
							 <br>
							 <button class="btn btn-lg " data-toggle="modal" data-target="#password" data-whatever="@mdo">Change Password</button>
                          </div>
                    </div>
					<div class="form-group">
                          <div class="col-xs-6">
							 <br>
								<p>
								<?php
								if(isset($reso)){
										echo $reso;
									}
								?>
								</p>	
                          </div>
                    </div>
          </div>
    </div>
	</div>
		</div>
	</div>
	<!-- modals -->
	<!-- Firstname modal -->
	<div class="col-md-4 modal-grids">
	<form class="form" action="profile.php" method="POST" id="change_first_name">
		<div class="modal fade" id="firstname" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Change First Name</h4>
					</div>
					<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="control-label">Current:</label>
								<input type="text" class="form-control" id="recipient-name" placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["first_name"];
									}
									else{
										echo "first_name";
									}?>  disabled>
							</div>
							<div class="form-group">
								<label for="message-text" class="control-label" >new:</label>
								<input type="text" name="new" class="form-control">
							</div>
					</div>
					
					<div class="modal-footer">
						<div class="col-md-6">
							
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="change_first_name"  class="btn btn-primary" name="change_first_name">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	
	<!-- username modal -->
	<div class="col-md-4 modal-grids">
	<form class="form" action="profile.php" method="POST" id="change_username">
		<div class="modal fade" id="username" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Change Username</h4>
					</div>
					<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="control-label">Current:</label>
								<input type="text" class="form-control" id="recipient-name" placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["username"];
									}
									else{
										echo "Username";
									}?>  disabled>
							</div>
							<div class="form-group">
								<label for="message-text" class="control-label" >new:</label>
								<input type="text" name="new" class="form-control">
							</div>
					</div>
					
					<div class="modal-footer">
						<div class="col-md-6">
							
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="change_username"  class="btn btn-primary" name="change_username">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- last_name modal -->
	<div class="col-md-4 modal-grids">
	<form class="form" action="profile.php" method="POST" id="change_last_name">
		<div class="modal fade" id="lastname" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Change Last Name</h4>
					</div>
					<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="control-label">Current:</label>
								<input type="text" class="form-control" id="recipient-name" placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["last_name"];
									}
									else{
										echo "last_name";
									}?>  disabled>
							</div>
							<div class="form-group">
								<label for="message-text" class="control-label" >new:</label>
								<input type="text" name="new" class="form-control">
							</div>
					</div>
					
					<div class="modal-footer">
						<div class="col-md-6">
							
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="change_last_name"  class="btn btn-primary" name="change_last_name">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- email modal -->
	<div class="col-md-4 modal-grids">
	<form class="form" action="profile.php" method="POST" id="change_email">
		<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Change email</h4>
					</div>
					<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="control-label">Current:</label>
								<input type="text" class="form-control" id="recipient-name" placeholder=<?php
									if(isset($_SESSION["username"])){
										echo $_SESSION["email"];
									}
									else{
										echo "Email";
									}?>  disabled>
							</div>
							<div class="form-group">
								<label for="message-text" class="control-label" >new:</label>
								<input type="email"  name="new" class="form-control">
							</div>
					</div>
					
					<div class="modal-footer">
						<div class="col-md-6">
							
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="change_email"  class="btn btn-primary" name="change_email">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- password modal -->
	<div class="col-md-4 modal-grids">
	<form class="form" action="profile.php" method="POST" id="change_password">
		<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Change Last Name</h4>
					</div>
					<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="control-label">New Password:</label>
								<input type="password" name="new1" class="form-control" id="recipient-name">
							</div>
							<div class="form-group">
								<label for="message-text" class="control-label" >Current Password:</label>
								<input type="password" name="new2" class="form-control">
							</div>
					</div>
					
					<div class="modal-footer">
						<div class="col-md-6">
							
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="change_password"  class="btn btn-primary">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<!-- //Classie -->
	<!-- //for toggle left push menu script -->

	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
		$('.sidebar-menu').SidebarNav()
	</script>
	<!-- //side nav js -->

	<!-- for index page weekly sales java script -->
	
	<!-- //for index page weekly sales java script -->


	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->

</body>

</html>