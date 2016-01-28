<?php

class Matricula extends AppModel {


	var $name  = 'Matricula';
	var $order = 'Matricula.id DESC';
	
	var $validate = array(
		'aluno_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'curso_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'data_matricula' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ano' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pago' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Aluno' => array(
			'className' => 'Aluno',
			'foreignKey' => 'aluno_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)/*,
		'Matricula' => array(
			'className' => 'Matricula',
			'foreignKey' => 'matricula_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/,
		'Curso' => array(
			'className' => 'Curso',
			'foreignKey' => 'curso_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}

?>