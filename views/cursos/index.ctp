<?php

// Define o título
$title = 'Listar cursos';

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

					<h4 class="title">Cursos</h4>

				</div>

			</div>

			<div class="table-tool">

				<ul class="btn-toolbar pull-left">

					<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'cursos', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>

				</ul>

			</div>

			<div class="tab-content overflow no-padding">

				<div class="tab-pane active" id="tab1A">

					<table class="table boo-table table-striped table-content table-hover">

							<caption>Listagem de cursos cadastrados</caption>

							<thead>

									 <tr>

											<th scope="col" width="7%">Cód.</th>

											<th scope="col">Curso</th>

											<th scope="col">Período</th>

											<th scope="col">Valor</th>

											<th scope="col" width="15%">Data de cadastro</th>

											<th scope="col" colspan="2">Ações</th>

									</tr>

							</thead>

							<tbody>

							<?php

								if( !empty( $cursos ) ) {

									$defClass = $class = ' class="altrow"';

									foreach ( $cursos as $linha ):

										$class = $class == $defClass ? '' : $defClass;

							?>

										<tr <?php echo $class;?>>

											<td>

												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Curso']['id'] ) )?>" class="textoTable">

													<?php echo $linha['Curso']['id']; ?>

												</a>

											</td>

											<td>

												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Curso']['id'] ) )?>" class="textoTable">

													<?php echo $linha['Curso']['nome']; ?>

												</a>

											</td>

											<td>

												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Curso']['id'] ) )?>" class="textoTable">

													<?php echo $linha['Periodo']['nome']; ?>

												</a>

											</td>

											<td>

												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Curso']['id'] ) )?>" class="textoTable">

													<?php echo "R$ ".number_format( $linha['Curso']['valor_inscricao'], 2, ",", "." ); ?>

												</a>

											</td>

											<td>

												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Curso']['id'] ))?>" class="textoTable">

													<?php echo $formatacao->dataHora( $linha['Curso']['created'] ); ?>

												</a>

											</td>

											<td class="acoes">
	
												<?php echo $html->link( __( 'Editar', true ), array( 'action'=>'editar', $linha['Curso']['id'] ), array( 'class'=>'editar' ) ); ?>
		
											</td>

											<td class="acoes">

												<?php echo $html->link( __( 'Delete', true ), array( 'controller'=>'cursos', 'action'=>'delete', $linha['Curso']['id'] ), array( 'class'=>'delete', 'onClick'=>'return confirm("Deseja realmente excluir o registro?")' ) ); ?>

											</td>

										</tr>

							<?php
	
									endforeach;

								} else {
	
							?>

										<tr>

											<td colspan="7" class="nenhumRegistro">

												<a href="javascript:;" class="textoTable">Nenhum registro cadastrado</a>

											</td>

										</tr>

							<?php
	
									}
	
							?>

							</tbody>

					</table>

					<?php

						if( !empty( $cursos ) ) {

					?>

							<div class="table-message-info"><?php echo $paginator->counter( array( 'format'=>__( 'Página %page% de %pages%, mostrando %current% registros de um total de %count%, iniciando no registro %start%, e finalizando em %end%', true ) ) ); ?></div>

					<?php

							}

					?>

					<div class="action-table">

						<ul class="btn-toolbar pull-left">

							<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'alunos', 'action'=>'novo' ) )?>">Novo Cadastro</a></li>

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