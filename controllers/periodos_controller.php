<?php

class PeriodosController extends AppController {


	var $name       = 'Periodos';
	var $helpers    = array( 'Html', 'Form', 'Ajax', 'Javascript' );
	var $components = array( 'RequestHandler' );

	
	function index() {

		$this->Periodo->recursive = 0;
		$this->set( 'periodos', $this->paginate() );

		$this->render( 'index' );
	
	}
	
	
	function adicionar() {
	
		if ( !empty( $this->data ) ) {
	
			$this->Periodo->create();
	
			$this->data['Periodo']['created']        = date( 'y-m-d h:i:s' );
			$this->data['Periodo']['ip']             = $_SERVER['REMOTE_ADDR'];
	
			if ( $this->Periodo->save( $this->data ) ) {
	
				$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
				$this->redirect( array( 'action'=>'index' ) );
	
			} else {
	
				$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
			}
	
		}

		$this->render( 'novo' );
	
	}
	
	
	function editar( $id = null ) {
	
		if ( !$id && empty( $this->data ) ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action' => 'index' ) );
	
		}
	
		if ( !empty( $this->data ) ) {
	
			$this->data['Periodo']['created']        = date( 'y-m-d h:i:s' );
			$this->data['Periodo']['ip']             = $_SERVER['REMOTE_ADDR'];
	
			if ( $this->Periodo->save( $this->data ) ) {
	
				$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
				$this->redirect( array( 'action'=>'index' ) );
	
			} else {
	
				$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
			}
	
		}
	
		if ( empty( $this->data ) ) {
	
			$this->Periodo->recursive = 1;
			$this->data = $this->Periodo->read( null, $id );
	
		}

		$this->render( 'editar' );
	
	}


	function delete( $id = null ) {
	
		if ( !$id ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		if ( $this->Periodo->delete( $id ) ) {
	
			$this->_success( __( 'O registro foi excluído com sucesso.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		$this->_error( __( 'O registro não pode ser excluído. Por favor, tente novamente.', true ) );
		$this->redirect( array( 'action' => 'index' ) );
	
	}


}

?>