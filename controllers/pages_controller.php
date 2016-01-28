<?php

class PagesController extends AppController {


	var $name 		= 'Pages';
	var $uses 		= array( 'Page' );
	var $helpers    = array( 'Html', 'Form', 'Ajax', 'Javascript' );
	var $components = array( 'RequestHandler' );
	
	function display( $section='home', $subsection = null ){
		$view = $section;
		$title = $section;
		if( $subsection ) {
			$view .= '/'. $subsection;
			$title = $subsection;
		}

		if( $section!='home' ) {
			$this->set( 'title_for_layout', Inflector::humanize( $title ) );
			
		} else {
			$this->set( 'title_for_layout', '' );
			$this->redirect( array( 'controller'=>'matriculas', 'action'=>'index' ) );
		}

		$name = $section;
		if( $subsection ) $name .= '/'. $subsection;

		$content = $this->Page->findByName( $name );
		if( $content ) {
			$content = $content['Page'];
			$view = $content['view'];
			$this->set( 'title', $content['title'] );
			$this->set( 'content', $content['content'] );
		}

		$this->set( 'section' , $section );
		$this->set( 'subsection' , $subsection );

		$this->render( $view );
		
	}
	
	function verificar_ano(){

		if ( !empty( $this->data ) ) {

			$anoInicio = $this->data['Page']['ano_inicio'];
			$this->set( 'anoInicio', $anoInicio );

			$anoFinal  = $this->data['Page']['ano_final'];
			$this->set( 'anoFinal', $anoFinal );

		}

		$this->render( 'exercicio_1' );
	
	}
	
	
	function gerar_troco(){

		if ( !empty( $this->data ) ) {

			$valorTotal = $this->data['Page']['valor_total'];
			$this->set( 'valorTotal', $valorTotal );

			$valorPago  = $this->data['Page']['valor_pago'];
			$this->set( 'valorPago', $valorPago );

		}

		$this->render( 'exercicio_2' );

	}
	
	
	function beforeRender(){
	
		parent::beforeRender();

		// apenas renderiza uma pagina da lingua se ela não for a home
		if( isset( $this->params['pass'][0] ) && $this->params['pass'][0]=='home' ) return;

		$locale = $this->Session->read('Config.language');

		if ( $locale && file_exists( VIEWS . $locale . DS . $this->viewPath ) ) {

			$this->viewPath = $locale . DS . $this->viewPath;

		}

	}

}

?>