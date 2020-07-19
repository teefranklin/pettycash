<?php require "../dashboard/db/DB.php"; ?>
<?php

$id=$_GET['id'];
$query = "SELECT * FROM backoffice where user_id='$id'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

if($count>0){
    $query = "UPDATE backoffice set status='active' where user_id='$id'";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    header('Location:backofficeusers.php');
}else{
    die('<br><br><br><br><br><br><center><h1>Request not Found !</h1></center>');
}