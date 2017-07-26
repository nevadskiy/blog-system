<section>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<?php if ($posts): ?>
					<?php foreach($posts as $post): ?>
						<article class="post-block">
							<?php if(!empty($post->post_image)): ?>
								<div class="image-block">
									<a href="/article/<?=$post->id;?>"><img src="/<?=$post->post_image;?>" alt=""></a>
								</div>
							<?php endif; ?>
							<div class="content">
								<div class="content-head clearfix">
									<div class="post-date"><?=$post->created_at; ?></div>
									<h2 class="post-title"><a href="/article/<?=$post->id;?>"><?=$post->title;?></a></h2>
								</div>
								<?=$post->description; ?>
								<div class="text-center">
									<a href="/article/<?=$post->id;?>" class="read-more">Read more</a>
								</div>
								<div class="post-comments">
									<ul>
										<li><a href="/profile/<?=$post->user_id?>" class="user_icon" title="Users"><i class="fa fa-user"></i><?=$post->username;?></a></li>
										<li><i class="fa fa-bookmark"></i><a href="/post/category/<?=$post->category_id;?>"><?=$post->cat_name;?></a></li>
										<li><a href="/article/<?=$post->id;?>#comments" class="comment_icon" title="Comments"><i class="fa fa-comment"></i><?=$post->comments;?></a></li>
										<li><i class="fa fa-eye" aria-hidden="true"></i><?=$post->views_count;?></li>
										<li>
											<form action="/post/fav" method="post">
												<button class="fa fa-star" name="fav" value="<?=$post->id;?>" style="background-color: transparent; border: none;<?php if (isset($post->isFaved)) {echo "color: red";}?> "></button><?=$post->favs;?>
											</form>
										</li>
									</ul>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				<?php else: ?>
					<h3 class="text-center">Публикаций не найдено :(</h3>
				<?php endif; ?>
			</div>
			<!-- aside -->
			<div class="col-md-3">
				<aside>
					<figure class="aside-block category-list">
						<i class="fa fa-bookmark"></i>
						<h2>Категории</h2>
						<ul>
							<?php foreach ($categories as $c): ?>
								<li><a <?php if($_SERVER['REQUEST_URI'] == '/post/category/' . $c->id) { echo 'class="active-category"'; } ?> href="/post/category/<?=$c->id;?>"><?=$c->name;?> (<?=$c->count;?>)</a></li>
							<?php endforeach; ?>
						</ul>
					</figure>
				</aside>
			</div>
		</div>
	</div>
</section>