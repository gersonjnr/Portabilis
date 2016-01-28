<?php

class AppController extends Controller {


	var $_Usuario   = array();
	var $components = array( 'Session', 'Cookie', 'FilterResults.FilterResults' => array( 'autoPaginate' => false ) );
	var $helpers    = array( 'Session', 'Html', 'Form', 'Formatacao', 'Ajax', 'Javascript', 'FilterResults.FilterForm' );
	var $models     = array( 'Validacao' );
	var $protocolo  = '';
	var $lng        = '';


	/* métodos específicos do projeto */
	function beforeRender(){
	
		$this->set( 'static_url', Configure::read( 'static_url' ) );
		$this->_setDefaultVars();
	
	}
	
	
	function _setDefaultVars(){

		$this->_manageLocales();

		if( !isset( $this->viewVars['section'] ) ) $this->set( 'section', 'global' );

		$this->set( 'languages', Configure::read( 'Languages.list' ) );
		$this->set( 'language', Configure::read( 'Config.language' ) );

		$protocolo = env('HTTPS') ? 'https' : 'http';
		$this->set( compact( 'protocolo' ) );
		$this->set( 'webroot', $protocolo .'://'. $_SERVER['HTTP_HOST'] . $this->webroot );

		// testando se os cookies estão habilitados no browser
		$cookieDisabled = false;
		if( $this->referer('',true) && !count( $_COOKIE ) ) $cookieDisabled = true;
		$this->set( compact( 'cookieDisabled' ) );
		$this->set( 'usuario', $this->Session->read( 'Usuario' ) );

	}
	
	
	/* métodos globais */
	function beforeFilter(){
		
		$this->_setDefaultVars();
	
	}

	function _manageLocales(){
		
		if( isset($this->params['language']) ) $lang = $this->params['language'];
	
		elseif( $this->Session->check( 'Config.language' ) ) $lang = $this->Session->read( 'Config.language' );
	
		elseif( $this->Cookie->read( 'lang' ) ) $lang = $this->Cookie->read( 'lang' );
	
		else $lang = DEFAULT_LANGUAGE;

		if ( isset($this->params['language']) && $this->params['language'] != $this->Session->read( 'Config.language' ) ){
	
			// deleta a secao se o locale passado for diferente do atual
			$this->Session->delete( 'Config.language' );
	
		}

		if (!$this->Session->check('Config.language')){
			
			if( !isset( $this->params['language'] ) && $this->Cookie->read('lang') ) $lang = $this->Cookie->read('lang');
			$this->Session->write('Config.language', $lang);
			$this->Cookie->write('lang', $lang, null, '+350 day');
			
		}

		Configure::write('Config.language', $lang );
		
	}

	/* sobreposicao de metodos para as linguas */
	public function redirect($url, $status = null, $exit = true, $caminho_completo = null) {
	
		parent::redirect(router_url_language($url, $caminho_completo), $status, $exit);
	
	}

	public function flash($message, $url, $pause = 1) {
	
		parent::flash($message, router_url_language($url), $pause);
	
	}

	function _success( $message, $key='flash' ) { $this->Session->setFlash( $message, 'default', array('class' => 'success'), $key); }
	function _error( $message, $key='flash' ) { $this->Session->setFlash( $message, 'default', array('class' => 'error'), $key); }
	function _warning( $message, $key='flash' ) { $this->Session->setFlash( $message, 'default', array('class' => 'warning'), $key); }
	function _back( $local=true ) {
		$referer = $this->referer( null, $local );
		if( $referer ) $this->redirect( $referer );
	}

	/**
	 * metodo para testar se o slug é real (friendly_urls)
	 *
	 * @param mixed $id conditions
	 * @param string $field default 'name'
	 * @param string $model se nao houver pega o padrao do controller
	 */
	function _readCheckingSlug( $id=null, $field=null, &$model=null ){

		if( is_null( $id ) ) $id = $this->params['id'];
		if( is_null( $field )) $field = 'name'; // pegando o field default caso nao seja informado um
		if( is_null( $model )) $model = $this->{$this->modelNames[0]}; // pegando o model default caso nao seja informado um

		if( is_array( $id ) ) {
	
			$recordset = $model->find( 'first', array( 'conditions'=>$id ));
	
		} else {
	
			$model->id = $id;
			$recordset = $model->read( );
	
		}

		if( !$recordset ) return false;

 		//$slug = Inflector::slug( $recordset[$model->name][$field] );
 		$slug = $this->slug( $recordset[$model->name][$field] );

 		$url = $this->params;
 		unset( $url['url'] );
 		$url['action'] = $this->action;


 		if( isset( $this->params['slug'] ) && $slug != $this->params['slug']) {
 	
			$post = $model->read(null, $recordset[$model->name]['id']);
			//$this->redirect( array($recordset[$model->name]['id'], $slug, 'id'=>$recordset[$model->name]['id'], 'slug'=>$slug), 301 );
			$url['id'] = $recordset[$model->name]['id'];
			$url['slug'] = $slug;

			$this->redirect( Router::url( $url , true ), 301 );
 	
		}elseif( !isset($this->params['slug'] ) && (!isset( $this->params['pass'][1] )
			|| $slug != $this->params['pass'][1]
			|| count($this->params['pass']) != 2) )
		
		{
		
			$post = $model->read(null, $recordset[$model->name]['id']);
			//$this->redirect( array($recordset[$model->name]['id'], $slug, 'id'=>$recordset[$model->name]['id'], 'slug'=>$slug), 301 );
			$url['id'] = $recordset[$model->name]['id'];
			$url['slug'] = $slug;

			$this->redirect( Router::url( $url, true ), 301 );
		
		}

		return $recordset;
	
	}

	function slug( $str ) {
	
		$src = array('á','à','ã','â','ä','é','è','ê','ë','í','ì','î','ï','ó','ò','õ','ô','ö','ú','ù','û','ü','ç','Á','À','Ã','Â','Ä','É','È','Ê','Ë','Í','Ì','Î','Ï','Ó','Ò','Õ','Ô','Ö','Ú','Ù','Û','Ü','Ç','   ', '  ', '-', ' ', '/', '___', '__', '&quot;' , '&amp;' , '&', ',' , '?');
		$mod = array('a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c','a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c',' ',   ' ',  '_', '_', '_', '_',   '_',  '' ,       'e' ,     'e', '',   '');
		$slug = strtolower( str_replace( $src , $mod , trim( $str ) ) );

		return ereg_replace( '[^0-9a-z_]', '', $slug );
	
	}

	function attachComponent($component, $settings = array ()) {
	
		if (!isset($this->{$component})) {
	
			$this->components[] = $component;
			$this->Component->_loadComponents($this);
	
			if (isset($this->{$component})) {
	
				if (method_exists($this->{$component}, 'initialize')) {
	
					$this->{$component}->initialize($this, $settings);
	
				}
	
				if (method_exists($this->{$component}, 'startup')) {
	
					$this->{$component}->startup($this);
	
				}
	
			}
	
		}
	
	}

	
	function sqlDump() {
	
		App::import( 'Core', 'View' );
		$v = new View( $this );
		return $v->element('sql_dump');
	
	}

	
	// custom view functions
	function _viewFileName( $file ){
		
		$extension = end( explode( '.', $file ) );
		if( $extension != 'ctp' || $xtension != 'thtml' ) $file .= '.ctp';

		if( strpos( $file, DS ) === false ) $file = VIEWS . $this->viewPath . DS . $file;

		return $file;
	
	}

	
	function _viewFileExists( $file ) {
		
		return is_file( $this->_viewFileName( $file ) );
		
	}


	function _renderCustomView( $file ){
		
		$file = $this->_viewFileName( $file );

		if( is_file( $file ) ) {
	
			$this->render( null, null, $file );
	
		}
		
	}
	
	
	function _addClassBrowser($tipo=''){
	
		// Identifica o Browser
		$useragent = $_SERVER['HTTP_USER_AGENT'];
	
		if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
	
			$browser_version=$matched[1];
			//$browser = 'Internet Explorer';
			$browser = 'IE';
	
		} elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
	
			$browser_version=$matched[1];
			$browser = 'Opera';
	
		} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
	
			$browser_version=$matched[1];
			$browser = 'Firefox';
	
		} elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
	
			$browser_version=$matched[1];
			$browser = 'Chrome';
	
		} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
	
			$browser_version=$matched[1];
			$browser = 'Safari';
	
		} else {
			// browser not recognized!
			$browser_version = 0;
			$browser= 'other';
	
		}
        
		if($tipo=='browser'){
	
			return preg_replace("/[.]/","-",strtolower($browser));
	
		}elseif($tipo=='version'){
	
			return preg_replace("/[.]/","-",strtolower("v".$browser_version));
	
		}else{
	
			return preg_replace("/[.]/","-",strtolower($browser." v".$browser_version));
	
		}
	
	}

	
}

?>