<?php require "../dashboard/db/DB.php"; ?>
<?php

$id=$_GET['id'];
$query = "SELECT * FROM auth_user where id=$id";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

if($count>0){
    $query = "UPDATE auth_user set is_active=1 where id=$id";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();

    header('Location:users.php');
}else{
    die('<br><br><br><br><br><br><center><h1>Request not Found !</h1></center>');
}