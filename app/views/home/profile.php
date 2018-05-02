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
			                	<button class="btn btn-default" onclick="edit_profile(<?= $username ?>)">Edit Profile</button>
			                	<?php } else { ?>

													<div id="unfollow_btn" style="<?= ( (in_array($user_data->userID, $follows_arr)) ? '' : 'display: none;' ) ?>">
														<button class="btn btn-danger" onclick="unfollow_user(<?= $user_data->userID ?>)">Unfollow</button>
													</div>

													<div id="follow_btn" style="<?= ( (in_array($user_data->userID, $follows_arr)) ? 'display: none;' : '' ) ?>">
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
		<?php if(isset($user_posts)) { foreach ($user_posts as $up) { ?>
			<div id="post_<?= $up->post_id ?>" class="well">
				<div class="media">
					<a class="pull-right" title="Delete" style="<?= ( ($username == $this->session->userdata('username')) ? '' : 'display:none' ) ?>" href="javascript:void(0)" onclick="delete_post(<?= ( ($username == $this->session->userdata('username')) ? $up->post_id : '' ) ?>)">
						<i class="fa fa-trash-o"></i>
					</a>
					<!-- user image -->
					<a class="pull-left" href="<?= base_url('home/profile/') . '/' . $up->username ?>">
						<img class="media-object thumbnail my-thumb" src="<?= ( ($up->user_image != 'no_image' && isset($up->user_image)) ? base_url('assets/uploads/user_dp') . '/' . $up->user_image : base_url('assets/img/default-user-image.png') ) ?>">
					</a>
					<div class="media-body">
						<p class="text-right"><a href="<?= base_url('home/profile/') . '/' . $up->username ?>"><?= $up->username ?></a></p>
						<p><?= $up->post_content ?></p>

						<?php if(isset($up->post_attach) && $up->post_attach != "") { ?>
							<?php $info = new SplFIleInfo($up->post_attach); if($info->getExtension() != "pdf") { ?>
								<img class="media-object thumbnail my-img" src="<?= base_url('/uploads/userposts/') . '/' . $up->post_attach ?>" />
							<?php } else { ?>
								<a class="view-pdf" href="<?= base_url('/uploads/userposts/') . '/' . $up->post_attach ?>">
									<img class="media-object thumbnail pdf-img" src="<?= base_url('/assets/img/pdf.png') ?>" />
								</a>
							<?php } ?>
						<?php } ?>

						<ul class="list-inline list-unstyled">
							<li><span><i class="glyphicon glyphicon-calendar"></i> <?= date('d-m-Y', strtotime($up->added_on)) ?> </span></li>
							<li>|</li>
								<span><i class="glyphicon glyphicon-comment" onclick="show_comments(<?= $up->post_id ?>)"></i></span>
							<li>|</li>
							<li>
								<span onclick="like(<?= $up->post_id ?>)"><i class="fa fa-thumbs-up"></i></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<?php } } else { ?>
			<div class="emp_head">
				<?php if($username == $this->session->userdata('username')) { ?>
				<a href="<?= base_url('home/') ?>"><h1>Add your first post...</h1></a>
			<?php } else { ?>
				<h1>Nothing to see here...</h1>
			<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>


<div id="dialog" style="display: none">
</div>

<script type="text/javascript">
	$(function() {
		$('img').on('click', function() {
			$('.enlargeImageModalSource').attr('src', $(this).attr('src'));
			$('#enlargeImageModal').modal('show');
		});
	});
</script>

<script type="text/javascript">
	function delete_post(post_id) {
		swal({
		  title: "Delete Post!",
		  text: "Do you really want to delete this post!",
		  type: "warning",
		  showCancelButton: true,
		  closeOnConfirm: false,
		  showLoaderOnConfirm: true
		}, function () {
		  setTimeout(function () {

				$.ajax({
					url: "<?= base_url('status_update/delete_post') ?>",
					type: "post",
					data: {
						post_id: post_id
					},
					dataType: "json",
					success: function(data) {
						if (data == 1) {
							$("#post_" + post_id).remove();
						}
					}
				});

		    swal("Ajax request finished!");
		  }, 2000);
		});

	}
</script>
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
	function edit_profile(username) {
		if(typeof username !== "undefined") {
			$.ajax({
				url: "<?= base_url('profile/load_edit_profile_view') ?>",
				type: "post",
				data: {
					username: username
				},
				dataType: "json",
				success: function(data) {
					
				}
			});
		}
	}


</script>
