<fieldset>
	<legend><?= $team['Team']['name']; ?></legend>
	<ul>
		<?php foreach ($team['Users'] as $user): ?>
		<li><?= $user['username']; ?></li>
		<?php endforeach; ?>
	</ul>
</fieldset>