-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tempo de Geração: 21/09/2016 às 21:18
-- Versão do servidor: 5.5.50-cll
-- Versão do PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `fatecbau`
--
CREATE DATABASE IF NOT EXISTS `fatecbau` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fatecbau`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `alunonum` int(6) NOT NULL AUTO_INCREMENT,
  `alunonome` varchar(400) NOT NULL,
  PRIMARY KEY (`alunonum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;
alter table aluno add column situacao int not null
-- --------------------------------------------------------

--
-- Estrutura para tabela `apres`
--

DROP TABLE IF EXISTS `apres`;
CREATE TABLE IF NOT EXISTS `apres` (
  `apresnum` int(6) NOT NULL AUTO_INCREMENT,
  `defesanum` int(6) NOT NULL,
  `alunonum` int(6) NOT NULL,
  PRIMARY KEY (`apresnum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;
alter table apres add column situacao int not null
-- --------------------------------------------------------

--
-- Estrutura para tabela `banca`
--

DROP TABLE IF EXISTS `banca`;
CREATE TABLE IF NOT EXISTS `banca` (
    `id` int(6) NOT NULL AUTO_INCREMENT,
  `bancanum` int(6) NOT NULL,
  `profnum` int(3) NOT NULL,
  `defesanum` int(6) NOT NULL,
  `bancatipo` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;
alter table banca
add foreign key (profnum)
references prof(profnum)

alter table banca add column situacao int not null
-- --------------------------------------------------------
create table cursos(
	id int not null auto_increment primary key,
	curso varchar(30) not null,
	periodo varchar(10) not null    
);

create table tipos(
	id int not null auto_increment primary key,
	tipo varchar(30) not null    
);
--
-- Estrutura para tabela `defesa`
--

DROP TABLE IF EXISTS `defesa`;
CREATE TABLE IF NOT EXISTS `defesa` (
  `defesanum` int(6) NOT NULL AUTO_INCREMENT,
  `defesacurso` int(1) NOT NULL,
  `defesatitulo` varchar(500) NOT NULL,
  `defesaresumo` varchar(2500) NOT NULL,
  `defesadata` date NOT NULL,
  `defesahora` char(2) NOT NULL,
  `defesatipo` char(1) NOT NULL,
  PRIMARY KEY (`defesanum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;
alter table defesa add column situacao int not null
-- --------------------------------------------------------

--
-- Estrutura para tabela `prof`
--

DROP TABLE IF EXISTS `prof`;
CREATE TABLE IF NOT EXISTS `prof` (
  `profnum` int(3) NOT NULL AUTO_INCREMENT,
  `profnome` varchar(40) NOT NULL,
  `profnick` varchar(10) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(100) NULL,
  `nivel` int(1) NOT NULL,
  `ativo` bool NOT NULL,
  `cadastro` datetime NOT NULL,
  PRIMARY KEY (`profnum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

INSERT INTO `prof` VALUES (NULL, 'Miguel Jose das Neves',           'migue', SHA1('12345'),     'mjneves@fibbauru.com.br',  2, 1, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Usuário Teste',                   'teste', SHA1('demo666'),   'teste@axtech.com.br',      1, 0, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Kelton Augusto Pontara da Costa', 'kelto', SHA1('112233'),    'kapcosta@fatecbau.com.br', 2, 1, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Luis Alexandre da Silva',         'luisa', SHA1('54321'),     'lasilva@fatecbau.com.br',  1, 0, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Gustavo Cesar Bruschi',           'gusta', SHA1('321321'),    'gcbruschi@fatecbau.com.br',1, 0, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Henrique Pachioni Martins',       'henri', SHA1('554433'),    'hpmartins@fatecbau.com.br',1, 0, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Claudines Taveira Torres',        'claud', SHA1('123456'),    'cttorres@fibbauru.com.br', 2, 1, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Paulo Sergio Pereira Pinto',      'paulo', SHA1('133122'),    'psppinto@fatecbau.com.br', 1, 0, NOW( ));
INSERT INTO `prof` VALUES (NULL, 'Marcelo Machado Pereira',         'admin', SHA1('minad666' ), 'consultor@axtech.com.br',  2, 1, NOW( ));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


