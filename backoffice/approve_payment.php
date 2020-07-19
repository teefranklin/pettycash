<?php require "../dashboard/db/DB.php"; ?>
<?php

$id=$_GET['id'];
$rid=$_GET['rid'];
$query = "SELECT * FROM widthdrawals where id=$id";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

$amount = $result[0]['amount'];
$user_id=$result[0]['user_id'];
$today=date('Y-m-d H:i:s');

if($count>0){
    $query = "UPDATE widthdrawals set status='paid' where id=$id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    $query = "UPDATE account set total_revenue= total_revenue-$amount where id=$user_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    $query = "UPDATE notifications set is_seen='yes' where request_id='$rid'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();


    $query = "INSERT INTO transaction_log(amount,transaction_date,user,action) 
		VALUES('$amount','$today','$user_id','Withdrawal')";
	$statement = $db->prepare($query);
	$statement->execute();


    header('Location:pendingapprovals.php');
}else{
    die('<br><br><br><br><br><br><center><h1>Request not Found !</h1></center>');
}