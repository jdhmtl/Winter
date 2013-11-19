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

	<div class="<?= (is_null($this->Form->error('username'))) ? 'control-group' : 'control-group error'; ?>">
		<label class="control-label">Username</label>
		<div class="controls">
			<?= $this->Form->input('username'); ?>
			<?php if (!is_null($this->Form->error('username'))): ?>
			<?= $this->Form->error('username', null, array('class' => 'help-inline', 'wrap' => 'span')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="<?= (is_null($this->Form->error('password'))) ? 'control-group' : 'control-group error'; ?>">
		<label class="control-label">Password</label>
		<div class="controls">
			<?= $this->Form->input('password'); ?>
			<?php if (!is_null($this->Form->error('password'))): ?>
			<?= $this->Form->error('password', null, array('class' => 'help-inline', 'wrap' => 'span')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="<?= (is_null($this->Form->error('password_confirm'))) ? 'control-group' : 'control-group error'; ?>">
		<label class="control-label">Confirm Password</label>
		<div class="controls">
			<?= $this->Form->input('password_confirm', array('type' => 'password')); ?>
			<?php if (!is_null($this->Form->error('password_confirm'))): ?>
			<?= $this->Form->error('password_confirm', null, array('class' => 'help-inline', 'wrap' => 'span')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Team</label>
		<div class="controls">
			<?= $this->Form->input('team_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<?= $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Register')); ?>
		</div>
	</div>
</div>