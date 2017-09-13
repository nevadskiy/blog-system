<form method="post" enctype="multipart/form-data">
    <div class="form-group has-feedback <?php if(isset($errors['title'])) {echo 'has-error';} else if(Input::exists('title')) {echo 'has-success';}?>">
        <label>Название</label>
        <input type="text" class="form-control" name="title" placeholder="Название..." value="<?php if (Input::exists('title')) {echo Input::get('title', true);} else { echo @$post->title;} ?>">
        <span class="control-label"><?=@$errors['title'];?></span>
    </div>
    <div class="form-group">
        <label for="sel1">Категория:</label>
        <select class="form-control" name="category" id="sel1">
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat->name; ?>"<?php if (isset($post->cat_name) && ($post->cat_name == $cat->name)) {echo 'selected';} ?>><?= $cat->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group has-feedback <?php if(isset($errors['file'])) {echo 'has-error';}?>">
        <label class="image-block" for="exampleInputFile">
            Изображение
            <?php if(!empty($post->post_image)): ?>
                <div><img src="/<?=$post->post_image;?>" alt=""></div>
            <?php endif; ?>
        </label>
        <!-- 10 MB (1024 * 1024 * 10) -->
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <input type="file" name="post-image[]" id="exampleInputFile">
        <p class="help-block">К публикакции можно прикрепить изображение (до 10 мегабайт)</p>
        <span class="control-label"><?=@$errors['file'];?></span>
    </div>
    <div class="text-editor form-group has-feedback <?php if(isset($errors['content'])) {echo 'has-error';}?>">
        <label>Содержание:</label>
        <textarea class="tinymce" name="content">
            <?php if(Input::exists('content')) {echo Input::get('content');} else {echo @$post->content;}
            ?>
        </textarea>
        <span class="control-label"><?=@$errors['content'];?></span>
    </div>
    <input type="submit" name="save" class="btn btn-default" value="Сохранить">
</form>