<style type="text/css">
	.my-thumb {
		max-height: 200px;
		max-width: 100px;
	}
</style>


<div class="container">
  <div class="well">
      <div class="media">

  		<div class="media-body">
    		<h4 class="media-haeading">Share Your Stuff</h4>

    		<form name="add_stuff_form" id="add_stuff_form" enctype="multipart/form-data">

			<!-- <div class="form-group">
				<label for="add_post_title">Title:</label>
				<input type="text" class="form-control" id="add_post_title" name="add_post_title">
			</div> -->

			<div class="form-group">
				<!-- <label for="add_description">Post Description:</label> -->
				<textarea class="form-control" id="add_description" name="add_description"></textarea>
			</div>

    		<div class="row">
    			<div class="col-sm-1">
    				<button type="submit" class="btn btn-primary">Share</button>
    			</div>
    			<div class="col-sm-2">
					<label class="btn btn-info btn-file">
						Upload Files <input type="file" style="display: none;" name="userfile">
					</label>
    			</div>
    		</div>

    		</form>

       </div>
    </div>
  </div>

</div>


<script type="text/javascript">
	$("#add_description").jqte({
		format: false,
		fsize: false
	});
</script>

<script type="text/javascript">

	$('form[name="add_stuff_form"]').submit(function(e) {

		e.preventDefault();

		// var post_title = $("#add_post_title").val();

		var post_content = $("#add_description").val();
		// console.log(post_content);

		if(post_content == "") {
			alertify.error('Enter post title and description');
		} else {

			$.ajax({
				url: "<?= base_url('status_update/save_status_update') ?>",
				type: "POST",
				data: new FormData(this),
				dataType: "JSON",
				processData: false,
				contentType: false,
				cache: false,
				success: function(data) {
					if(data.status_flag == 1) {
						alertify.success('Post Shared!');
						$('form[name="add_stuff_form"]')[0].reset();
						$('.jqte_editor').html('');
						location.reload();
					} else {
						alertify.error('Error occured while sharing post!!!');
					}
				}
			});

		}

	});

</script>
