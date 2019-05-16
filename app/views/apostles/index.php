<?php require APPROOT . '/views/includes/header.php' ?>
<?php include APPROOT . '/views/includes/nav.php'; ?>
	<section class="show">
		<div class="container">

			<div class="text-white">
				<h1 class="display-4">Welcome, <?php echo $data['name']; ?>.</h1>
				<p class="lead">Know thyself.</p>
			</div>

			<?php foreach($data as $dat) : ?>

				<?php if(!empty($dat->title) && !empty($dat->catTitle) && !empty($dat->catTitle) && !empty($dat->description) && !empty($dat->images)) : ?>

					<div class="card mt-3 bg-secondary text-white">
						<h5 class="card-header">Your <?php echo $dat->catTitle; ?></h5>
						<ul class="list-group list-group-flush">
							<li class="list-group-item bg-dark">
								<div class="row no-gutters">
									<div class="col-md-2">
										<img class="card-img" src="<?php echo URLROOT . '/img/' . $dat->images . '.jpg'; ?>">
									</div>
									<div class="col-md-10">
										<div class="card-body">
											<h3 class="card-title"><?php echo $dat->title; ?></h3>
											<p class="card-text"><?php echo $dat->description; ?></p>
										</div>	
									</div>
								</div>
							</li>
							<?php if($dat === $data['spawn']) : ?>
								<li class="list-group-item bg-dark">
									<div class="row no-gutters">
										<div class="col-md-2">
											<img class="card-img" src="<?php echo URLROOT . '/img/' . $data['spawnForm']->images . '.jpg'; ?>">
										</div>
										<div class="col-md-10">
											<div class="card-body">
												<h3 class="card-title"><?php echo $data['spawnForm']->title; ?></h3>
												<p class="card-text"><?php echo $data['spawnForm']->description; ?></p>
											</div>	
										</div>
									</div>
								</li>
							<?php endif; ?>
						</ul>
						<div class="row no-gutters">
						</div>
					</div>

				<?php elseif(is_array($dat)) : ?>

					<div class="card bg-secondary text-white mt-3">
						<h5 class="card-header">Your <?php echo $dat[0]->catTitle; ?></h5>
						<ul class="list-group list-group-flush">
						<?php foreach($dat as $ability) : ?>
							<li class="list-group-item bg-dark text-white">
								<div class="row no-gutters">
									<div class="col-md-2">
										<img class="card-img" src="<?php echo URLROOT . '/img/' . $ability->images . '.jpg'; ?>">
									</div>
									<div class="col-md-10">
										<div class="card-body">
											<h3 class="card-title"><?php echo $ability->title; ?></h3>
											<p class="card-text"><?php echo $ability->description; ?></p>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

			<?php endforeach; ?>

		</div>
	</section>
<?php require APPROOT . '/views/includes/footer.php' ?>