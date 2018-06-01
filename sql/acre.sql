-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Jun-2018 às 06:41
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemavoo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acre`
--

CREATE TABLE `acre` (
  `id` int(11) NOT NULL,
  `dataIda` date NOT NULL,
  `dataVolta` date NOT NULL,
  `nome` varchar(455) NOT NULL,
  `pesoEstimado` int(11) NOT NULL,
  `dataNascimento` date NOT NULL,
  `contatoPax` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomeContatoEmergencia` varchar(455) NOT NULL,
  `telContatoEmergencia` varchar(20) NOT NULL,
  `dataGravacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acre`
--

INSERT INTO `acre` (`id`, `dataIda`, `dataVolta`, `nome`, `pesoEstimado`, `dataNascimento`, `contatoPax`, `email`, `nomeContatoEmergencia`, `telContatoEmergencia`, `dataGravacao`) VALUES
(10, '0000-00-00', '0000-00-00', 'Albert Otto', 90, '1983-02-18', '92981537569', 'ottosib@gmail.com', 'Lucielen Nunes Barroso Nascimento', '92 98403-3865', '2018-06-01 04:38:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acre`
--
ALTER TABLE `acre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acre`
--
ALTER TABLE `acre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
