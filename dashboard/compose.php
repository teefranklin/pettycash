<?php include "includes/header.php"; ?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page compose">
				<h2 class="title1">Queries Page</h2>
				<div class="col-md-12 compose-right widget-shadow">
					<div class="panel-default">
						<div class="panel-heading">
							Compose New Message 
						</div>
						<div class="panel-body">
							<div class="alert alert-info">
								Please fill details to send a new message
							</div>
							<form class="com-mail">
								<input type="text" class="form-control1 control3" placeholder="To :">
								<input type="text" class="form-control1 control3" placeholder="Subject :">
								<textarea rows="6" class="form-control1 control2" placeholder="Message :" ></textarea>
								<div class="form-group">
									<div class="btn btn-default btn-file">
										<i class="fa fa-paperclip"></i> Attachment
										<input type="file" name="attachment">
									</div>
									<p class="help-block">Max. 32MB</p>
								</div>
								<input type="submit" value="Send Message"> 
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>	
			</div>
		</div>
<?php include "includes/footer.php"; ?>