<div class="container">
	<div class="col-md-8 col-md-offset-2 text-center">
		<form method="post">
			<?php foreach ($categories as $cat): ?>
				<div>
					<input type="text" name="category[<?php echo $cat->id?>];" value="<?=$cat->name; ?>">
				</div>
			<?php endforeach; ?>
			<input type="submit" name="save" class="btn btn-default" value="Register">
		</form>
	</div>
</div>