<h2>Teams</h2>
<?= $this->Html->link('Add Team', array('controller' => 'teams', 'action' => 'add')); ?>
<table>
	<tr>
		<th>Name</th>
		<th>Actions</th>
	</tr>
	<?php foreach ($teams as $team): ?>
	<tr>
		<td><?= $team['Team']['name']; ?></td>
		<td>
			<?= $this->Html->link('View', array('controller' => 'teams', 'action' => 'view', $team['Team']['id'])); ?>
			<?= $this->Html->link('Edit', array('controller' => 'teams', 'action' => 'edit', $team['Team']['id'])); ?>
			<?= $this->Html->link('Delete', array('controller' => 'teams', 'action' => 'delete', $team['Team']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>