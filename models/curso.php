<?php

class Curso extends AppModel {


	var $name  = 'Curso';
	var $order = 'Curso.id DESC';
	public $virtualFields = array( 'ficha'=>"CONCAT( Curso.nome,' - ',Periodo.nome)" );

	
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

		),
		'periodo_id' => array(

			'notempty' => array(

				'rule' => array( 'notempty' ),
				'message' => 'Este campo não pode ser deixado em branco.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),

		),
		'valor_inscricao' => array(

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
	var $belongsTo = array(

		'Periodo' => array(

			'className' => 'Periodo',
			'foreignKey' => 'periodo_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''

		)

	);
	
	
}

?>