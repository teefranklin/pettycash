<?php include "includes/header.php"; ?>
<?php
$query = "SELECT * FROM auth_user";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

?>
<div id="page-wrapper">
	<div class="graphs">
		<div class="col_3">
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa fa-mail-forward"></i>
					<div class="stats">
						<h5>45 <span>%</span></h5>
						<div class="grow">
							<p>Growth</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa fa-users"></i>
					<div class="stats">
						<h5>1 <span>per day</span></h5>
						<div class="grow grow1">
							<p>New Users</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget widget1">
				<div class="r3_counter_box">
					<i class="fa fa-eye"></i>
					<div class="stats">
						<h5><?php echo $count; ?><span></span></h5>
						<div class="grow grow3">
							<p>All Users</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 widget">
				<div class="r3_counter_box">
					<i class="fa fa-usd"></i>
					<div class="stats">
						<h5>700 <span>btc</span></h5>
						<div class="grow grow2">
							<p>Total Deposit</p>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="clearfix"> </div>

	</div>
</div>
<?php include "includes/footer.php"; ?>