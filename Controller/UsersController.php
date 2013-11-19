<?php

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register');
	}

	public function login() {
		if ($this->Auth->user('id')) {
			$this->redirect($this->Auth->redirect());
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Invalid username or password.', 'error');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function password() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $this->Auth->user('id');
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your password has been changed.', 'success');
				$this->redirect(array('controller' => 'runs', 'action' => 'index'));
			} else {
				$this->Session->setFlash('Your password could not be updated.', 'error');
			}
		}
	}

	public function register() {
		if ($this->Auth->user('id')) {
			$this->redirect(array('controller' => 'runs', 'action' => 'home'));
		}

		if (date('Y-m-d') > Configure::read('Contest.signup_deadline')) {
			$this->Session->setFlash('Sorry, registration is closed.', 'error');
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
			exit();
		}

		if ($this->request->is('post')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your account has been created.', 'success');
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			} else {
				$this->Session->setFlash('Account could not be created.', 'error');
			}
		}

		$this->set('teams', ClassRegistry::init('Team')->find('list'));
	}

	public function team() {
		$this->redirect(array('controller' => 'runs', 'action' => 'index'));
		exit();

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $this->Auth->user('id');
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('You have changed teams.', 'success');
				$this->redirect(array('controller' => 'runs', 'action' => 'index'));
			} else {
				$this->Session->setFlash('Could not change teams.', 'error');
			}
		} else {
			$this->request->data = $this->User->read(null, $this->Auth->user('id'));
			$this->set('teams', ClassRegistry::init('Team')->find('list'));
		}
	}

	public function admin_delete($id = null) {
		if (!isset($id)) {
			$this->redirect(array('action' => 'index'));
		}

		if ($this->User->delete($id)) {
			$this->Session->setFlash('User has been deleted.', 'success');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function admin_edit($id = null) {
		if (!isset($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$this->User->id = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('User has been updated.', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('User could not be updated.', 'error');
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
			$this->set('teams', ClassRegistry::init('Team')->find('list'));
		}
	}

	public function admin_index() {
		$this->Paginator->settings = array(
			'order' => array('username' => 'ASC'),
		);

		$this->set('users', $this->paginate());
	}

	public function admin_view($id = null) {
		if (!isset($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$this->set('user', $this->User->read(null, $id));
	}

}
