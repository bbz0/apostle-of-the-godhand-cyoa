<?php require APPROOT . '/views/includes/header.php' ?>
<?php include APPROOT . '/views/includes/nav.php'; ?>
	<section class="login text-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<p>Welcome to the congregation <?php echo $data['name']; ?></p>
					<p>Your password is:</p> 
					<div class="card">
						<div class="card-body">
							<h1 class="text-danger"><?php echo $data['password']; ?></h1>	
						</div>
					</div>
					<p>remember it well.</p>
					<p>There is only one law:</p>
					<h1>Do As Thou Wilt.</h1>
					<a href="<?php echo URLROOT; ?>"></a>
				</div>
			</div>
		</div>
	</section>
<?php require APPROOT . '/views/includes/footer.php' ?>