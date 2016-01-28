<?php

// Define o título
$title = 'Formulário de Cadastro';

// Define o título na página corrente
$this->set( 'title_for_section', $title );

// Define o título como classe na tag <body> Ex.: <body class="bodyInstitucional">
$this->set( 'section', AppController::slug( $title ) );

// Define o caminho de migalhas (pra cada item dentro do array() cria um item no breadcrumb)
$breadcrumb = array(
	'Listar matrículas' => array( 'controller'=>'matriculas', 'action'=>'index' ),
    'Formulário de cadastro' );
$this->set( compact("breadcrumb") );

// Define o CSS que será carregado
$this->Html->css( 'boo', null, array( 'inline'=>false ) );

// Define o JS que será carregado
//$this->Html->script('jquery/jquery-ui.min', false, array( 'inline'=>false ));

?>

<div id="page-content" class="page-content">

	<div class="widget widget-box">

		<div class="widget-header">

			<h4 class="f18">Formulário de cadastro</h4>

		</div>

		<div class="tabbable tabs-top">

			<div class="tab-content">

				<div class="tab-pane active" id="formulario">

					<?php echo $this->Form->create( 'Matricula' );?>

					<fieldset>

					<?php

						echo '<div class="coluna">';

							if( $form->value('Matricula.id') ) echo $form->input('id');

							echo $form->input( 'ativo', array( 'label'=>'Ativo', 'type'=>'checkbox' ) );

							echo $form->input( 'aluno_id', array( 'label'=>'Nome:', 'type'=>'select', 'empty'=>'Selecione', 'options'=>$alunosDisponiveis, 'required'=>true ) );

							echo $form->input( 'curso_id', array( 'label'=>'Curso:', 'type'=>'select', 'options'=>$cursosDisponiveis, 'empty'=>'Selecione', 'required'=>true ) );

							echo $form->input( 'data_matricula', array( 'label'=>'Data da matrícula:', 'placeholder'=>'00/00/0000', 'pattern'=>'^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$', 'type'=>'text', 'required'=>true ) );

							echo $form->input( 'ano', array( 'label'=>'Ano:', 'placeholder'=>'Ex:2016', 'pattern'=>'[0-9]+$', 'required'=>true ) );

							echo $form->input( 'pago', array( 'label'=>'Situação:', 'type'=>'select', 'options'=>$situacaoCadastro, 'empty'=>'Selecione', 'required'=>true ) );

						echo '</div>';

					 ?>

					</fieldset>

					<div class="form-actions">      

						<?php echo $form->submit( 'Salvar', array( 'class'=>'btn btn-blue' ) ); ?>

						<?php echo $this->Html->link( __( 'Novo Cadastro', true ), array( 'controller'=>'matriculas', 'action'=>'adicionar' ), array( 'class'=>'btn cancel' ) ); ?>

						<?php echo $this->Html->link( __( 'Voltar à Listagem', true ), array( 'controller'=>'matriculas', 'action'=>'index' ), array( 'class'=>'btn cancel' ) ); ?>

					</div>

					<?php echo $form->end(); ?>

				</div>

				<script type="text/javascript">

					jQuery(function($){

						$("#MatriculaDataMatricula").mask("99/99/9999");
						$("#MatriculaAno").mask("9999");

					});
	
				</script>

			</div>

		</div>

	</div> 

</div>