<?php include "includes/header.php"; ?>
<?php
$query = "SELECT * FROM widthdrawals where status !='paid'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();
?>
<div id="page-wrapper">
    <div class="panel panel-primary" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
        <div class="panel-heading">
            <h2>Pending Approvals</h2>
            <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
        </div>
        <div class="panel-body no-padding" style="display: block;">
            <table class="table table-striped" id="pending">
                <thead>
                    <tr class="warning">
                        <th>id</th>
                        <th>From</th>
                        <th>Assigned To</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <?php if ($_SESSION['role'] == 'payer' || $_SESSION['role'] == 'admin') : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <?php
                            $query = "SELECT * FROM auth_user where id=" . $row['user_id'];
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $count = $statement->rowCount();
                            $names = $statement->fetchAll();

                            $fullname = $names[0]['first_name'] . ' ' . $names[0]['last_name'];
                            ?>
                            <td><?php echo $fullname; ?></td>

                            <?php
                            $query = "SELECT * FROM backoffice where user_id='" . $row['to_user_id'] . "'";
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $count = $statement->rowCount();
                            $names = $statement->fetchAll();

                            $fullname = $names[0]['firstname'] . ' ' . $names[0]['lastname'];
                            ?>

                            <td><?php echo $fullname; ?></td>
                            <td><?php echo '$ ' . $row['amount']; ?></td>

                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <?php if ($_SESSION['role'] == 'payer' || $_SESSION['role'] == 'admin') : ?>
                                <td><a href="approve_payment.php?id=<?php echo $row['id']; ?>&rid=<?php echo $row['request_id']; ?>" class="badge badge-success">Approve</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>