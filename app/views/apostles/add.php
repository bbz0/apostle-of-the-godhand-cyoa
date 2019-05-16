<?php require APPROOT . '/views/includes/header.php' ?>
<?php include APPROOT . '/views/includes/nav.php'; ?>
<div class="container">
	<form action='<?php echo URLROOT; ?>/apostles/add' method='post' >
		<?php foreach($data['formGroup'] as $formGroup) : ?>
			<div class="form-group mt-5">
				<h4><?php echo $formGroup->title; ?></h4>
				<p><?php echo $formGroup->text; ?></p>
				<?php if(!empty($formGroup->error)) : ?>
					<div class="alert alert-danger">
						<?php echo $formGroup->error; ?>
					</div>
				<?php endif; ?>
				<?php if($formGroup->category == 'spawn') : ?>
					<?php if(!empty($data['spawnFormError'])) : ?>
						<div class="alert alert-danger">
							<?php echo $data['spawnFormError']; ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<div class="row">
					<?php foreach($data['formData'] as $formData) : ?>
						<?php if($formGroup->category == $formData->category) : ?>
							<div class="col-md-4">
								<div class="card mt-3 choice-card" data-toggle="tooltip" data-placement="right" title="<?php echo $formData->description; ?>">
									<img class="card-img-top cat-img" src="<?php echo URLROOT . '/img/' . $formData->images ?>.jpg">
									<div class="card-body">
										<h5 class="card-title text-center"><?php echo $formData->title; ?></h5>
											<?php if($formGroup->formType == 'checkbox') : ?>
												<?php if($formGroup->category == 'abyssalAbilities') : ?>
													<input type="<?php echo $formGroup->formType; ?>" name="<?php echo $formGroup->category; ?>[]" value="<?php echo $formData->value; ?>" class="ability-choice abyssal">
												<?php else : ?>
													<input type="<?php echo $formGroup->formType; ?>" name="<?php echo $formGroup->category; ?>[]" value="<?php echo $formData->value; ?>" class="ability-choice">
												<?php endif; ?>
											<?php else : ?>
												<input type="<?php echo $formGroup->formType; ?>" name="<?php echo $formGroup->category; ?>" value="<?php echo $formData->value; ?>">
											<?php endif; ?>
											<!-- <?php echo $formData->description; ?> -->
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php if($formGroup->category == 'spawn' && $formData->category == 'spawnForm') : ?>
							<div class="col-md-4">
								<div class="card mt-3 choice-card" data-toggle="tooltip" data-placement="right" title="<?php echo $formData->description; ?>">
									<img class="card-img-top cat-img" src="<?php echo URLROOT . '/img/' . $formData->images ?>.jpg">
									<div class="card-body">
										<h5 class="card-title text-center"><?php echo $formData->title; ?></h5>
										<input type="<?php echo $formGroup->formType; ?>" name="spawnForm" value="<?php echo $formData->value; ?>">
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					<?php if($formGroup->category == 'apostleName') : ?>
						<input type="<?php echo $formGroup->formType; ?>" class="form-control" name="<?php echo $formGroup->category; ?>">
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="form-group">
			<p>It is done. Now, say the words.</p>
			<input class="btn btn-danger" type="submit" name="submit" value="I sacrifice thee">
		</div>
	</form>
</div>
<?php require APPROOT . '/views/includes/footer.php' ?>