<section>
	<div class="container">
		<?= Alert::getFlash(); ?>
		<?php if (!$resetForm): ?>
			<form class="login text-center" method="post">
				<h2><legend class="legend sec-header">Восстановление пароля</legend></h2>
				<div class="input form-group has-feedback <?php if(isset($errors['email'])) { echo 'has-error';}?>">
					<input type="text" class="form-control" name="email" placeholder="Email..."/>
					<span class="input-icon"><i class="fa fa-envelope-o"></i></span>
					<span class="control-label"><?=@$errors['email'];?></span>
				</div>
				<br>
				<input class="button" type="submit" name="sent" value="Продолжить">
			</form>
		<?php else: ?>
			<form class="login text-center" method="post">
				<h2><legend class="legend sec-header">Сброс пароля</legend></h2>
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
				<br>
				<input class="button" type="submit" name="reset" value="Продолжить">
			</form>
		<?php endif; ?>
		</div>
	</section>