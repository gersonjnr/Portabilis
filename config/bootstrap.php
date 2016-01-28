<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */

Configure::write( 'domain', '' );

$static_url = '/';

Configure::write( 'static_url', $static_url );

// emails padroes
Configure::write( 'Email.geral', 'gersonjnr@hotmail.com' ); 

// titulo do site
Configure::write( 'site_title', 'Portabilis Tecnologia - Avaliação Técnica ' );

// idiomas
Configure::write( 'multiple_language', false );

Configure::load( 'locales' );

define( 'DEFAULT_LANGUAGE', Configure::read( 'Locales.default' ) );

// Definindo idioma da aplicação
Configure::write( 'Config.language', DEFAULT_LANGUAGE );

// Adicionando o caminho do locale
$localePaths = Configure::read('localePaths');

$localePaths[] = dirname(dirname(__FILE__)) . DS . 'locale';

Configure::write( 'localePaths', $localePaths );

// nome do cookie e da session de autenticacao de usuarios
Configure::write( 'Autenticacao.SessionName', 'Autenticacao' );

Configure::write( 'Autenticacao.UsaSSL', false );

// definindo nome do cookie de orcamento
Configure::write('Config.carrinhoCookieName', 'carrinhoCookie');

// sql cache
Cache::config('sql_cache', array(
	'engine'	=> 'File',
	'path'		=> CACHE .'sql'. DS,
	'serialize'	=> true,
));


if( !function_exists( 'router_url_language' ) ) {

	function router_url_language($url) {

		// verifica se o site possui multiplas linguas 
		if( Configure::read( 'multiple_language') ){
	
			if( is_array( $url ) && ( ( isset( $url['admin'] ) && $url['admin']==true ) || ( isset( $GLOBALS['Dispatcher']->params['admin'] ) && $GLOBALS['Dispatcher']->params['admin']==true ) ) ) {
	
				return $url;
	
			}
	
			$lang = Configure::read('Config.language');
	
			if ( is_array( $url ) ) {
	
				if ( !isset( $url['language'] ) ) {
	
					$url['language'] = $lang;
	
				}
	
			} elseif( substr( $url, 0, 7 ) != '/admin/' ) {
	
				//$url = '/'. $lang .'/'. $url;
	
				$url = '/'. $url;
	
			}
	
			if( isset( $url['language'] ) ) {
	
				// parametros passados traduzidos se for o controller pages
	
				if( isset( $url['controller'] ) && $url['controller'] == 'pages' ) {
	
					foreach( $url as $key => &$pass ) {
	
						if( is_numeric( $key ) ) {
	
							$pass = __gt( $url['language'], $pass, true );
	
						}
	
					}
	
				}
	
			}
	
		}
	
		return $url;
	
	}

}


if ( !function_exists('__gt') ) {
	
	function __gt( $locale, $singular, $return=false ) {
	
		// trocando temporariamente a lingua
		if( isset( $_SESSION['Config']['language'] ) ) {

			$current_locale = $_SESSION['Config']['language'];
	
			$_SESSION['Config']['language'] = $locale;

		} else {

			$current_locale = Configure::read( 'Config.language' );
	
			Configure::write( 'Config.language', $locale );

		}

		$translation = __( $singular, true );
	
		if( isset( $_SESSION['Config']['language'] ) ) $_SESSION['Config']['language'] = $current_locale;
	
		else Configure::write( 'Config.language', $current_locale );

		if( $return ) return $translation;
	
		else echo $translation;

	}

}


// plugin do cake br
require APP . 'plugins' . DS . 'cake_ptbr' . DS . 'config' . DS . 'bootstrap.php';

//EOF
?>