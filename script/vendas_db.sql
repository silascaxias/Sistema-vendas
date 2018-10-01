-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: sql305.2host.me
-- Tempo de Geração: 01/10/2018 às 12:28:11
-- Versão do Servidor: 5.6.41-84.1
-- Versão do PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
CREATE DATABASE vendas_db;
USE vendas_db;
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcliente`
--

CREATE TABLE IF NOT EXISTS `tbcliente` (
  `cod_cli` int(10) unsigned NOT NULL,
  `nome_cli` varchar(30) NOT NULL,
  `endereco_cli` varchar(45) DEFAULT NULL,
  `cidade_cli` varchar(45) DEFAULT NULL,
  `uf_cli` varchar(2) DEFAULT NULL,
  `data_cad_cli` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbcliente`
--

INSERT INTO `tbcliente` (`cod_cli`, `nome_cli`, `endereco_cli`, `cidade_cli`, `uf_cli`, `data_cad_cli`) VALUES
(1, 'Silas da Silva Caxias', NULL, 'Leme', 'SP', '2018-08-23 19:52:00'),
(3, 'Bruno de Mirando Miquelotto', 'Lá no fim do mundo', 'Leme', 'SP', '2018-08-29 19:36:00'),
(4, 'Douglas Prudente', 'Lá no fim do mundo', 'Leme ', 'SP', '2018-08-29 19:37:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbperfil`
--

CREATE TABLE IF NOT EXISTS `tbperfil` (
  `cod_perfil` int(11) NOT NULL,
  `desc_perfil` varchar(45) NOT NULL,
  `FullAccess` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbperfil`
--

INSERT INTO `tbperfil` (`cod_perfil`, `desc_perfil`, `FullAccess`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE IF NOT EXISTS `tbproduto` (
  `cod_prod` int(10) unsigned NOT NULL,
  `desc_prod` varchar(30) NOT NULL,
  `valor_prod` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`cod_prod`, `desc_prod`, `valor_prod`) VALUES
(1, 'Roteador TP-Link Wireless ', '62,90'),
(2, 'Headset Gamer', '229,90'),
(3, 'Processador Intel Core i5', '895,90'),
(0, 'Novo produto', '12,98');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE IF NOT EXISTS `tbusuario` (
  `cod_usu` int(11) NOT NULL,
  `nome_usu` varchar(45) NOT NULL,
  `email_usu` varchar(80) NOT NULL,
  `senha_usu` varchar(255) NOT NULL,
  `cod_perfil` int(11) NOT NULL,
  `ultima_atividade_usu` datetime DEFAULT NULL,
  `sessao_usu` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`cod_usu`, `nome_usu`, `email_usu`, `senha_usu`, `cod_perfil`, `ultima_atividade_usu`, `sessao_usu`) VALUES
(1, 'Administrador', 'admin@vendas.com', '$2a$08$2sGQinTFe3GF/YqAYQ66auL9o6HeFCQryHdqUDvuEVN0J1vdhimii', 1, '2018-10-01 10:25:17', '10a36918067feee4d28051cdacf528de'),
(2, 'Vendedor', 'vendedor@vendas.com', '$2a$08$2sGQinTFe3GF/YqAYQ66auL9o6HeFCQryHdqUDvuEVN0J1vdhimii', 2, '2018-09-06 21:47:13', 'dd4fa8aa5f784753b7f42d5f797d2548');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvenda`
--

CREATE TABLE IF NOT EXISTS `tbvenda` (
  `cod_venda` int(10) NOT NULL AUTO_INCREMENT,
  `data_venda` datetime NOT NULL,
  `cod_cli` int(10) NOT NULL,
  PRIMARY KEY (`cod_venda`),
  KEY `fk_CliVenda` (`cod_cli`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tbvenda`
--

INSERT INTO `tbvenda` (`cod_venda`, `data_venda`, `cod_cli`) VALUES
(8, '2018-10-01 10:25:00', 3),
(7, '2018-09-14 21:53:00', 1),
(3, '2018-08-31 13:51:00', 3),
(4, '2018-08-31 18:44:00', 4),
(6, '2018-09-04 23:32:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvendaitens`
--

CREATE TABLE IF NOT EXISTS `tbvendaitens` (
  `qtde_itens` int(11) NOT NULL,
  `total_itens` double NOT NULL,
  `cod_venda` int(10) unsigned NOT NULL,
  `cod_prod` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbvendaitens`
--

INSERT INTO `tbvendaitens` (`qtde_itens`, `total_itens`, `cod_venda`, `cod_prod`) VALUES
(1, 229, 8, 2),
(1, 895, 7, 3),
(2, 124, 7, 1),
(1, 895, 3, 3),
(1, 229, 4, 2),
(1, 895, 4, 3),
(1, 62, 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
