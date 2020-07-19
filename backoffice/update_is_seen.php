<?php require "../dashboard/db/DB.php"; ?>
<?php

$id=$_GET['id'];
$query = "SELECT * FROM widthdrawals where id=$id";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

$amount = $result[0]['amount'];
$user_id=$result[0]['user_id'];
$today=date('Y-m-d H:i:s');

if($count>0){
    $query = "UPDATE notifications set is_seen='yes' where request_id='$id'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    $query = "UPDATE account set total_revenue= total_revenue-$amount where id=$user_id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    header('Location:pendingapprovals.php');
}else{
    die('<br><br><br><br><br><br><center><h1>Request not Found !</h1></center>');
}