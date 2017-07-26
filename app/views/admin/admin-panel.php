<?php if($user->isAdmin()): ?>
	<div class="admin-panel">
		<div class="container">
		<strong>Admin panel: </strong>
			<a href="/admin/bugtracker">Bug tracker</a> 
			<span> | </span>
			<a href="/admin/users">Users</a>
		</div>
	</div>
<?php endif; ?>