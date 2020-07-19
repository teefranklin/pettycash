<?php

include "includes/header.php";
$query = "SELECT * FROM approvals where to_user_id='" . $_SESSION['id'] . "' and status='pending'";
$statement = $db->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$result = $statement->fetchAll();
?>
<!-- main content start-->
<div id="page-wrapper">
    <div class="main-page">

        <div class="row-one widgettable">
            <div class="col-md-12 content-top-2 card">
                <div class="agileinfo-cdr">
                    <div class="card-header">
                        <h3>Approvals</h3>
                    </div>

                    <table class="table table-striped" id="approvals">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Type</th>
                                <th>status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : ?>
                                <tr>
                                    <?php
                                        $query = "SELECT * FROM auth_user where id='" . $row['from_user_id'] . "'";
                                        $statement = $db->prepare($query);
                                        $statement->execute();
                                        $rezo = $statement->fetchAll();

                                        foreach ($rezo as $roll) {
                                            $firstname = $roll['first_name'];
                                            $lastname = $roll['last_name'];
                                        }
                                        ?>
                                    <td><?php echo $firstname; ?></td>
                                    <td><?php echo $lastname; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td>
                                        <a href="approve.php?fr=<?php echo $row['from_user_id']; ?>&t=<?php echo $row['to_user_id']; ?>" class="btn btn-success">Approve &nbsp;&nbsp;<i class="fa fa-check"></i></a>
                                        <a href="userprofile.php?id=<?php echo $row['from_user_id']; ?>" class="btn btn-info">Contact User&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>