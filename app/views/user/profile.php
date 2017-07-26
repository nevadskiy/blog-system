<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3 profile-block">
				<div class="profile-avatar">
					<img src="/<?=$profile->avatar;?>" alt="">
				</div>
				<?php if ($isYourProfile): ?>
					<a href="/profile/edit" class="edit-button btn btn-primary">Редактировать профиль</a>
				<?php endif; ?>
			</div>
			<div class="col-md-9">
				<div class="profile-block profile-main clearfix">
					<div class="col-md-7">
						<div class="profile-info">
							<?php if (!empty($profile->first_name) OR !empty($profile->last_name)): ?>
								<p class="profile-name">Полное имя: <?=$profile->first_name . ' ' . $profile->last_name;?> <?php if ($isYourProfile) echo '(Это вы)'; ?></p>
							<?php endif; ?>
							<span class="profile-name">Имя пользователя: 
								<a <?php if (empty($profile->first_name) OR empty($profile->last_name)) echo 'class="profile-name"'; ?> href="/profile/<?=$profile->id;?>" class="profile-username">@<?=$profile->username;?></a></span>
								<?php if (!empty($profile->email)): ?>
									<p class="profile-name">Email: <?php echo $profile->email; ?></p>
								<?php endif; ?>
								<ul class="user-buttons">
									<li><a href="/profile/posts/<?=$profile->id; ?>" class="btn btn-info" href="">Публикации (<?php echo $counts->count_posts; ?>)</a></li>
									<li><a class="btn btn-info" href="/profile/comments/<?=$profile->id; ?>">Комментарии (<?php echo $counts->count_comments; ?>)</a></li>
									<li><a class="btn btn-info" href="/profile/favs/<?=$profile->id; ?>">Избранные (<?php echo $counts->count_favs; ?>)</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-5">
							<div class="border">
								<h4 class="text-center">Информация</h4>
								<p>Город: <?php echo $profile->city; ?></p>
								<p>Дата рождения: <?php echo $profile->birth_day;?></p>
								<p>Зарегистрирован: <?=$profile->created_at;?></p>
								<?php if ($online): ?>
									<p class="online-status">В сети</p>
								<?php else: ?>
									<p>Был в сети: <?=$profile->last_activity;?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php if (!empty($layout)): ?>
						<div class="profile-block  profile-main">
							<?php require $layout; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>