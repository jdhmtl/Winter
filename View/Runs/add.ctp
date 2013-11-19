<?=
	$this->Form->create('Run', array(
		'class' => 'form-horizontal',
		'inputDefaults' => array(
			'div'   => false,
			'error' => false,
			'label' => false,
		)
	));
?>

<fieldset>
	<legend>Log a Run</legend>

	<div class="<?= (is_null($this->Form->error('date'))) ? 'control-group' : 'control-group error'; ?>">
		<label class="control-label">Date</label>
		<div class="controls">
			<div id="runDate" class="input-append date" data-date-format="yyyy-mm-dd" data-date="<?= date('Y-m-d'); ?>">
				<input class="span2" type="text" name="data[Run][date]" value="<?= date('Y-m-d'); ?>" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
			<?php if (!is_null($this->Form->error('date'))): ?>
			<?= $this->Form->error('date', null, array('class' => 'help-inline', 'wrap' => 'span')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="<?= (is_null($this->Form->error('duration'))) ? 'control-group' : 'control-group error'; ?>">
		<label class="control-label">Duration (in minutes)</label>
		<div class="controls">
			<?= $this->Form->input('duration'); ?>
			<?php if (!is_null($this->Form->error('duration'))): ?>
			<?= $this->Form->error('duration', null, array('class' => 'help-inline', 'wrap' => 'span')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="<?= (is_null($this->Form->error('temperature'))) ? 'control-group' : 'control-group error'; ?>">
		<label class="control-label">Feels Like (&deg;F)</label>
		<div class="controls">
			<?= $this->Form->input('temperature'); ?>
			<?php if (!is_null($this->Form->error('temperature'))): ?>
			<?= $this->Form->error('temperature', null, array('class' => 'help-inline', 'wrap' => 'span')); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Weather</label>
		<div class="controls">
			<?= $this->Form->input('weather', array('options' => array('None', 'Rain', 'Snow', 'Sleet', 'Hail'))); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<?= $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Save')); ?>
		</div>

	</div>
</fieldset>

<script type="text/javascript">
	$('#runDate').datepicker();
</script>
