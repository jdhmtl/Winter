<?php

Router::connect('/', array('controller' => 'runs', 'action' => 'index'));

Router::connect('/register', array('controller' => 'users', 'action' => 'register'));
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/password', array('controller' => 'users', 'action' => 'password'));
Router::connect('/team', array('controller' => 'users', 'action' => 'team'));

Router::connect('/awards/week/:week', array('controller' => 'runs', 'action' => 'awards'));
Router::connect('/awards', array('controller' => 'runs', 'action' => 'awards'));

Router::connect('/results/week/:week', array('controller' => 'runs', 'action' => 'results'));
Router::connect('/results', array('controller' => 'runs', 'action' => 'results'));

Router::connect('/leaderboard', array('controller' => 'runs', 'action' => 'leaderboard'));

Router::connect('/rosters', array('controller' => 'teams', 'action' => 'index'));

Router::connect('/admin/:controller/:action/*', array('prefix' => 'admin', 'admin' => true));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
