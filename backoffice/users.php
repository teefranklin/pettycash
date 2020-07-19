<?php include "includes/header.php"; ?>
<?php
$query ="SELECT * FROM auth_user";
$statement = $db->prepare($query);
$statement->execute();
$count= $statement -> rowCount();
$result = $statement->fetchAll();
?>
<div id="page-wrapper">
    <div class="panel panel-primary" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
        <div class="panel-heading">
            <h2>TradeShacker Users</h2>
            <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
        </div>
        <div class="panel-body no-padding" style="display: block;">
            <table class="table table-striped" id="users">
                <thead>
                    <tr class="warning">
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <?php if($_SESSION['role'] == 'admin') : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($result as $row) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <?php
                            $query ="SELECT * FROM account where id=".$row['id'];
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $count= $statement -> rowCount();
                            $amounts = $statement->fetchAll();

                            $amount=$amounts[0]['total_revenue'];
                        ?>
                        <td><?php echo '$ '.$amount; ?></td>
                        <?php if($row['is_active'] == 1) : ?>
                            <td><?php echo "active"; ?></td>
                        <?php else: ?>
                            <td><?php echo "deactivated"; ?></td>
                        <?php endif; ?>
                        <?php if($_SESSION['role'] == 'admin') : ?>
                            <td><a href="activate_user.php?id=<?php echo $row['id']; ?>" class="badge badge-success">Activate</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>