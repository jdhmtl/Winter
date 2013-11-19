<?php

class RunsController extends AppController {
	
	public function add() {
		if (date('Y-m-d') > $this->end_date) {
			$this->Session->setFlash('Contest has ended.', 'error');
			return null;
		}
		if ($this->request->is('post')) {
			$this->Run->create();
			$this->request->data['Run']['user_id'] = $this->Auth->user('id');
			if ($this->Run->save($this->request->data)) {
				$this->Session->setFlash('Run has been saved.', 'success');
				$this->redirect(array('controller' => 'runs', 'action' => 'index'));
			} else {
				$this->Session->setFlash('Run could not be saved.', 'error');
			}
		}
	}

	public function awards() {
		if (isset($this->request->params['week']) && $this->request->params['week'] >= 1 && $this->request->params['week'] <= 52) {
			$week = $this->request->params['week'];
		} else {
			$week = date('W') - 1;
			if ($week == 0) {
				$week = 52;
			}
		}

		$coldest = $this->Run->find('all', array(
			'contain' => array('User'),
			'fields' => array('MIN(Run.temperature) AS temperature, User.username'),
			'conditions' => array('Run.week' => $week),
			'group' => array('User.username'),
			'order' => array('temperature' => 'ASC'),
			'limit' => 3,
		));

		$longest = $this->Run->find('all', array(
			'contain' => array('User'),
			'fields' => array('MAX(Run.duration) AS duration, User.username'),
			'conditions' => array('Run.week' => $week),
			'group' => array('User.username'),
			'order' => array('duration' => 'DESC'),
			'limit' => 3,
		));

		$highest = $this->Run->find('all', array(
			'contain' => array('User'),
			'fields' => array('MAX(Run.score) AS score, User.username'),
			'conditions' => array('Run.week' => $week),
			'group' => array('User.username'),
			'order' => array('score' => 'DESC'),
			'limit' => 3,
		));

		if (date('Y-m-d') > $this->end_date && !isset($this->request->params['week'])) {
			$coldest = $this->Run->find('all', array(
				'contain' => array('User'),
				'fields' => array('MIN(Run.temperature) AS temperature, User.username'),
				'group' => array('User.username'),
				'order' => array('temperature' => 'ASC'),
				'limit' => 3,
			));

			$longest = $this->Run->find('all', array(
				'contain' => array('User'),
				'fields' => array('MAX(Run.duration) AS duration, User.username'),
				'group' => array('User.username'),
				'order' => array('duration' => 'DESC'),
				'limit' => 3,
			));

			$highest = $this->Run->find('all', array(
				'contain' => array('User'),
				'fields' => array('MAX(Run.score) AS score, User.username'),
				'group' => array('User.username'),
				'order' => array('score' => 'DESC'),
				'limit' => 3,
			));
		}

		$this->set('coldest', $coldest);
		$this->set('longest', $longest);
		$this->set('highest', $highest);
		$this->set('week', (date('Y-m-d') > $this->end_date && !isset($this->request->params['week'])) ? 'Final' : 'Week ' . $week);
	}

	public function delete($id = null) {
		if (!isset($id)) {
			$this->redirect(array('controller' => 'runs'));
		}

		if ($this->Run->delete($id)) {
			$this->Session->setFlash('Run has been deleted.', 'success');
			$this->redirect(array('controller' => 'runs', 'action' => 'index'));
		}
	}

	public function edit($id = null) {
		if (!isset($id)) {
			$this->redirect(array('action' => 'index'));
		}

		$this->Run->id = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Run->save($this->request->data)) {
				$this->Session->setFlash('Run updated successfully.', 'success');
				$this->redirect(array('controller' => 'runs', 'action' => 'index'));
			} else {
				$this->Session->setFlash('Run could not be updated.', 'error');
			}
		} else {
			$this->request->data = $this->Run->read(null, $id);
		}
	}

	public function index() {
		$this->Paginator->settings = array(
			'conditions' => array(
				'user_id' => $this->Auth->user('id'),
			),
			'order' => array('date' => 'DESC'),
		);
		$this->set('runs', $this->paginate());
		$this->set('weather', $this->Run->weather);
	}

	public function leaderboard() {
		$this->set('teams', ClassRegistry::init('Team')->find('list'));
		$this->set('results', $this->Run->getLeaders());
		$this->render('results');
	}

	public function results() {
		if (isset($this->request->params['week']) && $this->request->params['week'] >= 1 && $this->request->params['week'] <= 52) {
			$week = $this->request->params['week'];
		} else {
			$week = date('W') - 1;
			if ($week == 0) {
				$week = 52;
			}
		}

		$this->set('teams', ClassRegistry::init('Team')->find('list'));
		$this->set('results', (date('Y-m-d') > $this->end_date && !isset($this->request->params['week'])) ? $this->Run->finalResults() : $this->Run->weeklyResults($week));
		$this->set('week', (date('Y-m-d') > $this->end_date && !isset($this->request->params['week'])) ? 'Final' : 'Week ' . $week);
	}

}
