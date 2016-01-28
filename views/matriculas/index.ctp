<?php

// Define o título
$title = 'Listar matrículas';

// Define o título na página corrente
$this->set( 'title_for_section', $title );

// Define o título como classe na tag <body> Ex.: <body class="bodyInstitucional">
$this->set( 'section', AppController::slug( $title ) );

// Define o caminho de migalhas (pra cada item dentro do array() cria um item no breadcrumb)
$breadcrumb = array( __( $title, true ) => array( 'action'=>'index' ) );
$this->set( compact( "breadcrumb" ) );

// Define o CSS que será carregado
$this->Html->css( 'boo', null, array( 'inline'=>false ) );

// Define o JS que será carregado
$this->Html->script( 'jquery/jquery.iphoneSwitch', false, array( 'inline'=>false ) );

?>

<div id="page-content" class="page-content">

	<section>

		<div class="well well-nice well-box no-border">

			<div class="navbar">

				<div class="navbar-inner">

					<h4 class="title">Matrículas</h4>

				</div>

			</div>

			<div class="table-tool">
	
				<ul class="btn-toolbar pull-left">

					<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'matriculas', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>

				</ul>
	
				<div class="buscaAvancada">

					<?php

						echo $form->create( 'Matricula', array( 'action'=>'buscar' ) );

						echo $form->input( 'Procurar Por:', array( 'id'=>'nome', 'type'=>'text', 'required'=>true, 'placeholder'=>'Nome' ));

						echo $form->submit( 'Salvar', array( 'class'=>'btn btn-blue' ) );

						echo $form->end();
	
					?>
	
					<h3 class="filter">Busca Avançada</h3>
	
					<div id="exibeBusca">
	
						<?=$this->FilterForm->create($FilterResults)?>

						<fieldset>

						<?php

							echo '<div class="colunaFormA">';
	
								echo '<div class="input select">';

									echo $this->FilterForm->input( 'curso_id', array( 'label'=>'Cursos:', 'type'=>'select', 'options'=>$cursosDisponiveis, 'empty'=>'Selecione' ) );

								echo '</div>';
	
								echo '<div class="input select">';

									echo $this->FilterForm->input( 'pago', array( 'label'=>'Situação:', 'type'=>'select', 'options'=>$situacaoCadastro, 'empty'=>'Selecione' ) );

								echo '</div>';
	
								echo '<div class="input select">';

									echo $this->FilterForm->input( 'ativo', array( 'label'=>'Status:', 'type'=>'select', 'options'=>$statusCadastro, 'empty'=>'Selecione' ) );

								echo '</div>';
	
							echo '</div>';
	
						?>
	
						</fieldset> 
	
						<div class="form-actions">   
	
						<?php
	
							echo $this->FilterForm->submit( __( 'Filtrar Dados', true ), array( 'class'=>'btn btn-blue' ) );
	
						?>
	
						</div>   

						<?php echo $this->FilterForm->end(); ?>
	
					</div>
	
				</div>
	
			</div>
	
			<div class="tab-content overflow no-padding">
	
				<div class="tab-pane active" id="tab1A">

					<table class="table boo-table table-striped table-content table-hover">
	
							<caption>Listagem de matrículas cadastrados</caption>
	
							<thead>
	
									 <tr>
	
											<th scope="col" width="7%">Cód.</th>
	
											<th scope="col">Aluno</th>
	
											<th scope="col">Curso</th>
	
											<th scope="col">Situação</th>

											<th scope="col" width="15%">Data de cadastro</th>
	
											<th scope="col" colspan="2">Ações</th>
	
									</tr>
	
							</thead>
	
							<tbody>
	
							<?php

								if( !empty( $matriculas ) ) {

									$defClass = $class = ' class="altrow"';
	
									foreach ( $matriculas as $linha ):

										$class = $class == $defClass ? '' : $defClass;

							?>
	
										<tr <?php echo $class;?>>
	
											<td>
	
												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Matricula']['id'] ) )?>" class="textoTable">
	
													<?php echo $linha['Matricula']['id']; ?>
	
												</a>
	
											</td>
	
											<td>
	
												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Matricula']['id'] ) )?>" class="textoTable">
	
													<?php echo $linha['Aluno']['nome']; ?>
	
												</a>
	
											</td>
	
											<td>
	
												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Matricula']['id'] ) )?>" class="textoTable">
	
													<?php echo $linha['Curso']['nome']; ?>
	
												</a>
	
											</td>
	
											<td>
	
												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Matricula']['id'] ) )?>" class="textoTable">
	
													<?php if( $linha['Matricula']['pago'] == '1' ) { echo 'Pagamento em dia'; } else { echo 'Pagamento em atraso'; } ?>
	
												</a>
	
											</td>
	
											
	
											<td>
	
												<a href="<?=$this->Html->url( array( 'action'=>'editar', $linha['Matricula']['id'] ))?>" class="textoTable">
	
													<?php echo $formatacao->dataHora( $linha['Matricula']['created'] ); ?>
	
												</a>
	
											</td>

											<td class="acoes">

												<?php echo $html->link( __( 'Editar', true ), array( 'action'=>'editar', $linha['Matricula']['id'] ), array( 'class'=>'editar' ) ); ?>
	
											</td>

											<td class="acoes">
	
												<?php echo $html->link( __( 'Delete', true ), array( 'controller'=>'matriculas', 'action'=>'delete', $linha['Matricula']['id'] ), array( 'class'=>'delete', 'onClick'=>'return confirm("Deseja realmente excluir o registro?")' ) ); ?>
	
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

						if( !empty( $matriculas ) ) {

					?>
	
							<div class="table-message-info"><?php echo $paginator->counter( array( 'format'=>__( 'Página %page% de %pages%, mostrando %current% registros de um total de %count%, iniciando no registro %start%, e finalizando em %end%', true ) ) ); ?></div>
	
					<?php

							}

					?>
	
					<div class="action-table">
	
						<ul class="btn-toolbar pull-left">
	
							<li><a class="btn btn-boo btn-small" href="<?=$this->Html->url( array( 'controller'=>'matriculas', 'action'=>'adicionar' ) )?>">Novo Cadastro</a></li>
	
						</ul>
	
						<div class="pagination pagination-boo">
	
							<ul>
	
								<li><?php echo $paginator->prev( 'Anterior', array( 'class'=>'prev' ), null, array( 'class'=>'disabled' ) ); ?></li>
	
								<li><?php echo $paginator->numbers( array( 'separator'=>'' ) );?></li>
	
								<li><?php echo $paginator->next( 'Próximo', array( 'class'=>'next' ), null, array( 'class'=>'disabled' ) ); ?></li>
	
							</ul>
	
						</div>
	
					</div>
	
					<script type="text/javascript">

						jQuery(function($){

							i=0;
	
							$('.buscaAvancada h3').css( 'cursor', 'pointer' );
	
							if($('.page-content').find('h4').length > 1){

								$('.page-content .buscaAvancada').hide();

							}
	
							$('.page-content h3').click(function() {

								$(this).next().slideToggle();

							} );
	
						});

				</script>

				</div>

			</div>

		</div>

	</section>

</div>