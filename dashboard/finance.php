<?php include "includes/header.php"; ?>
<?php
$id = $_GET['id'];
$error = "Please Fill In The Passwords";
$type = "info";

if (isset($_POST['change_password'])) {
    //setting a default password when creating a user  and hashing
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($password == $cpassword) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE backoffice SET password = $password where user_id='$id'";
        $statement = $db->prepare($query);
        $statement->execute();

        $error = "Password Change Successful !";
        $type = "success";
    } else {
        $error = "Passwords Do Not Match";
        $type = "warning";
    }
}

?>
<div id="page-wrapper">
    <div class="panel panel-primary" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
        <div class="panel-heading">
            <h2>Change Password</h2>
            <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>

        </div>
        <div class="panel-body no-padding" style="display: block;">
            <div class='alert alert-<?php echo $type; ?>'>
                <h3 align="center"><?php echo $error ?></h3>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control" />
                        </div>

                        <br>
                        <input type="submit" class="btn btn-primary" value="Change Password" name="change_password" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>