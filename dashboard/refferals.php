<?php include "includes/header.php"; ?>
<div id="page-wrapper">
    <div class="panel panel-primary" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
        <div class="panel-heading">
            <h2>Refferals Link</h2>
            <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>

        </div>
        <div class="panel-body no-padding" style="display: block;">
            <div class='alert alert-info'>
                <h3 align="center">Copy link below for invites</h3>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="refferal" value="http://localhost:8080/pettycash/signup.php?id=<?php echo base64_encode($_SESSION['id']); ?>"/>
                        </div>

                        <br>
                        <button class="btn btn-primary" onclick="myFunction()">Copy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>