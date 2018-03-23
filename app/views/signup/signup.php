<?php $back_img_url = base_url('assets/img/back_signup.jpeg'); ?>
<!-- <div class="container-fluid"> -->
<div class="container">

	<div class="row" style="background-image: url('<?= $back_img_url ?>');">
		<div class="col-sm-8" style="margin-top: 10px; color: white;">			

			<h2 style="font-size: 100px;">Share Anything!</h2><br><br><br>
			<p style="font-size: 30px;">Share anything you like to need to share with the people who you want your stuff to be shared with... be it an image, document, or a video clip</p>

		</div>
		<div class="col-sm-4" style="margin: 1% -1%; padding: 0; background-color: white; border-radius: 2%;">
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<div id="signin_text" class="panel-title">Sign In</div>
					<div id="signup_text" style="display: none;" class="panel-title">Sign Up</div>
					<div id="signin_text_extra" style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
				</div>
			</div>

			<div style="padding-top:30px" class="panel-body">

				<div style="display:none" id="login_alert" class="alert alert-danger col-sm-12"></div>

				<input type="hidden" id="signup_true">

				<div class="form-horizontal">
					
					<div style="margin-bottom: 25px; display: none;" id="full_name_div" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-text-color"></i></span>
						<input id="full_name" type="text" class="form-control" name="full_name" value="" placeholder="full name">
					</div>

					<div style="margin-bottom: 25px" id="username_div" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="login_username" type="text" class="form-control" name="username" value="" placeholder="username or email" onkeyup="check_if_username_exists()">
					</div>

					<div id="check_username" class="alert alert-warning" style="display: none; margin-bottom: 25px"></div>

					<div style="margin-bottom: 25px" id="password_div" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="login_password" type="password" class="form-control" name="password" placeholder="password">
					</div>

					<div class="input-group" id="remember_me">
						<div class="checkbox">
							<label>
								<input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
							</label>
						</div>
					</div>

					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
							<a id="btn_login_signup" href="#" class="btn btn-success" onclick="signup_login_function()">Login  </a>
							<!-- <a id="btn-signup" href="#" class="btn btn-success" style="display: none;" onclick="signup_function()">Signup  </a> -->
							<a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 control">
							
							<div id="signup_anchor" style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
								Don't have an account! 
								<a href="#" onClick="show_signup_form()">
								Sign Up Here
								</a>
							</div>

							<div id="signin_anchor" style="border-top: 1px solid#888; padding-top:15px; font-size:85%; display: none;" >
								Already have an account? 
								<a href="#" onClick="show_signin_form()">
								Sign In
								</a>
							</div>

						</div>
					</div> 

				</div>


			</div>

		</div>
	</div>


	<div class="row">
		
	</div>
	
</div>
<!-- </div> -->


<script type="text/javascript">

	function show_signup_form() {
		$('#full_name_div').show();
		$("#signin_anchor").show();
		$("#signup_anchor").hide();
		$("#btn_login_signup").html("Sign up");
		// $("#btn-signup").show();
		$("#remember_me").hide();
		$("#signin_text").hide();
		$("#signup_text").show();
		$("#signin_text_extra").hide();	
		$("#signup_true").val('1');
	}

	function show_signin_form() {
		$('#full_name_div').hide();
		$('#full_name_div').val("");
		$("#signin_anchor").hide();
		$("#signup_anchor").show();
		$("#btn_login_signup").html("Login");
		// $("#btn-signup").hide();
		$("#remember_me").show();
		$("#signin_text").show();
		$("#signup_text").hide();
		$("#signin_text_extra").show();
		$("#signup_true").val('0');
	}

	function check_if_username_exists() {
		var u_name = $("#login_username").val();
		if($("#signup_true").val() == 1) {
			$.ajax({
				url: "<?= base_url('home/check_if_username_exists') ?>",
				type: "POST",
				data: {
					u_name: u_name
				},
				dataType: "JSON",
				success: function(data) {
					if(data.message == 1) {
						$("#check_username").show();
						$("#check_username").html('Username already exists');
					} else {
						$("#check_username").hide();
					}
				}
			});	
		}	
	}

	function signup_login_function() {
		var signup = $("#signup_true").val();
		var full_name = $("#full_name").val();
		var username = $("#login_username").val();
		var password = $("#login_password").val();
		if(signup == "1") {
			$.ajax({
				url: "<?= base_url('home/sign_up_new_user') ?>",
				type: "POST",
				data: {
					username: username,
					password: password,
					full_name: full_name
				},
				dataType: "JSON",
				success: function(data) {
					if(data.message == 0) {
						$("#login_alert").show();
						$("#login_alert").html("Error!");
						setTimeout(function() {
							$("#login_alert").hide();
						}, 2000);
					} else {
						window.location = "<?= base_url('home/index') ?>"
					}
				}
			});
		} else {
			$.ajax({
				url: "<?= base_url('home/sign_in_user') ?>",
				type: "POST",
				data: {
					username: username,
					password: password
				},
				dataType: "JSON",
				success: function(data) {
					if(data.message == 0) {
						$("#login_alert").show();
						$("#login_alert").html("Error!");
						setTimeout(function() {
							$("#login_alert").hide();
						}, 2000);
					} else {
						window.location = "<?= base_url('home/index') ?>"
					}
				}
			});
		}
	}

</script>