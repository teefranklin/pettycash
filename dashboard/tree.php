<?php

include "includes/header.php";

try {
	$sql = "SELECT * FROM account WHERE id=?";
	$stmt = $db->prepare($sql);
	$stmt->execute(array($_SESSION['id']));
	$rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$count = $stmt->rowCount();
	if ($count > 0) {
		$result["status"] = "ok";
		$amount_deposited = $rslt[0]["amount_deposited"];
		$total_revenue = $rslt[0]["total_revenue"];
		$generated_revenue = $rslt[0]["generated_revenue"];
		//last_logged date to be added later
	} else {
		$result["status"] = "fail";
	}
} catch (Exception $ex) {
	$result["status"] = $ex->getMessage();
}

?>
<!-- main content start-->
<div id="page-wrapper">
	<div class="main-page">

		<div class="row-one widgettable">
			<div class="col-md-12 content-top-2 card">
				<div class="agileinfo-cdr">
					<div class="card-header">
						<h3>Invites Tree</h3>
					</div>

					<div id="tree" style="width: 98%; height: 350px">


					</div>

				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<?php include "includes/footer.php"; ?>