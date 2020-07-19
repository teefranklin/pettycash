<?php include "includes/header.php"; ?>
<?php
if(!isset($_GET['payTo'])){
    die('Error 404');
}else{
    $payTo=$_GET['payTo'];
}
?>
<!-- main content start-->
<div id="page-wrapper">
    <div class="main-page compose">
        <h2 class="title1">Send payment</h2>
        <div class="col-md-12 compose-right widget-shadow">
            
            <div class="clearfix"> </div>
        </div>
    </div>
</div>