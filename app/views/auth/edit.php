<section>
	<div class="container">
		<h2 style="margin-bottom: 20px" class="text-center">Настройки аккаунта</h2>
		<?php require Config::get('path/views') . '/templates/parts/edit-profile-aside.php'; ?>
		<div class="col-md-6">
			<form method="post">
				<h4>Email</h4>
				<div class="form-group has-feedback <?php if(isset($errors['email'])) { echo 'has-error';}?>">
					<input type="text" name="email" class="form-control" id="InputPassword" placeholder="Email..." value="<?php if (Input::exists('email')) {echo Input::get('email', true);} else { echo $profileInfo->email;} ?>">
					<span class="control-label"><?=@$errors['email'];?></span>
				</div>
				<input type="submit" name="update-email" style="width: 100%" class="btn btn-primary" value="Сохранить">
			</form>
			<form method="post" enctype="multipart/form-data" class="profile-update-form">
				<div class="form-group has-feedback <?php if(isset($errors['file'])) {echo 'has-error';}?>">
					<label class="image-block" for="exampleInputFile">
						Аватар
						<?php if(!empty($profileInfo->avatar)): ?>
							<div><img class="avatar-image" src="/<?=$profileInfo->avatar;?>" alt=""></div>
						<?php endif; ?>
					</label>
					<!-- 5 MB (1024 * 1024 * 5) -->
					<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
					<input type="file" name="avatar[]" id="exampleInputFile">
					<p class="help-block">Можно прикреплять изображения до 5 мегабайт)</p>
					<span class="control-label"><?=@$errors['file'];?></span>
				</div>
				<input type="submit" name="save" class="btn btn-primary save-button" value="Сохранить">
			</form>
			<form method="post" class="profile-update-form">
				<h4 class="text-center">Смена логина</h4>
				<div class="form-group has-feedback <?php if(isset($errors['username'])) { echo 'has-error';}?>">
					<input type="text" name="username" class="form-control" id="InputPassword" placeholder="Логин..." value="<?php if (Input::exists('username')) {echo Input::get('username', true);} else { echo $profileInfo->username;} ?>">
					<span class="control-label"><?=@$errors['username'];?></span>
				</div>
				<input type="submit" name="update-login" style="width: 100%" class="btn btn-primary" value="Сохранить">
			</form>
			<form method="post" class="profile-update-form">
				<h4 class="text-center">Смена пароля</h4>
				<div class="form-group has-feedback <?php if(isset($errors['oldpassword'])) { echo 'has-error';}?>">
					<label class="control-label">Текущий пароль</label>
					<input type="password" name="oldpassword" class="form-control" placeholder="Текущий пароль...">
					<span class="control-label"><?=@$errors['oldpassword'];?></span>
				</div>
				<div class="form-group has-feedback <?php if(isset($errors['password'])) { echo 'has-error';}?>">
					<label class="control-label">Новый пароль</label>
					<input type="password" name="password" class="form-control" placeholder="Новый пароль...">
					<span class="control-label"><?=@$errors['password'];?></span>
				</div>
				<div class="form-group has-feedback <?php if(isset($errors['repassword'])) { echo 'has-error';}?>">
					<label class="control-label" for="InputRepassword">Введите пароль еще раз</label>
					<input type="password" name="repassword" class="form-control" id="InputRepassword" placeholder="Новый пароль еще раз...">
					<span class="control-label"><?=@$errors['repassword'];?></span>
				</div>
				<input type="submit" name="update-password" style="width: 100%" class="btn btn-primary" value="Обновить">
			</form>
		</div>
	</div>
</section>