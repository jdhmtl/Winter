<?= $this->Form->create('User'); ?>

<fieldset>
	<legend>Update Team</legend>
	<?= $this->Form->input('team_id', array('label' => false)); ?>
</fieldset>

<?= $this->Form->end(array('label' => 'Save', 'class' => 'btn btn-primary btn-large')); ?>

<?= $this->Form->create('User'); ?>
<fieldset>
	<legend>Update Password</legend>
	<?= $this->Form->input('password'); ?>
	<?= $this->Form->input('password_confirm', array('type' => 'password', 'label' => 'Confirm Password')); ?>
</fieldset>
<?= $this->Form->end(array('label' => 'Save', 'class' => 'btn btn-primary btn-large')); ?>
