<?php
@session_start();
//Database connection
$db = new PDO('mysql:host=localhost;dbname=pettycash;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

/* user management */

//login function
function login($email, $password)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE email=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if ($count > 0) {
            if (password_verify($password, $rslt[0]["password"])) {
                $result["status"] = "ok";
                $storeSessions = storeSessions($email);
            } else {
                die('wrong password !');
            }
        } else {
            $result["status"] = "fail";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
//check Account

function checkAccount($id)
{
    global $db;
    try {
        $sql = "SELECT * FROM account WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if ($count > 0) {
            return 'yes';
        } else {
            return 'no';
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//store sessions 
function storeSessions($email)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE email=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
            $_SESSION["id"] = $rslt[0]["id"];
            $_SESSION["password"] = $rslt[0]["password"];
            $_SESSION["profile_picture"] = $rslt[0]["profile_picture"];
            $_SESSION["username"] = $rslt[0]["username"];
            $_SESSION["first_name"] = $rslt[0]["first_name"];
            $_SESSION["last_name"] = $rslt[0]["last_name"];
            $_SESSION["email"] = $rslt[0]["email"];
            $_SESSION["date_joined"] = $rslt[0]["date_joined"];
            $_SESSION['fullname'] = $rslt[0]["first_name"] . " " . $rslt[0]["last_name"];
        } else {
            $result["status"] = "fail";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}


//function to check if the user is logged
function isLogggedIn()
{
    if (isset($_SESSION['id'])) {
        return true;
    }
}

//update login
function updateLogin($email, $date)
{
    global $db;
    try {
        $stmt = $db->prepare("update auth_user set last_login=? where email=?");
        $stmt->execute(array($date, $email));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
//logout function
function logout()
{
    session_destroy();
    header("Location:../index.php#popup3");
}

//Function to register a new user
function create_user($email, $password, $first_name, $last_name, $username,$gender,$country,$phone,$sponsor_id)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $id = rand(10111111, 10999999);

    email_exist($email);
    global $db;
    $date_joined=date('Y-m-d H:i:s');
    try {
        $stmt = $db->prepare("INSERT INTO auth_user (id,email,password,first_name,last_name,username,date_joined,gender,country,phone,sponsor_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute(array($id, $email, $password, $first_name, $last_name, $username,$date_joined,$gender,$country,$phone,$sponsor_id));
        add_to_approvals($db,$id,$sponsor_id,"subscription");
        return 'ok';
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
//My User Create Account Function
function createAccount($id)
{
    global $db;
    try {
        $depo_date = date('Y-m-d H:i:s');
        $query ="INSERT INTO account(id) VALUES(".$id.")";
        $statement = $db->prepare($query);
        $statement->execute();
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//insert payment details
function insertPayment($invoice,$amount,$thash,$user)
{
    global $db;
    try {
        $tdate = date('Y-m-d H:i:s');
        $query ="INSERT INTO transaction_log(invoice,amount,transaction_hash,transaction_date,user,action) VALUES($invoice,$amount,'".$thash."','".$tdate."',$user,'deposit')";
        $statement = $db->prepare($query);
        $statement->execute();
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//Function to check if the user already exists
function user_exist($username)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE username=? ";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $result["status"] = "ok";
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}


//Function to check if the email already exists
function email_exist($email)
{
    global $db;
    try {
        $sql = "SELECT * FROM auth_user WHERE email=? ";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($email));
        $rslt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count < 0) {
            $result["status"] = "ok";
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
/* End of user management */

//update user information
function updateProfile($db_field, $variable, $email)
{
    global $db;
    try {
        $stmt = $db->prepare("update auth_user set " . $db_field . "=? where email=?");
        $stmt->execute(array($variable, $email));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
    return $result;
}
function updateAmount()
{
    $pesent = (rand(150, 250) / 100) / 100;
    $amounts = getAmount();
    $total_revenue = round(($amounts[1] * $pesent) + $amounts[1]);
    $generated_revenue = $total_revenue - $amounts[0];

    global $db;
    try {
        $stmt = $db->prepare("update account set total_revenue=?, generated_revenue=? where id=?");
        $stmt->execute(array($total_revenue, $generated_revenue, $_SESSION['id']));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
function getAmount()
{
    global $db;
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
    $values = array();
    $values[0] = $amount_deposited;
    $values[1] = $total_revenue;
    $values[3] = $generated_revenue;
    return $values;
}
function withdraw($amount)
{
    $amounts = getAmount();
    $total_revenue = $amounts[1] - $amount;
    global $db;
    try {
        $stmt = $db->prepare("update account set total_revenue=? where id=?");
        $stmt->execute(array($total_revenue, $_SESSION['id']));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $result["status"] = "ok";
            $result["id"] = $db->lastInsertId();
        } else {
            $result["status"] = "error";
        }
    } catch (Exception $ex) {
        $result["status"] = $ex->getMessage();
    }
}
//function add to approvals
function add_to_approvals($connect,$id,$sponsor_id,$type){
    try{
        $today=date('Y-m-d H:i:s');
    #$req = "R".rand(1234567,9999999 );
	$query="INSERT INTO approvals
             (from_user_id,to_user_id,type,status,date)
		VALUES('$id','$sponsor_id','$type','pending','$today')";
		$statement = $connect->prepare($query);
		$statement->execute();
    }catch (Exception $ex) {
        die("<br><br><br><h1 align=center>Request For Upgrade already sent click <a href='index.php'>Here</a> to go back home.</h1>");
    }
}
