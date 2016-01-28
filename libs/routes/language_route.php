<?php

class LanguageRoute extends CakeRoute {


	function parse($url){

		return parent::parse($url);

		echo $url; debug( parent::parse($url) );
	
		// lista de locales em config/locales.php
		$locales = array_keys( Configure::read( 'Locales.list' ) );

		// checando se a url atual possui locale
		$url_exploded = explode( '/', $url );

		//limpa indices vazios
		for ( $i=0, $l=count( $url_exploded ); $i<$l; $i++ ){
	
			if( !strlen( $url_exploded[$i] ) ) unset( $url_exploded[$i] );
	
		}

		$url_exploded = array_values( $url_exploded );
		$url_locale = $url_exploded[0];
		$matched = false;

		foreach ( $locales as $locale ) {
	
			if( $url_locale == $locale ) {
	
				$matched = true;
				break;
	
			}
	
		}

		// se encontrou o locale na url, entao remonta ela com language:locale
		if( $matched ) {
	
			unset( $url_exploded[0] );
			$url_exploded[] = 'language:'. $locale;
			$url = '/'. implode( '/', $url_exploded ).'/';
			debug( $url );
	
		}

		$params = parent::parse($url);
		debug( $params ); die;

		if (empty($params)) {

			return false;

		}

		if ($count) {

			return $params;

		}

		return false;

	}

	/*function match( $url=array() ){



		if (!$this->compiled()) {
			$this->compile();
		}
		$defaults = $this->defaults;

		if (isset($defaults['prefix'])) {
			$url['prefix'] = $defaults['prefix'];
		}

		//check that all the key names are in the url
		$keyNames = array_flip($this->keys);
		if (array_intersect_key($keyNames, $url) != $keyNames) {
			return false;
		}

		$diffUnfiltered = Set::diff($url, $defaults);
		$diff = array();

		foreach ($diffUnfiltered as $key => $var) {
			if ($var === 0 || $var === '0' || !empty($var)) {
				$diff[$key] = $var;
			}
		}

		//if a not a greedy route, no extra params are allowed.
		if (!$this->_greedy && array_diff_key($diff, $keyNames) != array()) {
			return false;
		}

		//remove defaults that are also keys. They can cause match failures
		foreach ($this->keys as $key) {
			unset($defaults[$key]);
		}
		$filteredDefaults = array_filter($defaults);

		//if the difference between the url diff and defaults contains keys from defaults its not a match
		if (array_intersect_key($filteredDefaults, $diffUnfiltered) !== array()) {
			return false;
		}

		$passedArgsAndParams = array_diff_key($diff, $filteredDefaults, $keyNames);
		list($named, $params) = Router::getNamedElements($passedArgsAndParams, $url['controller'], $url['action']);

		//remove any pass params, they have numeric indexes, skip any params that are in the defaults
		$pass = array();
		$i = 0;
		while (isset($url[$i])) {
			if (!isset($diff[$i])) {
				$i++;
				continue;
			}
			$pass[] = $url[$i];
			unset($url[$i], $params[$i]);
			$i++;
		}

		//still some left over parameters that weren't named or passed args, bail.
		if (!empty($params)) {
			return false;
		}

		//check patterns for routed params
		if (!empty($this->options)) {
			foreach ($this->options as $key => $pattern) {
				if (array_key_exists($key, $url) && !preg_match('#^' . $pattern . '$#', $url[$key])) {
					return false;
				}
			}
		}
		debug( $url );
		return $this->_writeUrl(array_merge($url, compact('pass', 'named')));
	}*/


}

?>