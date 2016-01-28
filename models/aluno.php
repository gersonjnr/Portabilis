<?php

class Aluno extends AppModel {


	var $name  = 'Aluno';
	var $order = 'Aluno.id DESC';
	
	
	var $validate = array(
		
		'cpf' => array(

			'notempty' => array(

				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),

		),
		'rg' => array(

			'notempty' => array(

				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),

		),
		'data_nascimento' => array(

			'notempty' => array(

				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),

		),
		'nome' => array(

			'notempty' => array(

				'rule' => array('notempty'),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),

		),
		'telefone' => array(

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
	var $hasMany = array(

		'Matricula' => array(

			'className' => 'Matricula',
			'foreignKey' => 'aluno_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''

		)

	);	


}

?>