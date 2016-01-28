<?php

// Define o título
$title = 'Listar períodos';

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
					<h4 class="title">Períodos</h4>
				</div>
			</div>
			<div class="table-tool">
				<ul class="btn-toolbar pull-left">
					<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'periodos', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>
				</ul>
			</div>
			<div class="tab-content overflow no-padding">
				<div class="tab-pane active" id="tab1A">
					<table class="table boo-table table-striped table-content table-hover">
						<caption>Listagem de periodos cadastrados</caption>
						<thead>
							<tr>
								<th scope="col" class="">Cód.</th>
								<th scope="col">Período</th>
								<th scope="col">Data de cadastro</th>
								<th scope="col"></th>
						   </tr>
						</thead>
						<tbody>
						<?php

							if( !empty( $periodos ) ) {

								$defClass = $class = ' class="altrow"';
								foreach ( $periodos as $linha ):
									$class = $class == $defClass ? '' : $defClass;

						?>
									<tr <?php echo $class;?>>
										<td>
											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Periodo']['id'] ) )?>" class="textoTable">
												<?php echo $linha['Periodo']['id']; ?>
											</a>
										</td>
										<td>
											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Periodo']['id'] ) )?>" class="textoTable">
												<?php echo $linha['Periodo']['nome']; ?>
											</a>
										</td>
										<td>
											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Periodo']['id'] ))?>" class="textoTable">
												<?php echo $formatacao->dataHora( $linha['Periodo']['created'] ); ?>
											</a>
										</td>
										<td class="acoes">
											<?php echo $html->link( __( 'Delete', true ), array( 'controller'=>'periodos', 'action'=>'delete', $linha['Periodo']['id'] ), array( 'class'=>'delete', 'onClick'=>'return confirm("Deseja realmente excluir o registro?")' ) ); ?>
										</td>
									</tr>
						<?php

									endforeach;

								} else {

						?>
									<tr>
										<td colspan="4" class="nenhumRegistro">
											<a href="javascript:;" class="textoTable">Nenhum registro cadastrado!</a>
										</td>
									</tr>
						<?php

								}

						?>
						</tbody>
					</table>
					<?php

						if( !empty( $periodos ) ) {

					?>
							<div class="table-message-info"><?php echo $paginator->counter( array( 'format'=>__( 'Página %page% de %pages%, mostrando %current% registros de um total de %count%, iniciando no registro %start%, e finalizando em %end%', true ) ) ); ?></div>
					<?php

							}

					?>
					<div class="action-table">
						<ul class="btn-toolbar pull-left">
							<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'periodos', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>
						</ul>
						<div class="pagination pagination-boo">
							<ul>
								<li><?php echo $paginator->prev( 'Anterior', array( 'class'=>'prev' ), null, array( 'class'=>'disabled' ) ); ?></li>
								<li><?php echo $paginator->numbers( array( 'separator'=>'' ) );?></li>
								<li><?php echo $paginator->next( 'Próximo', array( 'class'=>'next' ), null, array( 'class'=>'disabled' ) ); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>