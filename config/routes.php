<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

    // Home
    Router::connect( '/', array( 'controller'=>'pages', 'action'=>'display', 'home' ) );
    
    // Alunos
    Router::connect( '/alunos/*', array( 'controller'=>'alunos', 'action'=>'index' ) );
    Router::connect( '/aluno/novo/*', array( 'controller'=>'alunos', 'action'=>'adicionar' ) );
    Router::connect( '/aluno/editar/*', array( 'controller'=>'alunos', 'action'=>'editar' ) );
    Router::connect( '/aluno/delete/*', array( 'controller'=>'alunos', 'action'=>'delete' ) );
    Router::connect( '/aluno/verifica_cadastro/*', array( 'controller'=>'alunos', 'action'=>'verifica_cadastro' ) );
    
    // Períodos
    Router::connect( '/periodos/*', array( 'controller'=>'periodos', 'action'=>'index' ) );
    Router::connect( '/periodo/novo/*', array( 'controller'=>'periodos', 'action'=>'adicionar' ) );
    Router::connect( '/periodo/editar/*', array( 'controller'=>'periodos', 'action'=>'editar' ) );
    Router::connect( '/periodo/delete/*', array( 'controller'=>'periodos', 'action'=>'delete' ) );

    // Cursos
    Router::connect( '/cursos/*', array( 'controller'=>'cursos', 'action'=>'index' ) );
    Router::connect( '/curso/novo/*', array( 'controller'=>'cursos', 'action'=>'adicionar' ) );
    Router::connect( '/curso/editar/*', array( 'controller'=>'cursos', 'action'=>'editar' ) );
    Router::connect( '/curso/delete/*', array( 'controller'=>'cursos', 'action'=>'delete' ) );
    
    // Matrículas
    Router::connect( '/matriculas/*', array( 'controller'=>'matriculas', 'action'=>'index' ) );
    Router::connect( '/matricula/novo/*', array( 'controller'=>'matriculas', 'action'=>'adicionar' ) );
    Router::connect( '/matricula/editar/*', array( 'controller'=>'matriculas', 'action'=>'editar' ) );
    Router::connect( '/matricula/buscar/*', array( 'controller'=>'matriculas', 'action'=>'buscar' ) );
    //Router::connect( '/matricula/acoes/*', array( 'controller'=>'matriculas', 'action'=>'acoes' ) );
    //Router::connect( '/matricula/alterar_status/*', array( 'controller'=>'matriculas', 'action'=>'status' ) );
    
    
    // Exercício 1
    Router::connect( '/exercicio_1/*', array( 'controller'=>'pages', 'action'=>'verificar_ano' ) );
    
    // Exercício 2
    Router::connect( '/exercicio_2/*', array( 'controller'=>'pages', 'action'=>'gerar_troco' ) );
    
?>