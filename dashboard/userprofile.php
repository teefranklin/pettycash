<?php
include "includes/header.php";
$id = $_GET['id'];

$query = "SELECT * FROM auth_user where id='$id'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();

foreach($result as $row){
    $id=$row['id'];
    $fname=$row['first_name'];
    $lname=$row['last_name'];
    $email=$row['email'];
    $phone=$row['phone'];
    $phase=$row['phase'];
    $status=$row['status'];
}
?>
<div id="page-wrapper">
    <div class="panel panel-primary" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
        <div class="panel-heading">
            <h2>User Info</h2>
            <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>

        </div>
        <div class="panel-body no-padding" style="display: block;">
            <div class='alert alert-info'>
                <h3 align="center">Information for <?php echo $fname." ".$lname; ?></h3>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="">User ID </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $id; ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="">First Name</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $fname; ?>" disabled />
                    </div>
                    <div class="col-md-2">
                        <label for="">Last Name</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $lname; ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="">Email</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $email; ?>" disabled />
                    </div>
                    <div class="col-md-2">
                        <label for="">Phone</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $phone; ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label for="">Phase</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $phase; ?>" disabled />
                    </div>
                    <div class="col-md-2">
                        <label for="">Status</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="refferal" value="<?php echo $status; ?>" disabled />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>