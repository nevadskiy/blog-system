<section>
  <div class="container">
   <div class="row">
     <div class="col-md-10 col-md-offset-1">
      <article class="post-block">
        <?php if(!empty($post->post_image)): ?>
          <div class="image-block">
            <a href="/article/<?=$post->id;?>"><img src="/<?=$post->post_image;?>" alt=""></a>
          </div>
        <?php endif; ?>
        <div class="content clearfix">
          <div class="content-head clearfix">
            <div class="post-date"><?=$post->created_at; ?></div>
            <h2 class="post-title"><?=$post->title;?></h2>
          </div>
          <div class="post-content">
            <?=$post->content; ?>
          </div>
          <hr>
          <?php if ($isYourPost): ?>
            <div class="post-footer-menu pull-right">
              <!-- Edit button -->
              <a href="/post/edit/<?=$post->id;?>" class="btn btn-info btn-sm">Edit</a>
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">Delete</button>
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content text-left">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                      <p>You are gonna delete your post</p>
                    </div>
                    <div class="modal-footer">
                      <form action="" method="post">
                        <input type="submit" class="btn btn-danger pull-left" name="delete" value="Delete">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <ul class="post-comments">
            <li><a href="/profile/<?=$post->user_id?>" class="user_icon" title="Users"><i class="fa fa-user"></i><?=$post->username;?></a></li>
            <li><i class="fa fa-bookmark"></i><a href="#"><?=$post->cat_name;?></a></li>
            <li><i class="fa fa-eye" aria-hidden="true"></i><?=$post->views_count;?></li>
            <li>
              <form action="/post/fav" method="post">
                <button class="fa fa-star" name="fav" value="<?=$post->id;?>" style="background-color: transparent; border: none;<?php if (isset($post->isFaved)) {echo "color: red";}?> "></button><?=$post->favs;?>
              </form>
            </li>
          </ul>
        </article>
      </div>
    </div>
  </div>
</section>
<section id="comments">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="profile-block comments-block">
          <?php if(empty($comments)): ?>
            <p>Комментариев еще нет</p>
          <?php else: ?>
            <h3 style="margin-bottom: 20px">Комментарии(<?=count($comments);?>):</h3>
            <hr>
            <?php foreach($comments as $comment): ?>
              <div class="mini-avatar pull-left">
                <img src="/<?php echo $comment->avatar; ?>" alt="">
              </div>
              <div class="comment-block">
              <a class="profile-username" href="/profile/<?=$comment->id;?>">@<?=$comment->username;?>:</a>
              <p class="comment-body"><?=$comment->body;?></p>
              <span><?=$comment->created_at;?></span>
              <hr>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <hr>
        <h2>Комментировать:</h2>
        <form action="/post/article/<?=$post->id;?>" method="post">
          <div class="form-group">
            <textarea style="resize: none" type="text" name="commentbody" class="form-control"></textarea>
          </div>
          <input type="submit" name="comment" class="btn btn-default" vale="Отправить">
        </form>
      </div>
    </div>
  </div>
</div>
</section>