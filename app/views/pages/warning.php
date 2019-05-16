<?php require APPROOT . '/views/includes/header.php' ?>

	<section class="warning cover bg-secondary text-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<h1 class="display-4 text-center">WARNING</h1>
					<p class="lead">This site contains themes and images from the Japanese comic series 'Berserk', written and illustrated by Kentaro Miura. The images or themes in this site contain nudity, violence, and anti-Christian themes. If you are at work, or below 18 then do not proceed. This site is merely a tool for fans of the comic series for efficient character creation for use in various pen-and-paper role-playing games. This site does not, in any way, promote said themes contained herein. By clicking 'I understand', you are acknowledging that you are Above 18, not at work, or are in a private place where other people cannot see your monitor, and not easily offended by anti-Christian themes. </p>

					<?php if(!empty($data['Error'])) : ?>
						<div class="alert alert-danger">
							<?php echo $data['Error']; ?>
						</div>
					<?php endif; ?>

					<form action="<?php echo URLROOT; ?>/pages/warning" method="post">
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input warning" id="acknowledge " name="acknowledge" value="acknowledged">
							<label class="form-check-label" for="acknowledge">I understand</label>
						</div>
						<input class="btn btn-danger btn-lg" type="submit" name="submit" value="Proceed">
					</form>
				</div>
			</div>
		</div>
	</section>

<?php require APPROOT . '/views/includes/footer.php' ?>