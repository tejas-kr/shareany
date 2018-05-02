<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/profile_card.css') ?>">

<?php /*echo $user_data->userID;
print_r($follows_arr);*/ ?>

<div class="container">
	<div class="col-sm-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6">

			        <div class="card hovercard">
			            <div class="cardheader">

			            </div>
			            <div class="avatar">
			            	<?php if($user_data->user_image != "no_image") { ?>
			                <img alt="" src="https://media.pitchfork.com/photos/5931de9ed4294b0bc2dd97f3/2:1/w_790/6a095ac8.jpg">
			                <?php } else { ?>
			                <img alt="" src="<?= base_url('assets/img/default-user-image.png') ?>">
			                <?php } ?>
			            </div>
			            <div class="info">
			                <div class="title">
			                	<h4><?= $user_data->full_name ?></h4>
			                </div>
			                <?php if(isset($user_data->user_bio)) { ?>
			                <div class="desc"><?= $user_data->user_bio ?></div>
			                <?php } ?>
			                <div class="row">
			                	<?php if($username == $this->session->userdata('username')) { ?>
			                	<button class="btn btn-default">Edit Profile</button>
			                	<?php } else { ?>

													<div id="unfollow_btn" style="<?= ( (in_array($user_data->userID, $follows_arr)) ? 'display: none;' : '' ) ?>">
														<button class="btn btn-danger" onclick="unfollow_user(<?= $user_data->userID ?>)">Unfollow</button>
													</div>

													<div id="follow_btn" style="<?= ( (in_array($user_data->userID, $follows_arr)) ? '' : 'display: none;' ) ?>">
														<button class="btn btn-success" onclick="follow_user(<?= $user_data->userID ?>)">Follow</button>
													</div>

			                	<?php } ?>
			                </div>
			            </div>

			        </div>

			    </div>

			</div>
		</div>
	</div>
	<div class="col-sm-9 profile-posts-down">
		<div class="well">
			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object thumbnail my-thumb" src="https://upload.wikimedia.org/wikipedia/commons/3/31/Ice_Cream_dessert_02.jpg">
				</a>
				<div class="media-body">
					<h4 class="media-haeading">Receta 1</h4>
					<p class="text-right">By Francisco</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
					Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis
					dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.
					Aliquam in felis sit amet augue.</p>
					<ul class="list-inline list-unstyled">
						<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li>
						<li>|</li>
						<span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>

						<li>|</li>
						<li>
							<!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
							<span><i class="fa fa-thumbs-up"></i></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">

	function follow_user(userID) {
		if(typeof userID !== "undefined") {
			$.ajax({
				url: "<?= base_url('home/follow_user') ?>",
				type: "post",
				data: {
					userID: userID
				},
				dataType: "json",
				success: function(data) {
					// $("#follow_btn").html("");
					// $("#follow_btn").html("<button class=\"btn btn-danger\" onclick=\"unfollow_user(<?= $user_data->userID ?>)\">Unfollow</button>");

					$("#unfollow_btn").show();
					$("#follow_btn").hide();

				}
			});
		}
	}
	function unfollow_user(userID) {
		if(typeof userID !== "undefined") {
			$.ajax({
				url: "<?= base_url('home/unfollow_user') ?>",
				type: "post",
				data: {
					userID: userID
				},
				dataType: "json",
				success: function(data) {
					// $("#unfollow_btn").html("");
					// $("#unfollow_btn").html("<button class=\"btn btn-success\" onclick=\"follow_user(<?= $user_data->userID ?>)\">Follow</button>");

					$("#unfollow_btn").hide();
					$("#follow_btn").show();
				}
			});
		}
	}

</script>
