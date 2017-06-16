<p>Index</p>
	<table>
	<?php foreach ($this->users as $user): ?>
	<tr>
		<td><?php echo $user['id']; ?></td><td><?php echo $user['data']; ?></td>
	</tr>
	<?php endforeach; ?>
	</table>