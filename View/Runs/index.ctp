<fieldset>
	<legend>Home</legend>
	<?= $this->Html->link('Log a Run', array('controller' => 'runs', 'action' => 'add'), array('class' => 'btn btn-primary btn-large')); ?>

	<?php if (!empty($runs)): ?>

	<table id="home" class="table table-striped table-hover">
		<tr>
			<th><?= $this->Paginator->sort('date'); ?></th>
			<th><?= $this->Paginator->sort('temperature'); ?></th>
			<th><?= $this->Paginator->sort('weather'); ?></th>
			<th><?= $this->Paginator->sort('duration'); ?></th>
			<th><?= $this->Paginator->sort('score'); ?></th>
			<th>Actions</th>
		</tr>
		<?php foreach ($runs as $run): ?>
		<tr>
			<td><?= $run['Run']['date']; ?></td>
			<td><?= $run['Run']['temperature']; ?></td>
			<td><?= $weather[$run['Run']['weather']]; ?></td>
			<td><?= $run['Run']['duration']; ?></td>
			<td><?= $run['Run']['score']; ?></td>
			<td>
				<?= $this->Html->link('Edit', array('controller' => 'runs', 'action' => 'edit', $run['Run']['id'])); ?>
				<?= $this->Html->link('Delete', array('controller' => 'runs', 'action' => 'delete', $run['Run']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

	<div class="pagination pagination-right">
		<ul>
		<?= $this->Paginator->numbers(array(
			'currentClass' => 'active',
			'currentTag' => 'a',
			'separator' => false,
			'tag' => 'li',
		)); ?>
		</ul>
	</div>

	<?php endif; ?>
</fieldset>
