<?php if(empty($posts)): ?>
	<h3 class="text-center">Публикаций не найдено</h3>
<?php else: ?>
	<div class="posts text-center">
		<?php foreach ($posts as $post): ?>
			<h4><a href="/article/<?=$post->id;?>"><?=$post->title;?></a></h4>
			<h5><?=$post->created_at;?></h5>
			<hr>
		<?php endforeach ?>
	</div>
<?php endif; ?>
