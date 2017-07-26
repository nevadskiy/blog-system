<section class="auth">
	<div class="container">
		<div class="col-md-12 text-center">
			<form class="login" method="post">
				<h2><legend class="legend sec-header">Регистрация</legend></h2>
				<div class="input form-group has-feedback <?php if(isset($errors['username'])) {echo 'has-error';} else if(Input::exists('username')) {echo 'has-success';}?>">
					<input type="text" class="form-control" name="username" placeholder="Логин" value="<?=Input::escape(Input::get('username'));?>">
					<span class="input-icon"><i class="fa fa-user"></i></span>
					<span class="control-label"><?=@$errors['username'];?></span>
				</div>
				<div class="input form-group has-feedback <?php if(isset($errors['password'])) { echo 'has-error';}?>">
					<input type="password" class="form-control" name="password" placeholder="Пароль" />
					<span class="input-icon"><i class="fa fa-lock"></i></span>
					<span class="control-label"><?=@$errors['password'];?></span>
				</div>
				<div class="input form-group has-feedback <?php if(isset($errors['repassword'])) { echo 'has-error';}?>">
					<input type="password" class="form-control" name="repassword" placeholder="Пароль еще раз" />
					<span class="input-icon"><i class="fa fa-lock"></i></span>
					<span class="control-label"><?=@$errors['repassword'];?></span>
				</div>
				<input class="button" type="submit" name="register" value="Зарегистрироваться">
			</form>
		</div>
	</div>
</section>