<?php
include "db/DB.php";
$from = $_GET['fr'];
$to = $_GET['t'];


$query = "SELECT * FROM approvals where from_user_id='$from' and to_user_id='$to' and status='pending'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

if($count>0){
    foreach ($result as $row) {
        $query = "UPDATE approvals set status='Paid' where from_user_id='$from' and to_user_id='$to'";
        $statement = $db->prepare($query);
        $statement->execute();
     if($row['type']=='subscription'){
        $query = "UPDATE auth_user set status='Paid', phase=1 where id='$from'";
        $statement = $db->prepare($query);
        $statement->execute();
    
        $query = "UPDATE auth_user set money_in=money_in+10 where id='".$_SESSION['id']."'";
        $statement = $db->prepare($query);
        $statement->execute();
    
     }else{
        $query = "UPDATE auth_user set status='Paid', phase=2 where id='$from'";
        $statement = $db->prepare($query);
        $statement->execute();
    
        $query = "UPDATE auth_user set money_in=money_in+20 where id='".$_SESSION['id']."'";
        $statement = $db->prepare($query);
        $statement->execute();
     }
     header("Location:money_in.php");
    }
}else{
    die("Request Not Found, Request might already been approved");
}


