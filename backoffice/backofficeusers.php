<?php include "includes/header.php"; ?>
<?php
$query = "SELECT * FROM backoffice";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

if (isset($_POST['add_user'])) {
    $user_id = get_random_id($db);
    $firstname = strip_tags(trim($_POST['firstname']));
    $lastname = strip_tags(trim($_POST['lastname']));
    $email = strip_tags(trim($_POST['email']));
    $role = strip_tags(trim($_POST['role']));
    $phone = strip_tags(trim($_POST['phone']));
    $username = $firstname . "_" . $lastname;


    //setting a default password when creating a user  and hashing
    $password = "Default01";
    $password = password_hash($password, PASSWORD_DEFAULT);
    //inserting user info
    $query = "INSERT INTO backoffice (user_id,firstname,lastname,username,email,password,phone,role) 
    VALUES('$user_id','$firstname','$lastname','$username','$email','$password','$phone','$role')";
    $statement = $db->prepare($query);
    $statement->execute();

    $query = "SELECT * FROM backoffice";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $result = $statement->fetchAll();
}
//generate random user id
function  get_random_id($db)
{
    $q = 'C' . rand(1080000, 1999999);
    $id = checkDB($q, $db);
    return $id;
}
function checkDB($id, $db)
{
    $query = "SELECT * FROM backoffice
	WHERE user_id='$id'";

    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    if ($count == 0) {
        return $id;
    } else {
        get_random_id($db);
    }
}
?>
<div id="page-wrapper">
    <div class="panel panel-primary" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
        <div class="panel-heading">
            <h2>Backoffice Users</h2>
            <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>

        </div>
        <div class="panel-body no-padding" style="display: block;">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_user" style="margin-bottom:10px;"><i class="fa fa-plus"></i> Add New</button>
            <br>
            <table class="table table-striped" id="backoffice">
                <thead>
                    <tr class="warning">
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <?php if($_SESSION['role'] == 'admin') : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <?php if ($_SESSION['role'] == 'admin') : ?>
                                <td><a href="activate_back.php?id=<?php echo $row['user_id']; ?>" class="badge badge-success">Activate</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_user" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="input form-group">
                        <input class="form-control" type="text" name="firstname" placeholder="Firstname" required="">
                    </div>
                    <div class="input form-group">
                        <input class="form-control" type="text" name="lastname" placeholder="Lastname" required="">
                    </div>
                    <div class="input form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required="" min=1>
                    </div>
                    <div class="input form-group">
                        <input class="form-control" type="text" name="phone" placeholder="Phone Number" required="" min=1>
                    </div>
                    <div class="input form-group">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="payer">Payer</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
            </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>