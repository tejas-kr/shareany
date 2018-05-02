<?php
	echo "<!--";
	print_r($this->session->userdata);
	echo "-->";
?>


<?php $this->load->view('main_feed/status_update'); ?>

<div class="container">

<?php if(isset($shared_posts)) { foreach ($shared_posts as $sp) { ?>
	<div class="well">
		<div class="media">
		<!-- user image -->
		<a class="pull-left" href="<?= base_url('home/profile/') . '/' . $sp->username ?>">
			<img class="media-object thumbnail my-thumb" src="<?= ( ($sp->user_image != 'no_image' && isset($sp->user_image)) ? base_url('assets/uploads/user_dp') . '/' . $sp->user_image : base_url('assets/img/default-user-image.png') ) ?>">
		</a>
		<div class="media-body">
			<p class="text-right"><a href="<?= base_url('home/profile/') . '/' . $sp->username ?>"><?= $sp->username ?></a></p>
			<p><?= $sp->post_content ?></p>
			<ul class="list-inline list-unstyled">
				<li><span><i class="glyphicon glyphicon-calendar"></i> <?= date('d-m-Y', strtotime($sp->added_on)) ?> </span></li>
				<li>|</li>
					<span><i class="glyphicon glyphicon-comment" onclick="show_comments(<?= $sp->post_id ?>)"></i></span>
				<li>|</li>
				<li>
					<!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
					<span onclick="like()"><i class="fa fa-thumbs-up"></i></span>
				</li>
			</ul>
		</div>
		</div>
	</div>
<?php } } ?>

</div>


<script type="text/javascript">

function show_comments(post_id) {
	console.log(post_id);
}

</script>
