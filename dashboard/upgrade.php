<?php
include "db/DB.php";


$query = "SELECT * FROM auth_user where id='".$_SESSION['id']."' and phase<2";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

if($count>0){
    foreach ($result as $row) {
        $query = "SELECT * FROM auth_user where id='".$row['sponsor_id']."' and status='Paid'";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $rezo = $statement->fetchAll();
        if($count>0){
            foreach($rezo as $r){
                if($r['phase']<2){
                    add_to_approvals($db,$_SESSION['id'],'default','upgrade');
                    header("Location:index.php");
                }else{
                    add_to_approvals($db,$_SESSION['id'],$r['sponsor_id'],'upgrade');
                    header("Location:index.php");
                }
                
            }
        }else{
            add_to_approvals($db,$_SESSION['id'],'default','upgrade');
            header("Location:index.php");
        }
        
     
    }
}else{
    die("You Have already Upgraded");
}


