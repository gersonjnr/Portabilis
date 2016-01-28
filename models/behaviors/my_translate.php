<?php
App::import( 'Behavior', 'Translate' );
class MyTranslateBehavior extends TranslateBehavior
{

	/**
	 * se fora da lingua padrão, o campo estiver vazio vai retornar o valor do campo da lingua padrao
	 *
	 * @var boolean
	 */
	var $strict = false;

	var $fieldsufix = '_locale';


	public function setup( &$Model, $settings )
	{
//		debug( $Model );
		if( isset( $Model->Behaviors->MyTranslate->runtime ) && count( $Model->Behaviors->MyTranslate->runtime ) ) return;

		// adicionando alias a todos os campos por padrao
		foreach ( $settings as $k => $v ) {
			if( is_numeric( $k ) ) {
				$settings[$v] = $v . $this->fieldsufix;
				unset( $settings[$k] );
			}
		}

		parent::setup( $Model, $settings );
	}


	public function beforeFind( &$Model, $query )
	{
		if( empty( $Model->locale ) ) $Model->locale = Configure::read( 'Config.language' );
		// o Translate necessita de um nivel de recursividade
		if( empty( $query['recursive'] ) && $Model->recursive < 1 ) $query['recursive'] = 1;

		return parent::beforeFind( &$Model, $query );
	}


	public function afterFind( &$Model, &$results, $primary )
	{
		parent::afterFind( &$Model, &$results, $primary );

		// armazenando os campos (performance)
		$fields = array_merge($this->settings[$Model->alias], $this->runtime[$Model->alias]['fields']);

		// locale atual
		$locale = Configure::read( 'Config.language' );
		if( !empty( $Model->locale ) ) $locale = $Model->locale;

		// loop nos resultados
		foreach ( $results as &$result )
		{
			if( !isset( $result[ $Model->alias ] ) ) continue;

			// loop nos campos do behavior
			foreach( $fields as $original => $sufixed )
			{
				if( !isset( $result[ $Model->alias ][ $original ] ) ) continue;
				// campo *-translated para os resultados da lingua atual
				$result[ $Model->alias ][ $original .'-translated' ] = $result[ $Model->alias ][ $original ];

				// loop pelos campos externos
				foreach ( $result[$sufixed] as $data )
				{
					// campo-locale. Ex.: titulo-eng
					$result[ $Model->alias ][ $original .'-'. $data[ 'locale' ] ] = $data['content'];

					// se for o mesmo locale atual seta o campo *-translated
					if( $locale == $data['locale'] )
					{
						$result[ $Model->alias ][ $original .'-translated' ] = $data['content'];

						// se nao estiver no modo 'strict', transforma o valor original do campo no traduzido
						if( !$this->strict ) $result[ $Model->alias ][ $original ] = $result[ $Model->alias ][ $original .'-translated' ];
					}
				}

			}

		}

		return $results;
	}

	function beforeValidate(&$Model) {
		if( empty( $Model->locale ) ) $Model->locale = Configure::read( 'Config.language' );
		return parent::beforeValidate( $Model );
	}

}
?>