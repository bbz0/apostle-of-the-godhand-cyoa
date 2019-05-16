<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
	<div class="container">
		<a class="navbar-brand" href="#">
			<?php echo SITENAME; ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav ml-auto">
				<?php if(isLoggedIn()) : ?>
					<a class="nav-item nav-link" href="<?php echo URLROOT; ?>/apostles/">Apostle</a>
					<a class="nav-item nav-link" href="<?php echo URLROOT; ?>/apostles/logout">Log Out</a>
				<?php else : ?>
					<a class="nav-item nav-link" href="<?php echo URLROOT; ?>">Home</a>
					<a class="nav-item nav-link" href="<?php echo URLROOT; ?>/apostles/login">Log In</a>
					<a class="btn btn-danger" href="<?php echo URLROOT; ?>/apostles/add">Join</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>