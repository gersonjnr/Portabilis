<?php

class Periodo extends AppModel {


	var $name  = 'Periodo';
	var $order = 'Periodo.id DESC';
	
	
	var $validate = array(
	 	'nome' => array(
			'notempty' => array(
				'rule' => array( 'notempty' ),
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
		'Curso' => array(
			'className' => 'Curso',
			'foreignKey' => 'periodo_id',
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