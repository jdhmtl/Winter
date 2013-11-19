<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	protected $start_date;
	protected $end_date;

	public $components = array(
		'Auth' => array(
			'authorize' => array('Controller'),
			'loginRedirect' => array('controller' => 'runs', 'action' => 'index', 'admin' => false),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display'),
		),
		'Paginator',
		'Session',
	);

	public function beforeFilter() {
		parent::beforeFilter();

		$this->start_date = Configure::read('Contest.start');
		$this->end_date   = Configure::read('Contest.end');

		$this->set('logged_in', $this->Auth->loggedIn());
		$this->set('is_admin', $this->Auth->user('role'));
	}

	public function isAuthorized($user) {
		if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
			if ($user['role'] > 0) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

}
