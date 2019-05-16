<?php require APPROOT . '/views/includes/header.php' ?>
<?php include APPROOT . '/views/includes/nav.php'; ?>
	<section class="cover login text-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mx-auto">
					<h1>Welcome, Apostle</h1>
					<p class="lead">State thy business</p>
					<?php if(!empty($data['error'])) : ?>
						<div class="alert alert-danger">
							<?php echo $data['error']; ?>
						</div>
					<?php endif; ?>
					<form method='POST' action='<?php echo URLROOT; ?>/apostles/login'>
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" id="name">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" class="form-control" id="password">
						</div>
						<input class="btn btn-primary" type="submit" name="submit" value="I Submit">
					</form>	
				</div>
			</div>
		</div>
	</section>
<?php require APPROOT . '/views/includes/footer.php' ?>