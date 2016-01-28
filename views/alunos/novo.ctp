<?php

// Define o título
$title = 'Formulário de Cadastro';

// Define o título na página corrente
$this->set( 'title_for_section', $title );

// Define o título como classe na tag <body> Ex.: <body class="bodyInstitucional">
$this->set( 'section', AppController::slug( $title ) );

// Define o caminho de migalhas (pra cada item dentro do array() cria um item no breadcrumb)
$breadcrumb = array(
	'Listar alunos' => array( 'controller'=>'alunos', 'action'=>'index' ),
    'Formulário de cadastro' );
$this->set( compact("breadcrumb") );

// Define o CSS que será carregado
$this->Html->css( 'boo', null, array( 'inline'=>false ) );

?>

<div id="page-content" class="page-content">

	<div class="widget widget-box">

		<div class="widget-header">

			<h4 class="f18">Formulário de cadastro</h4>

		</div>

		<div class="tabbable tabs-top">

			<div class="tab-content">

				<div class="tab-pane active" id="formulario">

					<?php echo $this->Form->create( 'Aluno' );?>

					<fieldset>

					<?php

						echo '<div class="coluna">';

							if( $form->value('Aluno.id') ) echo $form->input('id');

							echo $form->input( 'cpf', array( 'label'=>'CPF:', 'placeholder'=>'000.000.000-00', 'pattern'=>'^(\d{3}\.\d{3}\.\d{3}-\d{2})|(\d{11})$', 'required'=>true ) );

							echo '<div class="error-message" style="display:none">Atenção, já existe um aluno cadastrado com esse CPF.</div>';

							echo $form->input( 'rg', array( 'label'=>'RG:', 'placeholder'=>'RG', 'pattern'=>'[0-9]+$', 'required'=>true ) );

							echo $form->input( 'data_nascimento', array( 'label'=>'Data de nascimento:', 'placeholder'=>'00/00/0000', 'pattern'=>'^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$', 'type'=>'text', 'required'=>true ) );

							echo $form->input( 'nome', array( 'label'=>'Nome:', 'placeholder'=>'Nome', 'required'=>true ) );

							echo $form->input( 'telefone', array( 'label'=>'Telefone:', 'placeholder'=>'(00)0000-0000', 'required'=>true ) );

						echo '</div>';
	
					?>

					</fieldset>

					<div class="form-actions">      

						<?php echo $form->submit( 'Salvar', array( 'class'=>'btn btn-blue' ) ); ?>

						<?php echo $this->Html->link( __( 'Voltar à Listagem', true ), array( 'controller'=>'alunos', 'action'=>'index' ), array( 'class'=>'btn cancel' ) ); ?>

					</div>

					<?php echo $form->end(); ?>

				</div>

				<script type="text/javascript">
	
					jQuery(function($){

						// Mascaras
						$("#AlunoCpf").mask("999.999.999-99");
						$("#AlunoDataNascimento").mask("99/99/9999");
						$("#AlunoTelefone").mask("(99)9999-9999");
	
					});
	
				</script>

			</div>

		</div>

	</div> 

</div>