<?php
$countries = array(
	"Afghanistan", "Albania", "Algeria", "American Samoa",
	"Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda",
	"Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",
	"Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize",
	"Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana",
	"Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam",
	"Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada",
	"Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile",
	"China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros",
	"Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica",
	"Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark",
	"Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt",
	"El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia",
	"Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France",
	"France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories",
	"Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland",
	"Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana",
	"Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras",
	"Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)",
	"Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan",
	"Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of",
	"Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon",
	"Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania",
	"Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar",
	"Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique",
	"Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of",
	"Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique",
	"Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles",
	"New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island",
	"Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea",
	"Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar",
	"Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
	"Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
	"Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia",
	"Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands",
	"Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname",
	"Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic",
	"Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo",
	"Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands",
	"Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
	"United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela",
	"Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands",
	"Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"
);
$msg="";
if(!isset($_GET['msg'])){
 $msg="Fill In the details below";
 $alert="info";
}else{
	$msg=$_GET['msg'];
	$alert=$_GET['alert'];
}
?>


<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>

	<title>Petty Cash Network | Signup</title>

	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="Custom Signup Form Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom-Style-Sheet -->
	<!-- Index-Page-CSS -->
	<link rel="stylesheet" href="css/Signupstyle.css" type="text/css" media="all">
	<!-- Calendar-CSS -->
	<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all">

	<link href="img/logo1.png" rel="icon">
	<!-- //Custom-Style-Sheet -->

	<!-- Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" type="text/css" media="all">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700" type="text/css" media="all">
	<!-- //Fonts -->

</head>
<!-- //Head -->



<!-- Body -->

<body>

	<h1>PETTY CASH NETWORK FORM</h1>

	<div class="containerw3layouts-agileits">

		<div class="w3imageaits">
			<img class="user" src="images/user.png" alt="Custom Signup Form">
			<h2>Let's get you set up</h2>
			<p>It should only take you a minute to connect</p>
		</div>

		<div class="aitsloginwthree w3layouts agileits">
			<form action="dashboard/signup.php" method="post">
			<div class="alert alert-<?php echo $alert; ?>">
				<?php echo $msg; ?>
			</div>
				<input type="text" Name="firstname" placeholder="First Name" required="">
				<input type="text" Name="lastname" placeholder="Last Name" required="">
				<select class="fill" name="gender" id="">
					<option value="male">Male</option>
					<option value="female">Female</option>
					<option value="other">Other</option>
				</select>
				<select class="fill" name="country" id="">
				<?php foreach($countries as $country) : ?>
					<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
				<?php endforeach ; ?>
				</select>
				<input class="fill email" type="text" name="email" placeholder="Email" required="">
				<input type="password" Name="password" placeholder="Password" required="">
				<input type="password" Name="cpassword" placeholder="Confirm Password" required="">
				<input class="fill tel" name="phone" placeholder="Phone" required="">
				<?php if(isset($_GET['id'])) : ?>
					<input type="text" Name="sponsor_id" value="<?php echo base64_decode($_GET['id']); ?>" required="">
				<?php else: ?>
					<input type="text" Name="sponsor_id" placeholder="Sponsor ID" required="">
				<?php endif ; ?>
				<div class="send-button wthree agileits">
					<input type="submit" value="Sign Up" name="signup"><br><br>
					Already have an Account <a href="index.php#popup3" class="">Login</a>
				</div>
			</form>
		</div>

		<div class="clear"></div>

	</div>

	<div class="w3lsfooteragileits">
		<p> &copy; 2019 Petty Cash Network. All Rights Reserved | Design by <a href="https://ascii.co.zw" target="=_blank">Ascii Technologies</a></p>
	</div>



	<!-- Necessary-JavaScript-Files-&-Links -->

	<!-- Default-JavaScript -->
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>

	<!-- Date-Picker-JavaScript -->
	<script src="js/jquery-ui.js"></script>
	<script>
		$(function() {
			$("#datepicker1").datepicker();
		});
	</script>
	<!-- //Date-Picker-JavaScript -->

	<!-- //Necessary-JavaScript-Files-&-Links -->



</body>
<!-- //Body -->



</html>