-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Out-2019 às 08:05
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdestagio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `emp_razao_social` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `emp_cnpj` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `empresas_id` int(11) NOT NULL,
  `emp_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`emp_razao_social`, `emp_cnpj`, `empresas_id`, `emp_status`) VALUES
('ELETROFRIGOR', '07.885.198/0001-87', 1, 1),
('EMPRESA', '43.243.242/3424-23', 2, 1),
('THOR LTDA', '21.323.123/1231-23', 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas_usuarios`
--

CREATE TABLE `empresas_usuarios` (
  `empresas_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `empresas_usuarios_id` int(11) NOT NULL,
  `emp_usu_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `empresas_usuarios`
--

INSERT INTO `empresas_usuarios` (`empresas_id`, `usuarios_id`, `empresas_usuarios_id`, `emp_usu_status`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(1, 2, 3, 1),
(3, 0, 4, 0),
(3, 0, 5, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(11) NOT NULL,
  `usu_nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usu_cpf` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `usu_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usu_nome`, `usu_cpf`, `usu_status`) VALUES
(1, 'Leonardo Fernandes de Andrade', '151.618.637-06', 1),
(2, 'Funcionario', '555.666.777-08', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`empresas_id`);

--
-- Índices para tabela `empresas_usuarios`
--
ALTER TABLE `empresas_usuarios`
  ADD PRIMARY KEY (`empresas_usuarios_id`),
  ADD KEY `fk_usuarios_id` (`usuarios_id`),
  ADD KEY `fk_empresas_id` (`empresas_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `empresas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `empresas_usuarios`
--
ALTER TABLE `empresas_usuarios`
  MODIFY `empresas_usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
