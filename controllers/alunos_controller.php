<?php

class AlunosController extends AppController {


	var $name       = 'Alunos';
	var $helpers    = array( 'Html', 'Form', 'Ajax', 'Javascript' );
	var $components = array( 'RequestHandler' );

	
	// Lista os registros disponíveis no banco de dados
	function index() {

		$this->Aluno->recursive = 0;
	
		$this->set( 'alunos', $this->paginate() );
	
		$this->render( 'index' );
	
	}
	
	
	// Função adicionar novo cadastro no banco de dados
	function adicionar() {

		if ( !empty( $this->data ) ) {

			// 1º Passo
			// Verifica se existe usuário cadastrado com o cpf digitado
			$verificaDisponibilidadeCpf = $this->Aluno->find( 'first', array( 'conditions'=>array( 'Aluno.cpf'=>$this->data['Aluno']['cpf'] ) ) );
	
			if( $verificaDisponibilidadeCpf == true ) {

				$this->_error( __( 'Já existe um aluno matrículado com o mesmo CPF.', true ) );

			} else {
	
				// 2° Passo
				// Verifica se CPF é válido
				$verificarCPF = $this->validaCPF( $this->data['Aluno']['cpf'] );

				//echo $isCpfValid;
				if( $verificarCPF == true ) {

					// 3º Passo
					$this->Aluno->create();

					//Converte data no formato brasileiro para americando antes de salvar no banco
					if( !empty( $this->data['Aluno']['data_nascimento'] ) ) {
	
						$dataNascimento          = explode('/',$this->data['Aluno']['data_nascimento']);
						$dataNascimentoAmericano = $dataNascimento[2].'-'.$dataNascimento[1].'-'.$dataNascimento[0];

						$this->data['Aluno']['data_nascimento'] = $dataNascimentoAmericano;

					}
	
					$this->data['Aluno']['created']        = date( 'y-m-d h:i:s' );
					$this->data['Aluno']['ip']             = $_SERVER['REMOTE_ADDR'];
	
					if ( $this->Aluno->save( $this->data ) ) {
	
						$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
						$this->redirect( array( 'controller'=>'alunos', 'action'=>'index' ) );
	
					} else {
	
						$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
					}
	
				} else {
	
					$this->_error( __( 'Por favor, tente novamente. Insira um CPF válido.', true ) );
	
				}
	
			}

		}
	
		$this->render( 'novo' );
	
	}
	
	
	// Função editar registro já cadastrado no banco de dados
	function editar( $id = null ) {
	
		if ( !$id && empty( $this->data ) ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action' => 'index' ) );
	
		}
	
		if ( !empty( $this->data ) ) {
	
			$this->data['Aluno']['created']        = date( 'y-m-d h:i:s' );
			$this->data['Aluno']['ip']             = $_SERVER['REMOTE_ADDR'];
	
			if ( $this->Aluno->save( $this->data ) ) {
	
				$this->_success( __( 'O registro foi salvo com sucesso.', true ) );
				$this->redirect( array( 'action'=>'index' ) );
	
			} else {
	
				$this->_error( __( 'O registro não pode ser salvo. Por favor, tente novamente.', true ) );
	
			}
	
		}
	
		if ( empty( $this->data ) ) {
	
			$this->Aluno->recursive = 1;
			$this->data = $this->Aluno->read( null, $id );

			// Converte a data de nascimento para o formato brasileiro
			if( !empty( $this->data['Aluno']['data_nascimento'] ) ){
	
				$this->data['Aluno']['data_nascimento'] = date( 'd/m/Y', strtotime( $this->data['Aluno']['data_nascimento'] ) );

			}
	
		}
	
		$this->render( 'editar' );
	
	}
	

	// Função delete registro do banco de dados
	function delete( $id = null ) {
	
		if ( !$id ) {
	
			$this->_error( __( 'Registro inválido.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}
	
		if ( $this->Aluno->delete( $id ) ) {
	
			$this->_success( __( 'O registro foi excluído com sucesso.', true ) );
			$this->redirect( array( 'action'=>'index' ) );
	
		}

		$this->_error( __( 'O registro não pode ser excluído. Por favor, tente novamente.', true ) );
		$this->redirect( array( 'action'=>'index' ) );

	}
	
	
	// Função que verifica se CPF é válido ou não
	function validaCPF( $cpf = null ) {
 
		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'){
	
			return false;
	
		}else{
	
			// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
	
				for ($d = 0, $c = 0; $c < $t; $c++) {
	
					$d += $cpf{$c} * (($t + 1) - $c);
	
				}
	
				$d = ((10 * $d) % 11) % 10;
	
				if ($cpf{$c} != $d) {
	
					return false;
	
				}
	
			}
	
			return true;
	
		}
	
	}
	
	
}

?>