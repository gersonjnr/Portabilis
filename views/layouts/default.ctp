<!DOCTYPE html>
<html id="<?=AppController::_addClassBrowser('browser')?>" class="<?=AppController::_addClassBrowser('version')." ".(empty($this->params['pass'][0]) || $this->params['pass'][0] != 'home'?'internas':'capa')." ".($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='localhost'?'local':'online')?>" lang="por">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=Configure::read( 'site_title' )?> - <?php if( !empty( $title_for_layout ) ) echo __( $title_for_layout, true ); ?></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="">

<?php // Mobile Meta ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<?php // Favicons ?>
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

<?php
	
	echo $this->Html->script( array(
	
					$static_url. JS_URL . 'jquery/jquery.min',
					$static_url. JS_URL . 'jquery/jquery-ui',
					$static_url. JS_URL . 'jquery/jquery.superfish',
					$static_url. JS_URL . 'jquery/jquery.maskedinput',
					$static_url. JS_URL . 'jquery/jquery.maskMoney',
					$static_url. JS_URL . 'global',
					$static_url. JS_URL . 'bootstrap',
					$static_url. JS_URL . 'cufon'
					
	
				) );

	echo $scripts_for_layout;

	if( !empty( $static_url ) ) {

		$scripts_for_layout = str_replace( '"text/javascript" src="/'. JS_URL, '"text/javascript" src="'. $static_url . JS_URL, $scripts_for_layout  );
		$scripts_for_layout = str_replace( 'type="text/css" href="/'. CSS_URL, 'type="text/css" href="'. $static_url . CSS_URL, $scripts_for_layout  );

	}
	
	echo $scripts_for_layout; 

?>

</head>

<body id="body<?=Inflector::camelize($section)?>">
	
	<div class="page-container">

		<div id="header">

			<?php echo $session->flash(); ?>
	
			<h1><a href="<?=$this->Html->url(array( 'controller'=>'matriculas', 'action'=>'index'))?>">Portabilis Tecnologia</a></h1>

			<h2>Processo de seleção: Avaliação técnica</h2>

			<div class="boas_vindas">
	
				Olá <b></b>, seja bem-vindo(a).<br>
	
				Clique <a href="" class="sair">aqui</a> para sair do sistema.
	
			</div>

			<?=$this->element('menu')?>

			<?=$this->element('breadcrump')?>

		</div>

		

		<div id="main-container">

			<?php echo $session->flash(); ?>

			<div id="main-content" class="main-content container-fluid">

				<?php echo $content_for_layout; ?>

			</div>

		</div>

	</div>
	
	<script type="text/javascript">Cufon.now();</script>
	
</body>
</html>