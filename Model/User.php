<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $belongsTo = array('Team');
	public $hasMany   = array('Run');

	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "A username is required.",
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => "That username is already in use.",
			),
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "A password is required.",
			),
			'length' => array(
				'rule' => array('minLength', 8),
				'message' => "Password must be at least 8 characters.",
			),
		),
		'password_confirm' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "You must confirm your password.",
			),
			'matches' => array(
				'rule' => array('confirmPassword'),
				'message' => "Passwords do not match.",
			),
		),
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
	}

	public function confirmPassword() {
		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm'];
	}

}