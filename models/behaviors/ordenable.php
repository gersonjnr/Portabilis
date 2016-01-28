<?php
class OrdenableBehavior extends ModelBehavior {


	var $defaultConfig = array(
		'field' => 'ord',
		'group' => null
	);
//	var $config = array( );

	var $newOrder = false;
	var $currentOrder = false;

	var $currentIdForGroup = false;


	function setup( &$model, $config = array() )
	{
		$model->id = null; // (!) TEMP: PERIGO!!! pode ser que estrague algo

		if( Configure::read()>0 ) $this->showErrors = true;

		// forcando um array
		if( !is_array( $config ) )
			$config = array( $this->defaultConfig );
		else
		{
			$config = array_merge( $this->defaultConfig, $config );
		}

		$model->OrdenableConfig = $config;
		$oldOrder = $model->order;
		$model->order = $model->name .'.'. $config['field'].' DESC';
		if( !empty( $oldOrder ) ) $model->order .= ', '. $model->order;

		$group = $this->checkForGroup( $model );
		if( $group ) {
			$model->order = $group['fk'].' DESC, '. $model->order;
		}

	}


	function reorder( &$model, $groupId=null )
	{

		$currentGroup = null;

		$p = array();

		$group = $this->checkForGroup( $model, null, 'teste' );
		/*if( $group )*/ $p['order'] = str_replace( $model->OrdenableConfig['field'].' DESC', $model->OrdenableConfig['field'].' ASC', $model->order );

		if( $groupId ) $p['conditions'][ $group['fk'] ] = $groupId;

		$rs = $model->find( 'all', $p );

		$currentOrder = 1;
		foreach ( $rs as $row )
		{
			if( $group && ( $currentGroup != $row[ $model->name ][ $group['fk'] ] ) ) {
				$currentGroup = $row[ $model->name ][ $group['fk'] ];
				$currentOrder = 1;
			}

			$model->data = array();
			$model->id = $row[ $model->name ]['id'];
			$model->set( array( $model->name =>array( $model->OrdenableConfig['field'] => $currentOrder ) ) );
			$model->save( null, array( 'validate'=>false , 'callbacks'=>false ) );

			$currentOrder++;
		}

		$model->id = null;
		// reiniciar a ordem por ids e por grupos
	}


	function beforeSave( &$model )
	{

		$this->currentIdForGroup = false;
		$order = false;

		if( isset( $model->data[$model->name][$model->OrdenableConfig['field']] ) ) $order = $model->data[$model->name][$model->OrdenableConfig['field']];

		$group = $this->checkForGroup( $model );
		if( $group ) {
			if ( isset( $model->data[$group['model']][$group['field']] ) ) $this->currentIdForGroup = $model->data[$group['model']][$group['field']];
			if ( isset( $model->data[$model->name][$group['fk']] ) ) $this->currentIdForGroup = $model->data[$model->name][$group['fk']];
		}

		if( !$model->id )
		{ // new record without order
			$model->data[$model->name][$model->OrdenableConfig['field']] = $this->selectMaxOrder( $model ) + 1;
			if( $order ) $this->newOrder = $order; // WITH order
		}
		elseif( !$order && $model->id )
		{ // old record without order
			$model->data[$model->name][$model->OrdenableConfig['field']] = $this->selectOrder( $model );
		}
		else
		{ // old record WITH order
			$this->changeOrder( $model, $order );
			unset( $model->data[$model->name][$model->OrdenableConfig['field']] );
		}
		return true;
	}

	function afterSave( &$model )
	{
		if( $this->newOrder && !$model->id ) {
			$this->changeOrder( $model, $this->newOrder );
			$this->newOrder = false;
		}
		return true;
	}

	function up( &$model, $id ) {
		 $model->id = $id;
		 return $this->changeOrder( $model, 'up' );
	}

	function down( &$model, $id ) {
		 $model->id = $id;
		 return $this->changeOrder( $model, 'down' );
	}



	function changeOrder( &$model, $newOrder )
	{
		$id = $model->id;
		$oldOrder = $this->selectOrder( $model );


		if( $newOrder=='up' ) $newOrder = $oldOrder+1;
		if( $newOrder=='down' ) $newOrder = $oldOrder-1;

		$newOrder = (is_numeric($newOrder)) ? $newOrder : false;

		if(!$id || !$newOrder) return true;



		if( $oldOrder == $newOrder ) return true;
		if($newOrder<=0) return true;

		$maxOrder = $this->selectMaxOrder( $model );

		if( $oldOrder == $maxOrder && $newOrder>$maxOrder ) return true;

		if( $newOrder>$maxOrder && !is_null( $maxOrder ) )
			$newOrder = $maxOrder+1;

		$data = array();

		$field = $model->OrdenableConfig['field'];

		if($oldOrder > $newOrder)
		{
			$p = array( $field => '('. $field .'+1)' );
			$where = array( $field.' >='. $newOrder, $field.' <'. $oldOrder, $model->name .'.id !='. $id );
		}
		else
		{
			$p = array( $field => '('. $field .'-1)');
			$where = array( $field.' <=' => $newOrder, $field.' >'=> $oldOrder, $model->name.'.id !=' => $id );
		}

		$group = $this->checkForGroup( $model );
		if( $group ) $where[ $group['fk'] ] = $this->currentIdForGroup;


		$model->updateAll( $p, $where );

		//$model->set(  );
		$model->data = array();
		return $model->save( array( $model->OrdenableConfig['field'] => $newOrder ), array( 'validate'=>false , 'callbacks'=>false ), array( 'ord' ) ); // saving current row


	}


	function selectOrder( &$model )
	{
		$rs = $model->find( 'first', array('conditions' => array( $model->name .'.id' => $model->id)) );

		$group = $this->checkForGroup( $model );
		if( $group ) $this->currentIdForGroup = $rs[$model->name][$group['fk']];

		return $rs[$model->name][$model->OrdenableConfig['field']];
	}

	function selectMaxOrder( &$model )
	{
		$group = $this->checkForGroup( $model );
		if( $group && !is_null( $this->currentIdForGroup ) ) {
			$p['conditions'][$group['fk']] = $this->currentIdForGroup;
			$p['group'] = $group['fk'];
		}

		// cleaning the id
		if( $model->id ) {
			$id = $model->id;
			$model->id = null;
		}

		$p['fields'] = array('MAX('. $model->name .'.'. $model->OrdenableConfig['field'] .') as MaxOrder');
		$p['limit'] = 1;
		$ordem = $model->find('first', $p);

		// reseting the id
		if( isset( $id ) ) $model->id = $id;

		if( !$ordem ) return null;

		return $ordem[0]['MaxOrder'];
	}


	function checkForGroup( &$model )
	{
		if( is_null( $model->OrdenableConfig['group'] ) ) return false;

		$group = explode( '.', $model->OrdenableConfig['group'] );

		if( count( $group ) != 2 ) return $model->OrdenableConfig['group'];
		if( !isset( $model->{$group[0]} ) ) return false;

		/*$model->Behaviors->attach( 'Containable' );
		$model->contain( $model->OrdenableConfig['group'] );*/



		return array (
			'model' => $group[0],
			'field' => $group[1],
			'fk' => $model->belongsTo[$group[0]]['foreignKey'] );

	}

	function beforeDelete( &$model ) {
		$this->currentOrder = $this->selectOrder( $model );
		return true;
	}

	function afterDelete( &$model )
	{
		/*$field = $model->name .'.'. $model->OrdenableConfig['field'];
		$p = array( $field => DboSource::expression( $field .'-1') );
		$where[$field.'>'] = $this->currentOrder;

		/*$group = $this->checkForGroup( $model );
		if( $group && !is_null( $this->currentIdForGroup ) ) $where[$group['fk']] = $this->currentOrder;
		$this->currentOrder = false;*/

		//return $model->updateAll( $p, $where );

		return $this->reorder( $model, $this->currentIdForGroup );
	}

}

?>