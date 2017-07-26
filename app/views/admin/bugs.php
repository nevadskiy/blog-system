<section>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="text-center">Bug tracker</h2>
			<table class="table bug-table">
				<thead>
					<tr>
						<td>ID</td>
						<td>Name</td>
						<td>Actions</td>
					</tr>
				</thead>
				<?php if (!empty($bugs)): ?>
					<?php 
					$id = 1;
					foreach ($bugs as $bug): 
						?>
				</tr>
				<td><?=$id; $id++;?></td>
				<?php if($bug->done_status): ?>
					<td><strike><?=$bug->name;?><strike></td>
					<td><a href="/admin/bugtracker/<?=$bug->id;?>">Undone</a> / <a href="/admin/bugtracker/<?=$bug->id;?>/delete">X</a></td>
				<?php else: ?>
					<td><?=$bug->name;?></td>
					<td><a href="/admin/bugtracker/<?=$bug->id;?>">Done</a></td>
				<?php endif; ?>
			</tr>
		<?php endforeach ?>
	<?php endif; ?>
</table>
<form class="form-inline" action="/admin/bugtracker" method="post">
	<?php if((isset($this->errors))): ?>
		<p style="color: red"><?=$this->errors['bug'];?></p>
	<?php endif; ?>
	<div class="form-group">
		<label>New bug
			<input name="bug" type="text" class="form-control">
		</label>
	</div>
	<input type="submit" name="register" class="btn btn-default" value="Register">
</form>
</div>
</div>
</section>