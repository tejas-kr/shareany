<!DOCTYPE html>
<html>
<head>
	<title><?= $page_title ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">
		body { padding-top: 70px; }
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?= base_url() ?>">
					<img alt="Shareany" style="height: 27px; width: 27px; margin: 0 auto; padding: 0;" src="<?= base_url('assets/img/shareany_logo.png') ?>">
				</a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<?php if($this->session->userdata('username') != "") { ?>
				<li><a href="<?= base_url('home/profile') ?>">Profile</a></li>
				<li><a href="<?= base_url('home/logout') ?>">Logout</a></li>
				<?php } else { ?>
				<li><a href="<?= base_url('blog') ?>">Our blog</a></li>
				<?php } ?>
			</ul>
		</div>
	</nav>


	<?php $this->load->view($sub_view) ?>
</body>
</html>