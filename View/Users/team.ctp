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

	<p class="span8 offset1 text-info">
		Please note that, as there are actual prizes this year and in the interest of keeping things fair,
		this option is only available until December 1. Once registration closes, you may no longer change teams.
	</p>
	<div class="control-group">
		<label class="control-label">Team</label>
		<div class="controls">
			<?= $this->Form->input('team_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<?= $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Change Team')); ?>
		</div>
	</div>
</div>