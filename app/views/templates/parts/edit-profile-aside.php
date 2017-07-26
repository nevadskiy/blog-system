<div class="col-md-3">
	<aside>
		<ul class="edit-profile-aside">
			<li>
				<a <?php if ($_SERVER['REQUEST_URI'] == '/auth/edit') echo 'class="active"' ?> href="/auth/edit">Настройки аккаунта</a>
			</li>
			<li>
				<a  <?php if ($_SERVER['REQUEST_URI'] == '/profile/edit') echo 'class="active"' ?> href="/profile/edit">Дополнительно</a>
			</li>
		</ul>
	</aside>
</div>