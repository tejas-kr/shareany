
<?php
	echo "<!--";
	print_r($this->session->userdata);
	echo "-->";
?>


<div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
		 <div class="modal-content">
			 <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			 </div>
			 <div class="modal-body">
				 <img src="" class="enlargeImageModalSource" style="width: 100%;">
			 </div>
		 </div>
	 </div>
</div>

<?php $this->load->view('main_feed/status_update'); ?>

<div class="container">

<?php if(isset($shared_posts)) { foreach ($shared_posts as $sp) { ?>
	<div id="post_<?= $sp->post_id ?>" class="well">
		<div class="media">
			<a class="pull-right" title="Delete" style="<?= ( ($username == $sp->username) ? '' : 'display:none' ) ?>" href="javascript:void(0)" onclick="delete_post(<?= ( ($username == $sp->username) ? $sp->post_id : '' ) ?>)">
				<i class="fa fa-trash-o"></i>
			</a>
			<!-- user image -->
			<a class="pull-left" href="<?= base_url('home/profile/') . '/' . $sp->username ?>">
				<img class="media-object thumbnail my-thumb" src="<?= ( ($sp->user_image != 'no_image' && isset($sp->user_image)) ? base_url('assets/uploads/user_dp') . '/' . $sp->user_image : base_url('assets/img/default-user-image.png') ) ?>">
			</a>
			<div class="media-body">
				<p class="text-right"><a href="<?= base_url('home/profile/') . '/' . $sp->username ?>"><?= $sp->username ?></a></p>
				<p><?= $sp->post_content ?></p>

				<?php if(isset($sp->post_attach) && $sp->post_attach != "") { ?>
					<?php $info = new SplFIleInfo($sp->post_attach); if($info->getExtension() != "pdf") { ?>
						<img class="media-object thumbnail my-img" src="<?= base_url('/uploads/userposts/') . '/' . $sp->post_attach ?>" />
					<?php } else { ?>
						<a class="view-pdf" href="<?= base_url('/uploads/userposts/') . '/' . $sp->post_attach ?>">
							<img class="media-object thumbnail pdf-img" src="<?= base_url('/assets/img/pdf.png') ?>" />
						</a>
					<?php } ?>
				<?php } ?>

				<ul class="list-inline list-unstyled">
					<li><span><i class="glyphicon glyphicon-calendar"></i> <?= date('d-m-Y', strtotime($sp->added_on)) ?> </span></li>
					<li>|</li>
						<span><i class="glyphicon glyphicon-comment" onclick="show_comments(<?= $sp->post_id ?>)"></i></span>
					<li>|</li>
					<li>
						<span onclick="like(<?= $sp->post_id ?>)"><i class="fa fa-thumbs-up"></i></span>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php } } ?>

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

function show_comments(post_id) {
	console.log(post_id);
}

function like(post_id) {
	console.log(post_id);
}

</script>
