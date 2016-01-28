/*
SQLyog Community v12.09 (64 bit)
MySQL - 5.5.27-log : Database - portabilis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`portabilis` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `portabilis`;

/*Table structure for table `alunos` */

DROP TABLE IF EXISTS `alunos`;

CREATE TABLE `alunos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(15) NOT NULL,
  `rg` int(10) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nome` varchar(250) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `created` datetime NOT NULL,
  `ip` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `alunos` */

insert  into `alunos`(`id`,`cpf`,`rg`,`data_nascimento`,`nome`,`telefone`,`created`,`ip`) values (20,'046.153.979-92',448007154,'1984-03-09','Gerson Luiz Ferreira Junior','(48)3432-6439','2016-01-26 06:10:59','127.0.0.1'),(21,'441.340.960-49',1005465,'1965-02-24','Agenor Vieira dos Santos','(48)3432-1540','2016-01-27 06:14:31','127.0.0.1');

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `periodo_id` int(1) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `valor_inscricao` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `cursos` */

insert  into `cursos`(`id`,`periodo_id`,`nome`,`valor_inscricao`,`created`,`ip`) values (8,3,'Sistemas de Informação','650.80','2016-01-26 06:33:17','127.0.0.1'),(9,1,'Sistemas de Informação','450.35','2016-01-26 06:34:47','127.0.0.1'),(10,2,'Sistemas de Informação','1650.55','2016-01-26 07:35:13','127.0.0.1'),(11,3,'Administração de empresas','1560.50','2016-01-27 06:08:24','127.0.0.1');

/*Table structure for table `matriculas` */

DROP TABLE IF EXISTS `matriculas`;

CREATE TABLE `matriculas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aluno_id` int(10) NOT NULL,
  `curso_id` int(10) NOT NULL,
  `data_matricula` date NOT NULL,
  `ano` int(4) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `pago` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `matriculas` */

insert  into `matriculas`(`id`,`aluno_id`,`curso_id`,`data_matricula`,`ano`,`ativo`,`pago`,`created`,`ip`) values (48,20,8,'2016-01-25',2016,0,2,'2016-01-27 07:45:46','127.0.0.1'),(50,21,11,'2016-01-27',2016,1,1,'2016-01-27 07:45:17','127.0.0.1');

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_swedish_ci DEFAULT NULL,
  `content` text COLLATE utf8_swedish_ci NOT NULL,
  `view` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

/*Data for the table `pages` */

/*Table structure for table `periodos` */

DROP TABLE IF EXISTS `periodos`;

CREATE TABLE `periodos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `periodos` */

insert  into `periodos`(`id`,`nome`,`created`,`ip`) values (1,'Matutino','2016-01-22 01:48:35','127.0.0.1'),(2,'Vespertino','2016-01-22 01:49:32','127.0.0.1'),(3,'Integral','2016-01-22 01:50:52','127.0.0.1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
