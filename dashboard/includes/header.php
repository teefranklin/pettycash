<?php require "db/DB.php"; ?>
<?php
if (!isset($_SESSION['id'])) {
	header("Location:../index.php#popup3");
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Petty Cash Network | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="img/logo.png" rel="icon">
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
	<!-- //side nav css file -->

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts-->

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
	</style>
	<!--pie-chart -->
	<!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<!-- //pie-chart -->
	<!-- index page sales reviews visitors pie chart -->

	<!-- requried-jsfiles-for owl -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<script src="js/owl.carousel.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<script>
		$(document).ready(function() {
			$("#owl-demo").owlCarousel({
				items: 3,
				lazyLoad: true,
				autoPlay: true,
				pagination: true,
				nav: true,
			});
		});
	</script>
	<script src="https://d3js.org/d3.v5.min.js"></script>
	<style>
		rect {
			fill: yellow;
			stroke: silver;
			width: 120px;
			height: 40px;
			stroke-width: 2;
		}

		path {
			fill: none;
			stroke: silver;
			stroke-width: 2;
		}

		text {
			text-anchor: middle;
			font-size: 12px;
		}
	</style>
	<!-- //requried-jsfiles-for owl -->
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left">
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1>
							<a class="navbar-brand" href="index.php">
								<span class="fa fa-dollar"></span> Petty Cash
								<span class="dashboard_text">Network</span>
							</a>
						</h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MAIN NAVIGATION</li>
							<li class="treeview">
								<a href="index.php">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li>
								<a href="refferals.php">
									<i class="fa fa-user"></i>
									<span>Refferals</span>
								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-check"></i>
									<span>Approvals</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li>
										<a href="money_in.php">
											<i class="fa fa-angle-right"></i> Money In</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="tree.php">
									<i class="fa fa-tree"></i>
									<span>Tree</span>
								</a>
							</li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</aside>
		</div>
		<!--left-fixed -navigation-->

		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush">
					<i class="fa fa-bars"></i>
				</button>
				<!--toggle button end-->
				<div class="profile_details_left">
					<!--notifications of menu start -->
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">

				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img">
										<img class="img-thumbnail avatar" src="images/<?php echo $_SESSION['profile_picture']; ?>" alt="" height="40px" width="60px"> </span>
									<div class="user-name">
										<p><?php echo $_SESSION['fullname']; ?></p>
										<span><?php echo $_SESSION['username']; ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>
								</div>
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li>
									<a href="profile.php">
										<i class="fa fa-suitcase"></i> Profile</a>
								</li>
								<li>
									<a href="logout.php">
										<i class="fa fa-sign-out"></i> Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //header-ends -->