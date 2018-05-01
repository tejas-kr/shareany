<?php 
	echo "<!--";
	print_r($this->session->userdata);
	echo "-->";
?>


<?php $this->load->view('main_feed/status_update'); ?>

<div class="container">
	<?php $this->load->view('main_feed/main_feed'); ?>
</div>


