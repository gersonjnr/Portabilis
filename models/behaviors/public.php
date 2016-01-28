<?php
class PublicBehavior extends ModelBehavior {


	var $defaultConfig = array(
		'field' => 'public_level',
		'public' => null
		);


	function setup( &$model, $config = array() )
	{
		if( !isset( $this->config[$model->alias] ) ) $this->config[$model->alias] = $this->defaultConfig;
		$this->config[$model->alias] = array_merge( $this->config[$model->alias], $config );
	}


	function beforeFind( &$model, $options=array() )
	{
		if( !isset( $options['conditions'][ $this->config[$model->alias]['field'] ] ) && $this->config[$model->alias]['public'] != null ) {
			$options['conditions'][ $this->config[$model->alias]['field'] ] = $this->config[$model->alias]['public'];
		}
		return $options;
	}
}

?>