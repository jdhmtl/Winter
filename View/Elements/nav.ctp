<div class="navbar">
	<div class="navbar-inner">
		<ul class="nav">
			<li class="<?= ($this->request->params['controller'] == 'runs' && $this->request->params['action'] == 'index') ? 'active' : ''; ?>"><?= $this->Html->link('Home', array('controller' => 'runs', 'action' => 'index', 'admin' => false)); ?></li>
			<li class="<?= ($this->request->params['controller'] == 'runs' && $this->request->params['action'] == 'add') ? 'active' : ''; ?>"><?= $this->Html->link('Log a Run', array('controller' => 'runs', 'action' => 'add', 'admin' => false)); ?></li>
			<li class="<?= ($this->request->params['controller'] == 'teams' && $this->request->params['action'] == 'index') ? 'active' : ''; ?>"><?= $this->Html->link('Rosters', array('controller' => 'teams', 'action' => 'index', 'admin' => false)); ?></li>
			<li class="<?= ($this->request->params['controller'] == 'runs' && $this->request->params['action'] == 'results') ? 'active' : ''; ?>"><?= $this->Html->link('Results', array('controller' => 'runs', 'action' => 'results', 'admin' => false)); ?></li>
			<li class="<?= ($this->request->params['controller'] == 'runs' && $this->request->params['action'] == 'awards') ? 'active' : ''; ?>"><?= $this->Html->link('Awards', array('controller' => 'runs', 'action' => 'awards', 'admin' => false)); ?></li>
			<li class="<?= ($this->request->params['controller'] == 'runs' && $this->request->params['action'] == 'leaderboard') ? 'active' : ''; ?>"><?= $this->Html->link('Leaderboard', array('controller' => 'runs', 'action' => 'leaderboard', 'admin' => false)); ?></li>
			<li class="<?= ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'password') ? 'active' : ''; ?>"><?= $this->Html->link('Change My Password', array('controller' => 'users', 'action' => 'password', 'admin' => false)); ?></li>
		</ul>
		<ul class="nav pull-right">
			<?php if ($is_admin): ?>
			<li class="<?= (isset($this->request->params['admin']) && $this->request->params['admin'] == true) ? 'active' : ''; ?>"><?= $this->Html->link('User Admin', array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?></li>
			<?php endif; ?>
			<li><?= $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout', 'admin' => false)); ?></li>
		</ul>
	</div>
</div>
