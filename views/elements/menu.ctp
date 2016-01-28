<div id="areaMenu">
	<div id="menu">
		<div id="menuSis">
			<ul class="nav left">
				<li><a href="" class="top">Cadastros</a>
					<ul>
						<li><a href="<?=$this->Html->url( array( 'controller'=>'alunos', 'action'=>'index' ) )?>">Listar alunos</a></li>
						<li><a href="<?=$this->Html->url( array( 'controller'=>'cursos', 'action'=>'index' ) )?>">Listar cursos</a></li>
						<li><a href="<?=$this->Html->url( array( 'controller'=>'matriculas', 'action'=>'index' ) )?>">Listar matrículas</a></li>
					</ul
				</li>
				<li>
					<a href="<?=$this->Html->url( array( 'controller'=>'pages', 'action'=>'verificar_ano' ) )?>" class="top">Exercício 1</a>
				</li>
				<li>
					<a href="<?=$this->Html->url( array( 'controller'=>'pages', 'action'=>'gerar_troco' ) )?>" class="top">Exercício 2</a>
				</li>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
	
		jQuery(function($){
			
				$('.nav').superfish({
					hoverClass	 : 'sfHover',
					pathClass	 : 'overideThisToUse',
					delay		 : 0,
					animation	 : {height: 'show'},
					speed		 : 'normal',
					autoArrows       : false,
					dropShadows      : false, 
					disableHI	 : false, 
					onInit		 : function(){},
					onBeforeShow     : function(){},
					onShow		 : function(){},
					onHide		 : function(){}
				});
				$('.nav').css('display', 'block');
			
		});
	
	</script>
	
</div>