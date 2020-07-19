<?php include "includes/header.php";
$msg = "Withdraw";

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
	} else {
		$result["status"] = "fail";
	}
} catch (Exception $ex) {
	$result["status"] = $ex->getMessage();
}

if (isset($_POST['withdraw'])) {
	$amount = $_POST['amount'];
	//withdraw($amount);
	$msg = "Please Wait while your request is being processed !";
	$today = date('Y-m-d H:i:s');

	$query = "SELECT * FROM backoffice where role='payer'";
	$statement = $db->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$result = $statement->fetchAll();

	$to_user_id=$result[0]['user_id'];
	$rid = get_random_id($db);

	// insert into withdrawals
	$query = "INSERT INTO widthdrawals (user_id,to_user_id,amount,date,status,request_id) 
		VALUES('". $_SESSION['id'] . "','$to_user_id','$amount','$today','Pending Approval','$rid')";
	$statement = $db->prepare($query);
	$statement->execute();

	// insert into notifications
	$text='Withdrawal of '.$amount .' from '.$_SESSION['fullname'];
	$query = "INSERT INTO notifications (from_user_id,to_user_id,type,text,date,request_id) 
		VALUES('" . $_SESSION['id'] . "','$to_user_id','withdrawal','$text','$today','$rid')";
	$statement = $db->prepare($query);
	$statement->execute();

}
//generate request id
function  get_random_id($db)
{
    $q = 'R' . rand(1080000, 1999999);
    $id = checkDB($q, $db);
    return $id;
}
function checkDB($id, $db)
{
    $query = "SELECT * FROM widthdrawals
	WHERE request_id='$id'";

    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    if ($count == 0) {
        return $id;
    } else {
        get_random_id($db);
    }
}
?>
<!-- main content start-->
<div id="page-wrapper">
	<div class="main-page compose">
		<h2 class="title1" align="center">Request Withdrawal</h2>
		<div class="col-md-12 compose-right widget-shadow">
			<div class="panel-default">
				<div class="panel-heading">
					<h3 align="center">Withdraw Your Money</h3>
				</div>
				<div class="panel-body">
					<div class="alert alert-info">
						<h4 align="center"><?php echo $msg; ?></h4>
					</div>
					<form class="com-mail" method="POST">
						<label for="">Your Available Balance</label>
						<input type="text" class="form-control1 control3" value="<?php echo $total_revenue; ?>" disabled>

						<label for="">Amount to be Withdrawn</label>
						<input type="number" class="form-control1 control3" max="<?php echo $total_revenue; ?>" min="75" name="amount" required>
						<br>
						<input type="submit" value="Withdraw" name="withdraw">
					</form>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<?php include "includes/footer.php"; ?>