<?php

class MatriculasController extends AppController {


	var $name       = 'Matriculas';
	var $helpers    = array( 'Html', 'Form', 'Ajax', 'Javascript' );
	var $components = array( 'RequestHandler' );

	
	// Função lista os registro cadastrado na tabela matrículas
	function index() {

		$cursosDisponiveis = $this->Matricula->Curso->find( 'list', array( 'fields'=>array( 'id', 'ficha' ), 'recursive'=>1 ) );
		$this->set( compact( 'cursosDisponiveis' ) );

		// Situação do cadastro
		$situacaoCadastro = array( '1'=>'Pagamento em dia', '2'=>'Pagamento em atraso' );
		$this->set( compact( 'situacaoCadastro' ) );
	
		// Status do cadastro ( ativo ou inativo )
		$statusCadastro = array( '0'=>'Inativo', '1'=>'Ativo' );
		$this->set( compact( 'statusCadastro' ) );
	
		// Filter Results
		$this->FilterResults->addFilters(

			array(

				'curso_id' => array(

					'Matricula.curso_id' => array(

						'value' => $cursosDisponiveis

					)

				),
				'pago' => array(

					'Matricula.pago' => array(

						'value' => $situacaoCadastro

					)

				),
				'ativo' => array(

					'Matricula.ativo' => array(

						'value' => $statusCadastro

					)

				)

			)

		);

		$this->paginate['contain'] = array( 'Aluno', 'Curso' );
	
		$this->paginate['fields'] = array(

			'Matricula.id', 'Matricula.data_matricula', 'Matricula.ativo', 'Matricula.pago', 'Matricula.pago', 'Matricula.created',
			'Curso.id', 'Curso.nome',
			'Aluno.id', 'Aluno.nome'

		);
	
		$this->paginate['limit'] = 20;

		$this->paginate['conditions'] = array( $this->FilterResults->make(), 'Matricula.ativo'=>1 );
		
		$this->set( 'matriculas', $this->paginate() );

		// Select Status
		$selectStatus = array( '0'=>'Inativo', '1'=>'Ativo' );
		$this->set( 'selectStatus', $selectStatus );

		$this->render( 'index' );
	
	}

	
	// Função Adicionar novo registro
	function adicionar() {
	
		if ( !empty( $this->data ) ) {

			//Converte data no formato brasileiro para americando antes de salvar no banco
			if( !empty( $this->data['Matricula']['data_matricula'] ) ) {

				$dataMatricula          = explode('/',$this->data['Matricula']['data_matricula']);
				$dataMatriculaAmericano = $dataMatricula[2].'-'.$dataMatricula[1].'-'.$dataMatricula[0];
	
				$this->data['Matricula']['data_matricula'] = $dataMatriculaAmericano;
	
			}
	
			$this->Matricula->create();
	
			$this->data['Matricula']['created']        = date( 'y-m-d h:i:s' );
			$this->data['Matricula']['ip']             = $_SERVER['REMOTE_ADDR'];
	
			if ( $this->Matricula->save( $this->data ) ) {
	
				$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
				$this->redirect( array( 'action'=>'index' ) );
	
			} else {
	
				$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
			}
	
		}

		// Carrega os alunos cadastrados
		$alunosDisponiveis = $this->Matricula->Aluno->find( 'list', array( 'fields'=>array( 'Aluno.id', 'Aluno.nome' ), 'order'=>array( 'nome ASC' ) ) );
		$this->set( 'alunosDisponiveis', $alunosDisponiveis );
	
		// Carrega os cursos disponíveis
		$cursosDisponiveis = $this->Matricula->Curso->find( 'list', array( 'fields'=>array( 'id', 'ficha' ), 'recursive'=>1 ) );
		$this->set( compact( 'cursosDisponiveis' ) );
		
		// Situação do cadastro
		$situacaoCadastro = array( '1'=>'Pagamento em dia', '2'=>'Pagamento em atraso' );
		$this->set( 'situacaoCadastro', $situacaoCadastro );
	
		$this->render( 'novo' );
	
	}
	
	
	// Função editar registro já cadastrado no banco de dados
	function editar( $id = null ) {
	
		if ( !$id && empty( $this->data ) ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action' => 'index' ) );
	
		}
	
		if ( !empty( $this->data ) ) {
	
			//Converte data no formato brasileiro para americando antes de salvar no banco
			if( !empty( $this->data['Matricula']['data_matricula'] ) ) {

				$dataMatricula          = explode('/',$this->data['Matricula']['data_matricula']);
				$dataMatriculaAmericano = $dataMatricula[2].'-'.$dataMatricula[1].'-'.$dataMatricula[0];
	
				$this->data['Matricula']['data_matricula'] = $dataMatriculaAmericano;
	
			}
	
			$this->data['Matricula']['created']        = date( 'y-m-d h:i:s' );
			$this->data['Matricula']['ip']             = $_SERVER['REMOTE_ADDR'];
	
			if ( $this->Matricula->save( $this->data ) ) {
	
				$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
				$this->redirect( array( 'action'=>'index' ) );
	
			} else {
	
				$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
			}
	
		}
	
		if ( empty( $this->data ) ) {
	
			//$this->Matricula->recursive = 1;
			$this->data = $this->Matricula->read( null, $id );
	
			// Converte a data da matrícula para o formato brasileiro
			if( !empty( $this->data['Matricula']['data_matricula'] ) ){
	
				$this->data['Matricula']['data_matricula'] = date( 'd/m/Y', strtotime( $this->data['Matricula']['data_matricula'] ) );

			}
	
		}
	
		// Carrega os alunos cadastrados
		$alunosDisponiveis = $this->Matricula->Aluno->find( 'list', array( 'fields'=>array( 'Aluno.id', 'Aluno.nome' ), 'order'=>array( 'nome ASC' ) ) );
		$this->set( 'alunosDisponiveis', $alunosDisponiveis );
	
		// Carrega os cursos disponíveis
		$cursosDisponiveis = $this->Matricula->Curso->find( 'list', array( 'fields'=>array( 'id', 'ficha' ), 'recursive'=>1 ) );
		$this->set( compact( 'cursosDisponiveis' ) );

		// Situação do cadastro
		$situacaoCadastro = array( '1'=>'Pagamento em dia', '2'=>'Pagamento em atraso' );
		$this->set( 'situacaoCadastro', $situacaoCadastro );
	
		$this->render( 'editar' );
	
	}
	
	
	// Função deleta o registro no banco de dados
	function delete( $id = null ) {

		if ( !$id ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		if ( $this->Matricula->delete( $id ) ) {
	
			$this->_success( __( 'O registro foi excluído com sucesso.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		$this->_error( __( 'O registro não pode ser excluído. Por favor, tente novamente.', true ) );
		$this->redirect( array( 'action' => 'index' ) );
	
	}
	
	
	function status(){
		$this->layout = 'Ajax';
		$matriculaId = $this->params['url']['matricula_id'];
		$statusAtual = $this->params['url']['status'];
		if( $statusAtual == 0 ) {
			$this->Matricula->query("UPDATE matriculas SET ativo = 1 WHERE id = $matriculaId");
			die;
		} else {
			$this->Matricula->query( "UPDATE matriculas SET ativo = 0 WHERE id =".$matriculaId );
			die;
		}
	}
	
	
	// Função buscar nome no banco de dados
	function buscar(){

		// Recebe o valor via POST
		$nomeAluno = isset( $this->data['Matricula']['Procurar Por:'] ) ? $this->data['Matricula']['Procurar Por:'] : '';
	
		// Carrega os cursos disponíveis
		$cursosDisponiveis = $this->Matricula->Curso->find( 'list', array( 'fields'=>array( 'id', 'ficha' ), 'recursive'=>1 ) );
		$this->set( compact( 'cursosDisponiveis' ) );

		// Situação do cadastro
		$situacaoCadastro = array( '1'=>'Pagamento em dia', '2'=>'Pagamento em atraso' );
		$this->set( 'situacaoCadastro', $situacaoCadastro );

		// Select Status
		$selectStatus = array( '0'=>'Inativo', '1'=>'Ativo' );
		$this->set( 'selectStatus', $selectStatus );
	
		// Filter Results
		$this->FilterResults->addFilters(

			array(

				'curso_id' => array(

					'Matricula.curso_id' => array(

						'value' => $cursosDisponiveis

					)

				),
				'pago' => array(

					'Matricula.pago' => array(

						'value' => $situacaoCadastro

					)

				),
				'ativo' => array(

					'Matricula.ativo' => array(

						'value' => $selectStatus

					)

				)

			)

		);
		
		$this->FilterResults->make();

		// Efetua a busca no banco
		$resultadoBusca = $this->Matricula->find( 'all', array( 'fields'=>array( 'Matricula.id', 'Matricula.data_matricula', 'Matricula.ativo', 'Matricula.pago', 'Matricula.pago', 'Matricula.created','Curso.id', 'Curso.nome', 'Aluno.id', 'Aluno.nome' ),
																'contain'=>array( 'Aluno', 'Curso' ),
																'conditions'=>array(  'Aluno.nome LIKE'=>"%$nomeAluno%" ) ) );
		$this->set( 'resultadoBusca', $resultadoBusca );

		$this->render( 'resultado' );

	}
	
	
}

?>