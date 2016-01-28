<?php

// Define o título
$title = 'Exercício 2 - Algoritmo para gerar melhor opção de troco';

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

					<h4 class="title">Exercício 2</h4>

				</div>

			</div>

			<div class="table-tool" style="padding: 10px; font-weight:normal;">

				<p>1.2 Funcionários de empresas comerciais que trabalham como caixa tem uma grande responsabilidade em suas mãos. A maior parte do tempo de seu expediente de trabalho é gasto recebendo valores de clientes e, em alguns casos, fornecendo troco.</p>
	
				<p></p>Seu desafio é fazer um programa que leia o valor total a ser pago e o valor efetivamente pago, informando o menor número de cédulas e moedas que devem ser fornecidas como troco.</p>

				<p>Deve-se considerar que há:</p>

				<p>	● cédulas de R$100,00, R$50,00, R$10,00, R$5,00 e R$1,00.</p>

				<p>	● moedas de R$0,50, R$0,10, R$0,05 e R$0,01.</p>

				<div class="buscaAvancada" style="float: left; height: 137px;">

					<?php

						echo $form->create( 'Page', array( 'action'=>'gerar_troco' ) );

						echo $form->input( 'valor_pago', array( 'label'=>'Valor pago:', 'placeholder'=>'R$ 0,00', 'required'=>true ) );
	
						echo $form->input( 'valor_total', array( 'label'=>'Valor da nota:', 'placeholder'=>'R$ 0,00', 'required'=>true ) );

						echo $form->submit( 'Consultar', array( 'class'=>'btn btn-blue' ) );

						echo $this->Html->link( __( 'Nova consulta', true ), array( 'controller'=>'pages', 'action'=>'gerar_troco' ), array( 'class'=>'btn cancel' ) );

						echo $form->end();
	
					?>

				</div>

				<script type="text/javascript">

					jQuery(function($){

						$("#PageValorPago").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
						$("#PageValorTotal").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

					});

				</script>

			</div>

			<?php

				if( !empty( $valorTotal ) && !empty( $valorPago ) ) {

			?>

					<div class="tab-content overflow no-padding">

						<div class="tab-pane active" id="tab1A">

							<table class="table boo-table table-striped table-content table-hover">

								<caption>Resultado da consulta</caption>

								<thead>

									<tr>

										<th scope="col">Quantidade de cédulas</th>

										<th scope="col">Valor</th>

								   </tr>

								</thead>

								<tbody>

								<?php
	
									if( !empty( $valorTotal ) && !empty( $valorPago ) ) {

										$valorTroco = $formatacao->simulaTroco( $valorTotal, $valorPago );
	
										$valorTrocoFormatado = number_format( $valorTroco, 2, ",", "." );
	
										echo "<div class='resposta'>Valor a ser pago: ".'<strong>R$'."$valorTotal </strong><br>Valor recebido: ".'<strong>R$'."$valorPago </strong><br>Valor do troco: ".'<strong>R$'."$valorTrocoFormatado</strong></div>";
	
										$listaTroco = $formatacao->listaTroco($valorTroco);

										$listaTroco = array_map( 'strval', $listaTroco); 
	
										$contagem = array_count_values($listaTroco);
	
											$defClass = $class = ' class="altrow"';
	
											foreach( $contagem AS $valor => $numero ) {
	
											$class = $class == $defClass ? '' : $defClass;		
	
								?>
	
											<tr <?php echo $class;?>>
	
												<td>
	
													<a href="javascript:;" class="textoTable">
	
														<?=$numero?>
	
													</a>
	
												</td>
	
												<td>
	
													<a href="javascript:;" class="textoTable">
	
														<?php echo "R$ ".number_format( $valor, 2, ",", "." ); ?>
	
													</a>
	
												</td>
	
											</tr>
	
								<?php
	
										}
	
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