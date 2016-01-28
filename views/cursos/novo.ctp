<?php

// Define o título
$title = 'Formulário de Cadastro';

// Define o título na página corrente
$this->set( 'title_for_section', $title );

// Define o título como classe na tag <body> Ex.: <body class="bodyInstitucional">
$this->set( 'section', AppController::slug( $title ) );

// Define o caminho de migalhas (pra cada item dentro do array() cria um item no breadcrumb)
$breadcrumb = array(
	'Listar cursos' => array( 'controller'=>'cursos', 'action'=>'index' ),
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

					<?php echo $this->Form->create( 'Curso' );?>

					<fieldset>

					<?php

						echo '<div class="coluna">';

							if( $form->value('Curso.id') ) echo $form->input('id');

							echo $form->input( 'nome', array( 'label'=>'Curso:', 'placeholder'=>'Curso', 'required'=>true ) );

							echo $form->input( 'periodo_id', array( 'label'=>'Período:', 'type'=>'select', 'options'=>$periodosDisponiveis, 'empty'=>'Selecione', 'required'=>true ) );

							echo $form->input( 'valor_inscricao', array( 'label'=>'Valor:', 'placeholder'=>'R$0,00', 'required'=>true ) );

						echo '</div>';
	
					?>

					</fieldset>

					<div class="form-actions">      

						<?php echo $form->submit( 'Salvar', array( 'class'=>'btn btn-blue' ) ); ?>

						<?php echo $this->Html->link( __( 'Voltar à Listagem', true ), array( 'controller'=>'cursos', 'action'=>'index' ), array( 'class'=>'btn cancel' ) ); ?>

					</div>

					<?php echo $form->end(); ?>

				</div>

				<script type="text/javascript">

					jQuery(function($){

						$("#CursoValorInscricao").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

					});

				</script>

			</div>

		</div>

	</div> 

</div>