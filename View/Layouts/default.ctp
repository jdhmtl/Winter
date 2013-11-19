<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset(); ?>
		<title>Winter Running Contest</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
		<link   type="text/css"       href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap.min.css" rel="stylesheet" />
		<link   type="image/png"      href="favicon.png" rel="icon" />
		<?= $this->Html->css(array('style', 'datepicker')); ?>
	</head>
	<body>
		<?php if ($logged_in): ?>
		<?= $this->element('nav'); ?>
		<?php endif; ?>
		<?= $this->Session->flash(); ?>
		<div class="container">
			<?= $this->fetch('content'); ?>
		</div>
		<?php if (Configure::read('debug') == 2) {
			// echo $this->element('sql_dump');
		} ?>
	</body>
</html>