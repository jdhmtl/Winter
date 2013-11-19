<div id="register" class="span10">

<?=
	$this->Form->create('User', array(
		'class' => 'form-horizontal',
		'inputDefaults' => array(
			'div'   => false,
			'error' => false,
			'label' => false,
		)
	));
?>
	<div class="control-group">
		<label class="control-label">Username</label>
		<div class="controls">
			<?= $this->Form->input('username'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Password</label>
		<div class="controls">
			<?= $this->Form->input('password'); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<?= $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Login')); ?>
		</div>

	</div>
	<div class="span6 offset2">
		<p>
			Not signed up? <?= $this->Html->link('Click here to register', array('controller' => 'users', 'action' => 'register')); ?>
		</p>
	</div>

</div>