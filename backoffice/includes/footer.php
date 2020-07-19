<!--body wrapper start-->
</div>
<!--body wrapper end-->
</div>
<!-- Modal -->
<div class="modal fade" id="change_password" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="change_password.php">
                    <div class="input form-group">
                        <input class="form-control" type="password" name="old_password" placeholder="Old Password" required="">
                    </div>
                    <div class="input form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required="">
                    </div>
                    <div class="input form-group">
                        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required="">
                    </div>
                    <input type="submit" class="btn btn-primary" name="change_password" value="Change Password">
            </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--footer section start-->
<footer>
    <p>&copy 2019 TradeShacker Money Trading. All Rights Reserved | Design by <a href="#" target="_blank">Anonymous.</a></p>
</footer>
<!--footer section end-->

<!-- main content end-->
</section>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#backoffice').DataTable({
            "columnDefs": [{
                "searchable": false,
                "targets": 7
            }]
        });
        $('#users').DataTable({
            "columnDefs": [{
                "searchable": false,
                "targets": 6
            }]
        });
        $('#paid').DataTable();  
        $('#pending').DataTable(); 
    });
</script>
</body>

</html>