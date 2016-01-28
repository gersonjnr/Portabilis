<?php

class FormatacaoHelper extends AppHelper {

	
	var $helpers = array( 'Time', 'Number' );

	
	function __construct() {
	
		setlocale( LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'pt-br', 'pt', 'pt_BR.iso-8859-1', 'portuguese' );
		parent::__construct();
	
	}


	function hora( $data = null, $formato='H:i' ) {
	
		$data = $this->_ajustaDataHora($data);
		return $this->Time->format( $formato, $data );
	
	}

	
	function dataHora( $dataHora = null, $segundos = true ) {
	
		$dataHora = $this->_ajustaDataHora($dataHora);
	
		if ( $segundos ) {
	
			return $this->Time->format( 'd/m/Y H:i:s', $dataHora );
	
		}
	
		return $this->Time->format( 'd/m/Y H:i', $dataHora );
	
	}

	
	function _ajustaDataHora( $data=null ) {
	
		if ( is_null( $data ) ) {
	
			return time();
	
		} elseif( is_numeric( $data ) ) return $data;
	
		return strtotime($data);
	
	}

	
	function moeda( $valor, $opcoes = array() ) {
	
		$padrao = array(
	
			'before'=> 'R$ ',
			'after' => '',
			'zero' => 'R$ 0,00',
			'places' => 2,
			'thousands' => '.',
			'decimals' => ',',
			'negative' => '()',
			'escape' => true
	
		);
	
		$config = array_merge($padrao, $opcoes);
	
		if ( $valor > -1 && $valor < 1 ) {
	
			$formatado = $this->Number->format(abs($valor), $config);
	
			if ($valor < 0 ) {
	
				if ($config['negative'] == '()') {
	
					$formatado = '(' . $formatado .')';
	
				} else {
	
					$formatado = $config['negative'] . $formatado;
	
				}
	
			}
	
			return $formatado;
	
		}
	
		return $this->Number->currency( $valor, null, $config );
	
	}

	
	function verificaBissexto( $ano ){

		if( $ano%4 != 0 )
	
			return false;

		if( $ano%100!=0 ){
	
			return true;
	
		} else if ( $ano%400 == 0 ) {
	
			return true;

		}

		return false;

	}
	
	
	function simulaTroco( $valorTotal, $valorPago ){

			$valorTroco = $valorPago-$valorTotal;

			return $valorTroco;

	}
	
	
	function listaTroco( $troco ){

		$somaTroco = 0;
	
		$listaTroco = array();
	
		while( $somaTroco < $troco ){
	
			$valor = $this->maiorTroco( $troco - $somaTroco );
	
			$somaTroco += $valor;

			$listaTroco[] = $valor;
	
			$somaTroco = number_format( $somaTroco, 2, '.', '' );
	
			$troco     = number_format( $troco, 2, '.', '' );

		}

		return $listaTroco;	
	
	}
	

	function maiorTroco( $troco ){
	
		$valores = array(100.00,50.00,10.00,5.00,1.00,0.50,0.10,0.05,0.01);
	
		foreach ( $valores as $valor ) {

			$valor = number_format( $valor, 2, '.', '' );		

			$troco = number_format( $troco, 2, '.', '' );
	
			if( $valor <= $troco ) return $valor;	
	
		}
	
	}
	

}

?>