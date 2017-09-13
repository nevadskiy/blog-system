<?php if(empty($comments)): ?>
	<h3 class="text-center">Публикаций не найдено</h3>
<?php else: ?>
	<div class="posts text-center">
		<?php foreach ($comments as $c): ?>
			<h4><a href="/article/<?=$c->id;?>"><?=$c->title;?></a></h4>
			<h5>Комментарий: <?=$c->body; ?></h5>
			<h5><?=$c->created_at; ?></h5>
			<hr>
		<?php endforeach ?>
	</div>
<?php endif; ?>