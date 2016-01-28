<?php

// Define o título
$title = 'Listar alunos';

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

					<h4 class="title">Alunos</h4>

				</div>

			</div>

			<div class="table-tool">

				<ul class="btn-toolbar pull-left">

					<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'alunos', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>

				</ul>

			</div>

			<div class="tab-content overflow no-padding">

				<div class="tab-pane active" id="tab1A">

					<table class="table boo-table table-striped table-content table-hover">

						<caption>Listagem de alunos cadastrados</caption>

						<thead>

							<tr>

								<th scope="col" width="7%">Cód.</th>

								<th scope="col">CPF</th>

								<th scope="col">Nome</th>

								<th scope="col" width="15%">Data de cadastro</th>

								<th scope="col" colspan="2">Ações</th>

						   </tr>

						</thead>

						<tbody>

						<?php

							if( !empty( $alunos ) ) {

								$defClass = $class = ' class="altrow"';

								foreach ( $alunos as $linha ):

									$class = $class == $defClass ? '' : $defClass;

						?>

									<tr <?php echo $class;?>>

										<td>

											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Aluno']['id'] ) )?>" class="textoTable">

												<?php echo $linha['Aluno']['id']; ?>

											</a>

										</td>

										<td>

											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Aluno']['id'] ) )?>" class="textoTable">

												<?php echo $linha['Aluno']['cpf']; ?>

											</a>

										</td>

										<td>

											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Aluno']['id'] ) )?>" class="textoTable">

												<?php echo $linha['Aluno']['nome']; ?>

											</a>

										</td>

										<td>

											<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Aluno']['id'] ))?>" class="textoTable">

												<?php echo $formatacao->dataHora( $linha['Aluno']['created'] ); ?>

											</a>

										</td>
	
										<td class="acoes">
	
											<?php echo $html->link( __( 'Editar', true ), array( 'action'=>'editar', $linha['Aluno']['id'] ), array( 'class'=>'editar' ) ); ?>
	
										</td>
	
										<td class="acoes">

											<?php echo $html->link( __( 'Delete', true ), array( 'controller'=>'alunos', 'action'=>'delete', $linha['Aluno']['id'] ), array( 'class'=>'delete', 'onClick'=>'return confirm("Deseja realmente excluir o registro?")' ) ); ?>

										</td>

									</tr>

						<?php

									endforeach;

								} else {

						?>

									<tr>

										<td colspan="6" class="nenhumRegistro">

											<a href="javascript:;" class="textoTable">Nenhum registro cadastrado</a>

										</td>

									</tr>

						<?php

								}

						?>

						</tbody>

					</table>

					<?php

						if( !empty( $alunos ) ) {

					?>

							<div class="table-message-info"><?php echo $paginator->counter( array( 'format'=>__( 'Página %page% de %pages%, mostrando %current% registros de um total de %count%, iniciando no registro %start%, e finalizando em %end%', true ) ) ); ?></div>

					<?php

							}

					?>

					<div class="action-table">

						<ul class="btn-toolbar pull-left">

							<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'alunos', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>

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