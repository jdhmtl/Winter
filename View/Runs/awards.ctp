<?php if (isset($week)): ?>
	<h2><?= $week; ?> Awards</h2>
<?php endif; ?>

<div class="span3">
	<table class="table table-striped">
		<thead>
			<tr>
				<th colspan="3" class="text-info">Coldest Run</th>
			</tr>
		</thead>
		<tr>
			<th></th>
			<th>User</th>
			<th>Score</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($coldest as $cold): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?= $cold['User']['username']; ?></td>
			<td class="right"><?= $cold[0]['temperature']; ?></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</div>

<div class="span3 offset1">
	<table class="table table-striped">
		<thead>
			<tr>
				<th colspan="3" class="text-info">Longest Run</th>
			</tr>
		</thead>
		<tr>
			<th></th>
			<th>User</th>
			<th>Score</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($longest as $long): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?= $long['User']['username']; ?></td>
			<td class="right"><?= $long[0]['duration']; ?></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</div>

<div class="span3 offset1">
	<table class="table table-striped">
		<thead>
			<tr>
				<th colspan="3" class="text-info">Highest Points</th>
			</tr>
		</thead>
		<tr>
			<th></th>
			<th>User</th>
			<th>Score</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($highest as $high): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?= $high['User']['username']; ?></td>
			<td class="right"><?= $high[0]['score']; ?></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</div>
