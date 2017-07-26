<section>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="text-center">Users-list</h2>
			<table class="table bug-table">
				<thead>
					<tr>
						<td>ID</td>
						<td>Name</td>
						<td>Actions</td>
					</tr>
				</thead>
				<?php if (!empty($users)): ?>
					<?php  foreach ($users as $user): ?>
					</tr>
					<td><?=$user->id;?></td>
					<td><a href="/profile/<?=$user->id;?>" style="color:#a1a1f0; font-weight: 800;"><?=$user->username;?></a></td>
					</tr>
					<?php endforeach ?>
				<?php endif; ?>
			</table>
		</div>
	</div>
</section>