<?php

class CursosController extends AppController {


	var $name    = 'Cursos';
	var $helpers = array( 'Html', 'Form' );

	
	// Função lista todos registros cadastrados no banco de dados
	function index() {

		$this->Curso->recursive = 0;
	
		$this->set( 'cursos', $this->paginate() );
	
		$this->render( 'index' );
	
	}
	
	
	// Função adicionar novo registro no banco de dados
	function adicionar() {
	
		if ( !empty( $this->data ) ) {

			// 1° Passo: verifica se o mesmo curso já está cadastrado com o mesmo período no banco de dados para
			$verifica = $this->Curso->find( 'first', array( 'conditions'=>array( 'Curso.nome'=>$this->data['Curso']['nome'], 'periodo_id'=>$this->data['Curso']['periodo_id'] ) ) );

			if( $verifica == true ) {
	
				$this->_error( __( 'O registro não pode ser salvo. Este curso já está cadastrado com o mesmo período selecionado.', true ) );
	
			} else {
	
				// Formata o valor real para formato americano antes de gravar no banco
				$this->data['Curso']['valor_inscricao'] = $this->formatarMoedaModoAmericano( $this->data['Curso']['valor_inscricao'] );
	
				$this->Curso->create();
	
				$this->data['Curso']['created']        = date( 'y-m-d h:i:s' );
				$this->data['Curso']['ip']             = $_SERVER['REMOTE_ADDR'];
	
				if ( $this->Curso->save( $this->data ) ) {
	
					$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
					$this->redirect( array( 'action'=>'index' ) );
	
				} else {
	
					$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
				}
	
			}
	
		}

		// Busca os períodos cadastrados no banco de dados
		$periodosDisponiveis = $this->Curso->Periodo->find( 'list', array( 'fields'=>array( 'Periodo.id', 'Periodo.nome' ), 'order'=>array( 'nome ASC' ) ) );
		$this->set( 'periodosDisponiveis', $periodosDisponiveis );

		$this->render( 'novo' );
	
	}
	
	
	// Função editar registro cadastrado no banco de dados
	function editar( $id = null ) {
	
		if ( !$id && empty( $this->data ) ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action' => 'index' ) );
	
		}
		
		if ( !empty( $this->data ) ) {
	
			// 1° Passo: verifica se o mesmo curso já está cadastrado com o mesmo período no banco de dados para
			$verifica = $this->Curso->find( 'first', array( 'conditions'=>array( 'Curso.nome'=>$this->data['Curso']['nome'], 'periodo_id'=>$this->data['Curso']['periodo_id'], 'Curso.id !='=>$this->data['Curso']['id'] ) ) );
	
			if( $verifica == true ) {
	
				$this->_error( __( 'O registro não pode ser salvo. Este curso já está cadastrado com o mesmo período selecionado.', true ) );
	
			} else {
	
				// Formata o valor real para formato americano antes de gravar no banco
				$this->data['Curso']['valor_inscricao'] = $this->formatarMoedaModoAmericano( $this->data['Curso']['valor_inscricao'] );
	
				$this->Curso->create();
	
				$this->data['Curso']['created']        = date( 'y-m-d h:i:s' );
				$this->data['Curso']['ip']             = $_SERVER['REMOTE_ADDR'];
	
				if ( $this->Curso->save( $this->data ) ) {
	
					$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
					$this->redirect( array( 'action'=>'index' ) );
	
				} else {
	
					$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
				}
			}

		}
	
		if ( empty( $this->data ) ) {
	
			$this->Curso->recursive = 1;
			$this->data = $this->Curso->read( null, $id );
	
		}

		// Busca os períodos cadastrados no banco de dados
		$periodosDisponiveis = $this->Curso->Periodo->find( 'list', array( 'fields'=>array( 'Periodo.id', 'Periodo.nome' ), 'order'=>array( 'nome ASC' ) ) );
		$this->set( 'periodosDisponiveis', $periodosDisponiveis );
	
		$this->render( 'editar' );
	
	}

     
	// Função deleta registro cadastrado no banco de dados
	function delete( $id = null ) {
	
		if ( !$id ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		if ( $this->Curso->delete( $id ) ) {
	
			$this->_success( __( 'O registro foi excluído com sucesso.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		$this->_error( __( 'O registro não pode ser excluído. Por favor, tente novamente.', true ) );
		$this->redirect( array( 'action' => 'index' ) );
	
	}
	
	
	// Função que formata o valor do input escrito em real para o formato americano
	function formatarMoedaModoAmericano( $valor ){

		// Pega apenas as partes numéricas
		$partes = array_filter(preg_split("/([\D])/", $valor), 'strlen');
	
		// Separa a fração do inteiro
		$frac = count($partes) > 1 ? array_pop($partes) : "0";
		$inteiro = implode("", $partes);
	
		// Junta tudo, converte para ponto-flutuante e arredondanda
		return round((float) ($inteiro . "." . $frac), 2);
	
	}


}

?>