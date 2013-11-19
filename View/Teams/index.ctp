<ul id="rosters" class="nav nav-tabs">
<?php $i = 1; ?>
<?php foreach ($teams as $team): ?>
	<?= ($i == 1) ? '<li class="active">' : '<li>'; ?>
		<a href="#<?= $team['Team']['id']; ?>" data-toggle="tab"><?= $team['Team']['name']; ?></a>
	</li>
	<?php $i++; ?>
<?php endforeach; ?>
</ul>

<div class="tab-content">
<?php $i = 1; ?>
<?php foreach ($teams as $team): ?>
	<?php $class = ($i == 1) ? 'tab-pane active' : 'tab-pane'; ?>
	<div class="<?= $class; ?>" id="<?= $team['Team']['id']; ?>">
		<table class="table table-striped">
			<?php foreach ($team['User'] as $user): ?>
			<tr><td><?= $user['username']; ?></td></tr>
			<?php endforeach; ?>
		</table>
	</div>
	<?php $i++; ?>
<?php endforeach; ?>
</div>