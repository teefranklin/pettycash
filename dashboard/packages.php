<?php include "includes/header.php"; ?>
<div id="page-wrapper">
	<div class="main-page">
		<div class="container">
			<div class="row">
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Starter</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $100.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 100;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Starter</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $200.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 200;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Starter</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $500.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 500;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Basic</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $700.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 700;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Basic</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $1000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 1000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Basic</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $2000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 2000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Premium</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $5000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 5000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Premium</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $10000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 10000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Premium</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $20000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 20000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Professional</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $30000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 30000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Professional</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $40000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 40000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-3 packages">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 align="center">Professional</h3>
						</div>
						<div class="panel-body">
							<center>
								<p>Deposit : $50000.00</p>
								<?php
									$increment = 1.5;
									$days = 30;
									$current_value = 50000;
									$i = 0;
									while ($i <= $days) {
										$current_value = $current_value + ($current_value * 0.015);
										$i++;
									}
								?>
								<br>
								<p>Number Of Days : 30</p>
								<br>
								<p class="desc">And Get: $<?php echo round($current_value); ?>.00</p>
								<br>
								<a href="receive.php" class="badge badge-primary">Deposit</a>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "includes/footer.php"; ?>