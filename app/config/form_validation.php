<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'signup' => array(
		array(
			'field' => 'firstname',
			'label' => 'First Name',
			'rules' => 'trim|required|min_length[5]|max_length[50]'
		),
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required|min_length[5]|max_length[30]'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|min_length[8]|max_length[30]'
		)
	),
	'signin' => array(
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required|min_length[5]|max_length[30]'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|min_length[8]|max_length[30]'
		)
	)
);

