<?php
class JoinableBehavior extends ModelBehavior {

	protected $_key = 'join';
	protected $defaultType = 'INNER';
	public $fieldsInformed = null;



	public function beforeFind( &$Model, $query )
	{

		if( !isset( $query[ $this->_key ] )) return $query;

		$this->fieldsInformed = count( $query['fields'] );

		if( !$this->fieldsInformed ) { // default fields
			foreach ( array_keys( $Model->_schema ) as $field )
				$query['fields'][] = '`'. $Model->name .'`.`'. $field .'`';
		}

		if( isset( $Model->joins_from_joinable ) && count( $Model->joins_from_joinable )) {
			$query[ $this->_key ] = isset($query[ $this->_key ]) ? array_merge( $Model->joins_from_joinable, $query[ $this->_key ] ) : $Model->joins_from_joinable;
		}


		if( isset( $query[ $this->_key ] ))
		{
			if( !isset( $query['joins'] )) $query['joins'] = array();

			$usedAliases = array(); // logging used aliases

			$query = $this->addJoin( $Model, $query, $query );
			$this->fieldsInformed = null;

		}

		return $query;
	}

	public function afterFind( &$Model, $query ) { $this->joins_from_joinable = array(); }

	public function join( &$Model, $joins ) {
		$Model->joins_from_joinable = $joins;
	}

	private function addJoin( &$Model , &$query, $currentJoin, $modelAlias='' )
	{
		if( empty( $modelAlias )) $modelAlias = $Model->name;

		foreach ( $currentJoin[$this->_key] as $key => $join )
		{

			if( is_numeric( $key ) ) $alias = $join;
			elseif( is_array($join) && isset($join['model']) ) $alias = $join['model'];
			else $alias = $key;


			$data = array();
			$data['table'] = $Model->{$alias}->table; // table to join
			$data['alias'] = ( is_numeric( $key ) ) ? $join : $key; // name of relationship
			$data['type'] = is_array( $join ) && isset( $join['type'] ) ? $join['type'] : $this->defaultType; // type of (default INNER)


			if( !$this->fieldsInformed ) { // default fields if none passed
				if( is_array( $join ) && isset( $join['fields'] ) ) {
					$query['fields'] = array_merge( $query['fields'], $join['fields'] );
				} else {
					foreach ( array_keys( $Model->{$alias}->_schema ) as $field )
						$query['fields'][] = '`'. $alias .'`.`'. $field .'`';
				}
			}



			if( is_array( $join ) && isset( $join['conditions'] ) ) $data['conditions'] = $join['conditions'];
			else { // checking for relatinships

				// belongsTo
				if( isset( $Model->belongsTo[$alias]['foreignKey'] )) {
					$self = "`$modelAlias`.`". $Model->belongsTo[$alias]['foreignKey'] ."`";
					$foreign = DboSource::expression( $data['alias'] .'.'. $Model->{$alias}->primaryKey );
					$data['conditions'] = array( $self => $foreign );
				}

				// hasMany and hasOne
				if( isset( $Model->hasMany[$alias]['foreignKey'] ) || isset( $Model->hasOne[$alias]['foreignKey'] )) {
					$self = "`$modelAlias`.`". $Model->primaryKey ."`";
					$foreign = DboSource::expression( $data['alias'] .'.'. ( isset( $Model->hasMany[$alias]['foreignKey'] ) ? $Model->hasMany[$alias]['foreignKey'] : $Model->hasOne[$alias]['foreignKey'] ) );
					$data['conditions'] = array( $self => $foreign );
				}

				// hasAndBelongsToMany
				if( isset( $Model->hasAndBelongsToMany[$alias]['foreignKey'] ) || isset( $Model->hasOne[$alias]['foreignKey'] ))
				{
					$dataCopy = $data;

					$dataCopy['table'] = $Model->hasAndBelongsToMany[$alias]['joinTable'];
					$dataCopy['alias'] = $data['alias'] .'Join';

					$self1 = "`$modelAlias`.`". $Model->primaryKey ."`";
					$foreign1 = DboSource::expression( $dataCopy['alias'] .'.'. $Model->hasAndBelongsToMany[$alias]['foreignKey'] );

					$dataCopy['conditions'] = array( $self1 => $foreign1 );
					$query['joins'][] = $dataCopy;


					$self2 = '`'. $data['alias'] .'Join`.`'. $Model->hasAndBelongsToMany[$alias]['associationForeignKey'] .'`';
					$foreign2 = DboSource::expression( $data['alias'] .'.'. $Model->{$alias}->primaryKey );

					$data['conditions'] = array( $self2 => $foreign2 );

				}


			}

			$query['joins'][] = $data;

			if(  is_array( $join ) && isset( $join[ $this->_key ] ) ) {
				if( !is_array( $join[ $this->_key ] ) ) $join[ $this->_key ] = array( $join[ $this->_key ] );
				$this->addJoin( $Model->{$alias}, $query, $join, $alias );
			}

			$usedAliases[] = $alias; // logging used aliases
		}


		return $query;
	}

}

?>