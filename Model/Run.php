<?php

class Run extends AppModel {

	protected $start_date;
	protected $end_date;

	public $belongsTo = array('User');

	public $weather = array('None', 'Rain', 'Snow', 'Sleet', 'Hail');

	public $validate = array(
		'date' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "Date is required.",
			),
			'valid' => array(
				'rule' => array('validDate'),
				'message' => "Not a valid date.",
			),
		),
		'duration' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "Duration is required.",
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => "Duration must be a number.",
			),
			'range' => array(
				'rule' => array('comparison', '>', 0),
				'message' => "Very funny.",
			),
		),
		'temperature' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "Temperature is required.",
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => "Temperature must be a number.",
			),
		),
	);

	public function beforeSave($options = array()) {
		$this->data[$this->alias]['score'] = $this->computeScore();
		$this->data[$this->alias]['week']  = date('W');
	}

	protected function computeScore() {
		$temperature = $this->data[$this->alias]['temperature'];
		$duration    = $this->data[$this->alias]['duration'];
		$weather	 = $this->data[$this->alias]['weather'];

		$score = $this->temperatureScore($temperature);

		/**
		 * Bonus Points
		 * Rain (sub 50 degrees) = 4 pts
		 * Rain (sub 40 degrees) = 8 pts
		 * Snowing = 6 pts
		 * Sleet = 10 pts
		 * Hail = 15 pts
		 */
		if ($weather == '1') {
			$score += ($temperature < 40) ? 8 : 4;
		} else if ($weather == '2') {
			$score += 6;
		} else if ($weather == '3') {
			$score += 10;
		} else if ($weather == '4') {
			$score += 15;
		}

		$score *= $this->timeMultiplier($duration);

		return $score;
	}

	/**
	 * Scoring starts at 50 degrees. For every 5 degrees below 50,
	 * you earn an additional point. There is no lower limit.
	 */
	private function temperatureScore($temperature) {
		$score = floor((50 - $temperature) / 5) + 1;
		return max(0, $score);
	}

	/**
	 * Baseline (ie x1) is one hour. Multiplier is based on half-hour
	 * increments. Two half hour runs should be worth the same as a single
	 * one hour run. There is no upper limit.
	 */
	private function timeMultiplier($time) {
		$score = ceil($time / 30) * 0.5;
		return $score;
	}

	public function finalResults() {
		$db = $this->getDataSource();

		$query = "SELECT u.username, SUM(r.score) AS points, t.id
					FROM users AS u
					INNER JOIN runs AS r ON u.id = r.user_id
					INNER JOIN teams AS t ON t.id = u.team_id
					GROUP BY u.username
					ORDER BY t.id ASC, points DESC";
		$qres = $db->fetchAll($query);

		$results = array();
		foreach ($qres as $result) {
			$results[$result['t']['id']][] = array(
				'username' => $result['u']['username'],
				'score' => $result[0]['points'],
			);
		}

		return $results;
	}

	public function getLeaders() {
		$db = $this->getDataSource();

		$query = "SELECT u.username, SUM(r.score) AS points, t.id
					FROM users AS u
					INNER JOIN runs AS r ON u.id = r.user_id
					INNER JOIN teams AS t ON t.id = u.team_id
					GROUP BY u.username
					ORDER BY t.id ASC, points DESC";
		$qres = $db->fetchAll($query);

		$results = array();
		foreach ($qres as $result) {
			$results[$result['t']['id']][] = array(
				'username' => $result['u']['username'],
				'score' => $result[0]['points'],
			);
		}

		return $results;
	}

	public function validDate() {
		return $this->data[$this->alias]['date'] >= Configure::read('Contest.start') && $this->data[$this->alias]['date'] <= Configure::read('Contest.end');
	}
	
	public function weeklyResults($week = null) {
		$db = $this->getDataSource();

		if (!$week) {
			$week = date('W') - 1;
		}

		// Because winter spans years.
		if ($week == 0) {
			$week = 52;
		}

		$query = "SELECT u.username, SUM(r.score) AS points, t.id
					FROM users AS u
					INNER JOIN runs AS r ON u.id = r.user_id
					INNER JOIN teams AS t ON t.id = u.team_id
					WHERE r.week = {$week}
					GROUP BY u.username
					ORDER BY t.id ASC, points DESC";
		$qres = $db->fetchAll($query);

		$results = array();
		foreach ($qres as $result) {
			$results[$result['t']['id']][] = array(
				'username' => $result['u']['username'],
				'score' => $result[0]['points'],
			);
		}

		return $results;
	}

}
