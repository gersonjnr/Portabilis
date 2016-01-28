<?php

// Define o título
$title = 'Exercício 1 - Algoritmo para verificação de ano bissexto';

// Define o título na página corrente
$this->set( 'title_for_section', $title );

// Define o título como classe na tag <body> Ex.: <body class="bodyInstitucional">
$this->set( 'section', AppController::slug( $title ) );

// Define o caminho de migalhas (pra cada item dentro do array() cria um item no breadcrumb)
$breadcrumb = array( __( $title, true ) => array( 'action'=>'index' ) );
$this->set( compact( "breadcrumb" ) );

// Define o CSS que será carregado
$this->Html->css( 'boo', null, array( 'inline'=>false ) );

?>

<div id="page-content" class="page-content">

	<section>

		<div class="well well-nice well-box no-border">

			<div class="navbar">

				<div class="navbar-inner">

					<h4 class="title">Exercício 1</h4>

				</div>

			</div>

			<div class="table-tool" style="padding: 10px; font-weight:normal;">

				<p>1 A cada 4 anos, a diferença de horas entre o ano solar e o do calendário convencional completa cerca de 24 horas (mais precisamente 23 horas, 15 minutos e 864 milésimos de segundo). Para compensar essa diferença e evitar um descompasso em relação às estações do ano, insere-se um dia extra no calendário e o mês de fevereiro passar a conter 29 dias. Essa correção é especialmente importante para atividades atreladas às estações, como a agricultura e até mesmo as festas religiosas. Um determinado ano é bissexto se: O ano for divisível por 4, mas não divisível por 100, exceto se ele for também divisível por 400. Exemplos:</p>

				<p>	● São bissextos por exemplo: (1600, 1732, 1888, 1944, 2008).</p>

				<p>	● Não são bissextos por exemplo: (1742, 1889, 1951, 2011).</p>

				<p>	Escreva uma função que determina se um determinado ano informado é bissexto ou não. </p>
	
				<div class="buscaAvancada" style="float: left; height: 135px;">

					<?php

						echo $form->create( 'Page', array( 'action'=>'verificar_ano' ) );

						echo $form->input( 'ano_inicio', array( 'label'=>'Digite o ano inícial:', 'placeholder'=>'2000', 'pattern'=>'[0-9]+$', 'maxlength'=>4, 'required'=>true ) );

						echo $form->input( 'ano_final', array( 'label'=>'Digite o ano final:', 'placeholder'=>'2016', 'pattern'=>'[0-9]+$', 'maxlength'=>4, 'required'=>true ) );

						echo $form->submit( 'Consultar', array( 'class'=>'btn btn-blue' ) );

						echo $this->Html->link( __( 'Nova consulta', true ), array( 'controller'=>'pages', 'action'=>'verificar_ano' ), array( 'class'=>'btn cancel' ) );

						echo $form->end();
	
					?>

				</div>
	
			</div>

			<?php

				if( !empty( $anoInicio ) &&  !empty( $anoFinal ) ) {

			?>

				<div class="tab-content overflow no-padding">

					<div class="tab-pane active" id="tab1A">

						<table class="table boo-table table-striped table-content table-hover">

							<caption>Resultado da consulta</caption>

							<thead>

								<tr>

									<th scope="col">Ano</th>

									<th scope="col">Bissexto</th>

							   </tr>

							</thead>

							<tbody>

							<?php
	
									$defClass = $class = ' class="altrow"';
		
									for ( $i = $anoInicio; $i <= $anoFinal; $i++ ) {
	
										$class = $class == $defClass ? '' : $defClass;
	
							?>

										<tr <?php echo $class;?>>

											<td>

												<a href="javascript:;" class="textoTable">

													<?php echo $i; ?>

												</a>

											</td>

											<td>

												<a href="javascript:;" class="textoTable">

													<?php

															$bissexto = $formatacao->verificaBissexto($i) ? "Sim" : "Não";
															echo $bissexto;

													?>

												</a>

											</td>

										</tr>

							<?php
	
									}

							?>

							</tbody>

						</table>

					</div>

				</div>

			<?php

				}

			?>

		</div>

	</section>

</div>