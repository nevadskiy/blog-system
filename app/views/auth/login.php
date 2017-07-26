<section class="auth">
	<div class="container">
		<div class="col-md-12 text-center">
			<div style="width: 450px; margin: 0 auto">
				<?=Alert::getFlash();?>
			</div>
			<form class="login" method="post">
				<h2><legend class="legend sec-header">Вход</legend></h2>
				<div class="input form-group has-feedback <?php if(isset($errors['username'])) {echo 'has-error';} else if(Input::exists('username')) {echo 'has-success';}?>">
					<input type="text" class="form-control" placeholder="Логин" id="username" name="username"/>
					<span class="input-icon"><i class="fa fa-user"></i></span>
					<span class="control-label"><?=@$errors['username'];?></span>
				</div>
				<div class="input form-group has-feedback <?php if(isset($errors['password'])) { echo 'has-error';}?>">
					<input type="password" class="form-control" id="password" name="password" placeholder="Пароль"/>
					<span class="input-icon"><i class="fa fa-lock"></i></span>
					<span class="control-label"><?=@$errors['password'];?></span>
				</div>
				<div class="form-links clearfix">
					<div class="checkbox pull-left remember-me">
						<label><input name="remember" type="checkbox">Запомнить меня</label>
					</div>
					<a class="recovery-link pull-right" href="/auth/recovery">Забыли пароль?</a>
				</div>
				<br>
				<input class="button" type="submit" name="login" value="Войти">
			</form>
		</div>
	</div>
</section>