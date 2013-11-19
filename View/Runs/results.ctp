<?php if (isset($week)): ?>
	<h2><?= $week; ?> Results</h2>
<?php endif; ?>


<ul id="results" class="nav nav-tabs">
<?php $i = 1; ?>
<?php foreach ($teams as $id => $name): ?>
	<?= ($i == 1) ? '<li class="active">' : '<li>'; ?>
		<a href="#<?= $id; ?>" data-toggle="tab"><?= $name; ?></a>
	</li>
	<?php $i++; ?>
<?php endforeach; ?>
</ul>

<div class="tab-content">
<?php $i = 1; ?>
<?php foreach ($results as $id => $users): ?>
	<?php $class = ($i == 1) ? 'tab-pane active' : 'tab-pane'; ?>
	<div class="<?= $class; ?>" id="<?= $id; ?>">
		<table class="table table-striped table-results">
			<?php $j = 1; ?>
			<?php foreach ($users as $user): ?>
			<tr>
				<td class="right"><?= $j; ?></td>
				<td><?= $user['username']; ?></td>
				<td class="right"><?= $user['score']; ?></td>
			</tr>
			<?php $j++; ?>
			<?php endforeach; ?>
		</table>
	</div>
	<?php $i++; ?>
<?php endforeach; ?>
</div>
