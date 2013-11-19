<fieldset>
	<legend>Users</legend>
	<table class="table table-striped table-hover">
		<tr>
			<th><?= $this->Paginator->sort('username'); ?></th>
			<th><?= $this->Paginator->sort('Team.name', 'Team'); ?></th>
			<th>Actions</th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?= $user['User']['username']; ?></td>
			<td><?= $user['Team']['name']; ?></td>
			<td>
				<?= $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>
				<?= $this->Html->link('Delete', array('controller' => 'users', 'action' => 'delete', $user['User']['id'])); ?>
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

</fieldset>