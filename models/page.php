<?php

class Page extends AppModel {
	
	
	var $name  = 'Page';
	var $order = 'Page.name';
	
	
	function findByName( $name='' ) {

		$p['conditions']['name'] = $name;
		return $this->find( 'first', $p );

	}


	function afterFind( $result ) {

		if( isset( $result['Page']['view'] ) && empty( $result['Page']['view'] ) ) {

			$result['Page']['view'] = 'default';

		}

		return $result;

	}


}

?>