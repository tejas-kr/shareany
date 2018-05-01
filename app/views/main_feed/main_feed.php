<!-- feed load here -->

<div class="well">
	<div class="media">
		<!-- user image -->
		<a class="pull-left" href="<?= base_url('profile/user_name') ?>">
			<img class="media-object thumbnail my-thumb" src="<?= base_url('assets/img/default-user-image.png') ?>">
		</a>
		<div class="media-body">
			<h4 class="media-haeading">Post Title</h4>
			<p class="text-right"><a href="<?= base_url('profile/user_name') ?>">User name</a></p>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
			Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
			dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
			Aliquam in felis sit amet augue.</p>
			<ul class="list-inline list-unstyled">
				<li><span><i class="glyphicon glyphicon-calendar"></i> Date-time </span></li>
				<li>|</li>
					<span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
				<li>|</li>
				<li>
					<!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
					<span onclick="like()"><i class="fa fa-thumbs-up"></i></span>
				</li>
			</ul>
		</div>
	</div>
</div>

