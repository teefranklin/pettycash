<?php require "../dashboard/db/DB.php"; ?>
<?php if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Tradeshacker | Backoffice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <!-- //lined-icons -->
    <!-- chart -->
    <script src="js/Chart.js"></script>
    <!-- //chart -->
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!----webfonts--->
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Meters graphs -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <!-- Placed js at the end of the document so the pages load faster -->

</head>

<body class="sticky-header left-side-collapsed" onload="initMap()">
    <section>
        <!-- left side start-->
        <div class="left-side sticky-left-side">

            <!--logo and iconic logo start-->
            <div class="logo">
                <h1><a href="index.php">Back <span>Office</span></a></h1>
            </div>
            <div class="logo-icon text-center">
                <a href="index.php"><i class="lnr lnr-home"></i> </a>
            </div>

            <!--logo and iconic logo end-->
            <div class="left-side-inner">

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li class="active"><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-users"></i>
                            <span>Users</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="backofficeusers.php">Backoffice</a> </li>
                            <li><a href="users.php">Tradeshacker Users</a></li>
                        </ul>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-usd "></i> <span>Withdrawals</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="pendingapprovals.php">Pending Withdrawals</a> </li>
                            <li><a href="paid_withdrawals.php">Paid Withdrawals</a></li>
                        </ul>
                    </li>
                </ul>
                <!--sidebar nav end-->
            </div>
        </div>
        <!-- left side end-->

        <!-- main content start-->
        <div class="main-content">
            <!-- header-starts -->
            <div class="header-section">

                <!--toggle button start-->
                <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
                <!--toggle button end-->

                <!--notification menu start -->
                <div class="menu-right">
                    <div class="user-panel-top">
                        <div class="profile_details_left">
                            <ul class="nofitications-dropdown">
                                <?php
                                $query = "SELECT * FROM notifications where to_user_id='" . $_SESSION['user_id'] . "' AND is_seen='no'";
                                $statement = $db->prepare($query);
                                $statement->execute();
                                $count = $statement->rowCount();
                                $result = $statement->fetchAll();
                                ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><?php if ($count != 0) {
                                                                                                                                                    echo '<span class="badge blue"> ' . $count . '</span>';
                                                                                                                                                } ?></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="notification_header">
                                                <h3>You have <?php echo $count; ?> new notification</h3>
                                            </div>
                                        </li>

                                        <?php foreach ($result as $row) : ?>
                                            <li><a href="update_is_seen.php?id=<?php echo $row['request_id']; ?>">
                                                    <div class="user_img"><i class="fa fa-tasks"></i></div>
                                                    <div class="notification_desc">
                                                        <p><?php echo $row['text'] ?></p>
                                                        <p><span class="pull-right"><?php echo $row['date'] ?></span></p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a></li>
                                        <?php endforeach; ?>
                                        <li>
                                            <div class="notification_bottom">
                                                <a href="#">See all notification</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                        <div class="profile_details">
                            <ul>
                                <li class="dropdown profile_details_drop">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <div class="profile_img">
                                            <span style="background:url(images/user.png) no-repeat center"> </span>
                                            <div class="user-name">
                                                <p><?php echo $_SESSION['username']; ?><span><?php echo $_SESSION['role']; ?></span></p>
                                            </div>
                                            <i class="lnr lnr-chevron-down"></i>
                                            <i class="lnr lnr-chevron-up"></i>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu drp-mnu">
                                        <li> <a href="#"  data-toggle="modal" data-target="#change_password"><i class="fa fa-cog"></i> Change Password</a> </li>
                                        <li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                    </ul>
                                </li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--notification menu end -->
            </div>
            <!-- //header-ends -->