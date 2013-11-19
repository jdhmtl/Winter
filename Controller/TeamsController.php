<?php

class TeamsController extends AppController {
	
	public function index() {
		$this->set('teams', $this->Team->find('all', array(
			'contain' => array(
				'User' => array(
					'fields' => 'username',
					'order' => 'username',
				),
			),
		)));
	}

	public function debug() {
		$user = ClassRegistry::init('User');
		$user->virtualFields['points'] = 0;
		$runs = $user->find('all', array(
			'fields' => array('id', 'username', 'team_id'),
			'contain' => array(
				'Run' => array(
					'conditions' => array(
						'week' => date('W'),
					),
					'fields' => array(
						'SUM(score) AS User__points',
					),
				),
				'Team.name',
			),
			'group' => 'User.username',
			'order' => array(
				'Team.id' => 'ASC',
				'User.username' => 'ASC',
			),
		));
		debug($runs);
		exit();
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash('Team has been created.');
				$this->redirect(array('controller' => 'teams'));
			} else {
				$this->Session->setFlash('Team could not be created.');
			}
		}
	}

	public function admin_delete($id = null) {
		if (!isset($id)) {
			$this->redirect(array('controller' => 'teams'));
		}

		if ($this->Team->delete($id)) {
			$this->Session->setFlash('Team has been deleted.');
			$this->redirect(array('controller' => 'teams'));
		}
	}

	public function admin_edit($id = null) {
		if (!isset($id)) {
			$this->redirect(array('controller' => 'teams', 'action' => 'index'));
		}

		$this->Team->id = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash('Team has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Team could not be updated.');
			}
		} else {
			$this->request->data = $this->Team->read(null, $id);
		}
	}

	public function admin_index() {
		$this->set('teams', $this->paginate());
	}

	public function admin_view($id) {
		if (!isset($id)) {
			$this->redirect(array('controller' => 'teams'));
		}
		
		$this->set('team', $this->Team->read(null, $id));
	}

}