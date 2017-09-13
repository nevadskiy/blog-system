<section>
	<div class="container">
		<h2 style="margin-bottom: 20px" class="text-center">Дополнительная информация</h2>
		<?php require Config::get('path/views') . '/templates/parts/edit-profile-aside.php'; ?>
		<div class="col-md-6">
			<form method="post" enctype="multipart/form-data">
				<div class="form-group has-feedback <?php if(isset($errors['first_name'])) {echo 'has-error';} else if(Input::exists('first_name')) {echo 'has-success';}?>">
					<label class="control-label">Имя</label>
					<input type="text" class="form-control" name="first_name" placeholder="Имя..." value="<?php if (Input::exists('first_name')) {echo Input::get('first_name', true);} else { echo $profileInfo->first_name;} ?>">
					<span class="control-label"><?=@$errors['first_name'];?></span>
				</div>
				<div class="form-group has-feedback <?php if(isset($errors['last_name'])) {echo 'has-error';} else if(Input::exists('last_name')) {echo 'has-success';}?>">
					<label class="control-label">Фамилия</label>
					<input type="text" class="form-control" name="last_name" placeholder="Фамилия..." value="<?php if (Input::exists('last_name')) {echo Input::get('last_name', true);} else { echo $profileInfo->last_name;} ?>">
					<span class="control-label"><?=@$errors['last_name'];?></span>
				</div>
				<div class="form-group has-feedback <?php if(isset($errors['birthday'])) { echo 'has-error';}?>">
					<label class="control-label">Дата рождения</label>
					<input type="date" name="birthday" class="form-control" value="<?php echo $profileInfo->birth_day; ?>">
					<span class="control-label"><?=@$errors['birthday'];?></span>
				</div>
				<div class="form-group has-feedback <?php if(isset($errors['city'])) { echo 'has-error';}?>">
					<label class="control-label">Город</label>
					<input type="text" name="city" class="form-control" placeholder="Город..." value="<?php echo $profileInfo->city; ?>">
					<span class="control-label"><?=@$errors['city'];?></span>
				</div>
				<input type="submit" name="save" class="btn btn-primary save-button" value="Сохранить">
			</form>
		</div>
	</div>
</section>