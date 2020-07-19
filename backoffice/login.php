<?php require "../dashboard/db/DB.php"; ?>
<?php
$message = 'Error Message Here';
if (isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
if (!isset($_SESSION['trys'])) {
    $_SESSION['trys'] = 1;
}
if (isset($_POST['login'])) {
    if ($_SESSION['trys'] == 3) {
        $_SESSION['trys'] = 1;
        $query = "UPDATE backoffice SET status='deactivated' 
		WHERE email= :email";

        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':email' => $_POST['email']
            )
        );

        $message = "<label>Account Is Deactivated Please Contact Your Admin to be Activated!</label>";
    } else {
        $query = "SELECT * FROM backoffice
		WHERE email= :email";

        $statement = $db->prepare($query);
        $statement->execute(
            array(
                ':email' => $_POST['email']
            )
        );
        $count = $statement->rowCount();

        if ($count > 0) {
            $query = "SELECT * FROM backoffice
			WHERE email= :email and status= 'active'";

            $statement = $db->prepare($query);
            $statement->execute(
                array(
                    ':email' => $_POST['email']
                )
            );
            $count = $statement->rowCount();
            if ($count > 0) {
                $result = $statement->fetchAll();
                foreach ($result as $row) {
                    if (password_verify($_POST['password'], $row['password'])) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['avatar'] = $row['avatar'];
                        $_SESSION['fullname'] = $row['firstname'] . ' ' . $row['lastname'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        header('Location:index.php');
                    } else {
                        $message = "<label>Wrong Password</label>";
                        $alert = "<script>alert('You have Entered The wrong password " . $_SESSION['trys'] . " times, 3rd Time your account will be disabled');</script>";
                        $_SESSION['trys']++;
                        echo $alert;
                    }
                }
            } else {
                $message = "<label>Account Is Deactivated</label>";
            }
        } else {
            $message = "<label>Wrong email</label>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tradeshacker | Backoffice Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/styleLogin.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>Backoffice<br> Login Page</h2>
            <p>Login from here to access.</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-black" name="login">Login</button>
                    <button type="submit" class="btn btn-secondary">Forgot Pasword</button>
                </form>
            </div>

        </div>
        <br>
        <div class="alert">
            <p><?php echo $message ?></p>
        </div>
    </div>
</body>

</html>