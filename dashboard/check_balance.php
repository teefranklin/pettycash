<?php
require "db/DB.php";
global $db;
    try{
    $sql = "SELECT * FROM account WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($_SESSION['id']));
    $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count>0){
        $result["status"]="ok";
        $callback = array(
            'status' => 'success',
            'generated_revenue' => $rslt[0]["generated_revenue"], 
            'total_revenue' => $rslt[0]["total_revenue"],
            'amount_deposited' => $rslt[0]["amount_deposited"], 
          );
    }else{
        $result["status"]="fail";
    }
    } catch (Exception $ex) {
        $result["status"]=$ex->getMessage();
    }

echo json_encode($callback); // converting varible $callback to JSON


?>