<?php

include "includes/header.php";

?>
<?php
$query = "SELECT * FROM auth_user where sponsor_id='" . $_SESSION['id'] . "'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();
?>
<!-- main content start-->
<div id="page-wrapper">
	<div class="main-page">
		<div class="col_3">
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<img src="../images/phase.png" alt="" height="50px" style="float: left">
					<div class="stats">
						<h5 style="font-size:30px;margin-left:10px;" id="amount_deposited">
							<?php
							$query = "SELECT * FROM auth_user where id='" . $_SESSION['id'] . "'";
							$statement = $db->prepare($query);
							$statement->execute();
							$result = $statement->fetchAll();

							foreach ($result as $row) {
								$phase = $row['phase'];
								$status = $row['status'];
							}
							?>
							<strong><?php echo $phase; ?> </strong>
						</h5>
						<span>Current Phase</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-money user2 icon-rounded"></i>
					<div class="stats">
						<h5 id="generated_revenue">
							<strong><?php echo $status; ?></strong>
						</h5>
						<span>Payment Status</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-users user1 icon-rounded"></i>
					<div class="stats">
						<h5 id="total_revenue">

							<strong><?php echo $count; ?> </strong>
						</h5>
						<span>Members Registered</span>
					</div>
				</div>
			</div>

			<div class="clearfix"> </div>
		</div>
		<br><br>
		<div class="col_3">
			<div class="col-md-6 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-money user2 icon-rounded"></i>
					<div class="stats">
						<h5 style="font-size:30px;margin-left:10px;" id="amount_deposited">
							<strong><?php
									$query = "SELECT * FROM auth_user where id='" . $_SESSION['id'] . "'";
									$statement = $db->prepare($query);
									$statement->execute();
									$result = $statement->fetchAll();

									echo "$ " . $result[0]['money_in'];
									?></strong>
						</h5>
						<span>Money In</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 widget widget1">
				<div class="r3_counter_box">
					<i class="pull-left fa fa-money user2 icon-rounded"></i>
					<div class="stats">
						<h5 id="generated_revenue">
							<strong><?php
									if ($phase == 1) {
										echo '$ 10';
									} elseif ($phase == 0) {
										echo '$ 0';
									} else {
										echo '$ 30';
									}
									?></strong>
						</h5>
						<span>Money Out</span>
					</div>
				</div>
			</div>
			<?php if ($count >= 2 && $phase==1 ) : ?>
				<div class="col-md-3">
					<br>
					<h2 align="center"><a href="upgrade.php" style="color:red" id="upgrade">Upgrade Account</a></h2>
				</div>
			<?php endif; ?>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<?php include "includes/footer.php"; ?>