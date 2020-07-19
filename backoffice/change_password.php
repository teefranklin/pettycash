<?php require "../dashboard/db/DB.php"; ?>
<?php
if (!isset($_SESSION['trys'])) {
    $_SESSION['trys'] = 0;
}
if (isset($_POST['change_password'])) {
    $passwordOLD = strip_tags(trim($_POST['old_password']));
    $password = strip_tags(trim($_POST['password']));
    $password2 = strip_tags(trim($_POST['confirm_password']));

    if ($password == $password2) {
        $query = "SELECT * FROM backoffice where user_id='".$_SESSION['user_id']."'";
        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $result = $statement->fetchAll();
        $p = $result[0]['password'];

        if ($_SESSION['trys'] < 3) {
            if (password_verify($passwordOLD, $p)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE backoffice set password='$password' where user_id='".$_SESSION['user_id']."'";
                $statement = $db->prepare($query);
                $statement->execute();
                $count = $statement->rowCount();
                header('Location:index.php');
            } else {
                $_SESSION['trys']++;
                die('<br><br><br><br><br><br><center><h1>You Have Entered Wrong Password '.$_SESSION['trys'].' times 3rd time you will be deactivated!</h1></center>');
            }
        } else {
            $query = "UPDATE backoffice set status='deactivated' where user_id='".$_SESSION['user_id']."'";
            $statement = $db->prepare($query);
            $statement->execute();
            header('Location:logout.php');
        }
    }else{
        die('<br><br><br><br><br><br><center><h1>Passwords do not match!</h1></center>');
    }


    
} else {
    die('<br><br><br><br><br><br><center><h1>Request not Found !</h1></center>');
}
