<?php
class AppModel extends Model {

	var $actsAs = array('Containable'/*, 'Linkable'*/);
	var $recursive = -1;
	var $tempCache = null;

	/*function find($type, $options = array()) {
		$method = null;
		if(is_string($type)) {
			$method = sprintf('__find%s', Inflector::camelize($type));
		}
		if($method && method_exists($this, $method)) {
			return $this->{$method}($options);
		} else {
			$args = func_get_args();
			return call_user_func_array(array('parent', 'find'), $args);
		}
	}*/

	/**
	 * Wrapper find to cache sql queries
	 * @param array $conditions
	 * @param array $fields
	 * @param string $order
	 * @param string $recursive
	 * @return array
	 */
	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		if (Configure::read('Cache.disable') === false && Configure::read('Cache.check') === true && (  ( isset($fields['cache']) && $fields['cache'] !== false ) || $this->tempCache!=null )) {

			if( $this->tempCache != null && isset($fields['cache']) && $fields['cache'] !== false ) {
				$fields['cache'] = $this->tempCache;
			}
			$this->tempCache = null;

			$key = $fields['cache'];
			$expires = '+1 hour';

			if (is_array($fields['cache'])) {
				$key = $fields['cache'][0];

				if (isset($fields['cache'][1])) {
					$expires = $fields['cache'][1];
				}
			}

			// Set cache settings
			Cache::config('sql_cache', array(
				'prefix' 	=> strtolower($this->name) .'-',
				'duration'	=> $expires
			));

			// Load from cache
			$results = Cache::read($key, 'sql_cache');

			if (!is_array($results)) {
				$results = parent::find($conditions, $fields, $order, $recursive);
				Cache::write($key, $results, 'sql_cache');
			}

			return $results;
		}

		// Not cacheing
		return parent::find($conditions, $fields, $order, $recursive);
	}



	function toFloat( $val, $decimalLength=2 )
	{
		if( is_numeric( $val ) ) return floatval( $val );
		$val = trim( $val );
		$regs = array( '[^0-9,.]', '/^([0-9]*)(,|\.?)([0-9]+)(,|\.{1})([0-9]{'. $decimalLength .'})$/', '/,/' );
		$reps = array( '', '\\1\\3.\\5', '.' );

		return floatval( preg_replace( $regs, $reps, $val ) );
	}


	function paginateCount($conditions = null, $recursive = 0, $extra = array()) {

		$parameters = compact('conditions', 'recursive');

		if (isset($extra['group'])) {
			$parameters['fields'] = $extra['group'];

			if (is_string($parameters['fields'])) {
				// pagination with single GROUP BY field
				if (substr($parameters['fields'], 0, 9) != 'DISTINCT ') {
					$parameters['fields'] = 'DISTINCT ' . $parameters['fields'];
				}

				unset($extra['group']);

				$count = $this->find('count', array_merge($parameters, $extra));
			} else {
				// resort to inefficient method for multiple GROUP BY fields
				$count = $this->find('count', array_merge($parameters, $extra));

				$count = $this->getAffectedRows();

			}

		} else {
			// regular pagination
			$count = $this->find('count', array_merge($parameters, $extra));
		}


		//echo '<br />mem: ' . number_format(memory_get_usage(), 0, '.', ',');
		//echo '<br />peak: ' . number_format(memory_get_peak_usage(), 0, '.', ',');

		return $count;
	}


}
?>