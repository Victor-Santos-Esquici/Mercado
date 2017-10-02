-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Out-2017 às 02:21
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mercado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `ID` int(6) UNSIGNED NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Tipo` int(6) UNSIGNED NOT NULL,
  `Valor` decimal(15,2) NOT NULL,
  `Estoque` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`ID`, `Nome`, `Tipo`, `Valor`, `Estoque`) VALUES
(1, 'Itaipava', 1, '1.50', 200),
(2, 'Skol', 1, '1.70', 300),
(3, 'Del Vale', 2, '2.10', 100),
(4, 'Pepsi Cola 2L', 3, '3.00', 800),
(5, 'Guaraná Charrua 2L', 3, '2.50', 340),
(6, 'Bis Branco', 4, '2.70', 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `ID` int(6) UNSIGNED NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`ID`, `Nome`) VALUES
(1, 'Cerveja'),
(2, 'Suco'),
(3, 'Refrigerante'),
(4, 'Chocolate');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(6) UNSIGNED NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Login`, `Senha`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `ID` int(6) UNSIGNED NOT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`ID`, `Data`) VALUES
(1, '2017-09-23 10:20:20'),
(2, '2017-09-22 13:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_itens`
--

CREATE TABLE `vendas_itens` (
  `ID` int(6) UNSIGNED NOT NULL,
  `ProdutoID` int(6) UNSIGNED NOT NULL,
  `VendaID` int(6) UNSIGNED DEFAULT NULL,
  `Quantidade` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendas_itens`
--

INSERT INTO `vendas_itens` (`ID`, `ProdutoID`, `VendaID`, `Quantidade`) VALUES
(1, 1, 1, 10),
(2, 2, 1, 50),
(3, 3, 1, 100),
(4, 4, 2, 801),
(5, 5, 2, 274),
(6, 6, 2, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vendas_itens`
--
ALTER TABLE `vendas_itens`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProdutoID` (`ProdutoID`),
  ADD KEY `VendaID` (`VendaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vendas_itens`
--
ALTER TABLE `vendas_itens`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `tipos` (`ID`);

--
-- Limitadores para a tabela `vendas_itens`
--
ALTER TABLE `vendas_itens`
  ADD CONSTRAINT `vendas_itens_ibfk_1` FOREIGN KEY (`ProdutoID`) REFERENCES `produtos` (`ID`),
  ADD CONSTRAINT `vendas_itens_ibfk_2` FOREIGN KEY (`VendaID`) REFERENCES `vendas` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
