-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/12/2024 às 20:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cinema_reservas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `nome`, `descricao`, `imagem`) VALUES
(1, 'Batman', 'O Cavaleiro das Trevas luta contra o crime em Gotham City.', 'batman.jpg'),
(2, 'Homem-Aranha', 'Peter Parker se transforma no Homem-Aranha para salvar Nova York.', 'spiderman.jpg'),
(3, 'Homem de Ferro', 'Tony Stark, um empresário bilionário, se torna o herói Homem de Ferro.', 'ironman.jpg'),
(4, 'Vingadores', 'Os maiores heróis da Terra se unem para enfrentar ameaças globais.', 'avengers.jpg'),
(5, 'Capitão América', 'Steve Rogers se transforma no super-soldado para proteger os EUA.', 'captain_america.jpg'),
(6, 'Thor', 'O deus do trovão luta para salvar o universo de ameaças cósmicas.', 'thor.jpg'),
(7, 'Pantera Negra', 'O herói de Wakanda, T\'Challa, luta para proteger seu reino.', 'black_panther.jpg'),
(8, 'Flash', 'Barry Allen usa sua supervelocidade para combater o crime.', 'flash.jpg'),
(9, 'Mulher-Maravilha', 'Diana, princesa das Amazonas, se torna a Mulher-Maravilha para combater a guerra.', 'wonder_woman.jpg'),
(10, 'Guardiões da Galáxia', 'Um grupo de heróis improváveis se unem para salvar o universo.', 'guardians_of_the_galaxy.jpg'),
(11, 'Deadpool', 'Wade Wilson se torna o anti-herói Deadpool após um experimento fracassado.', 'deadpool.jpg'),
(12, 'Arqueiro Verde', 'Oliver Queen se torna o Arqueiro Verde para combater o crime em Star City.', 'green_arrow.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `filme_id` int(11) NOT NULL,
  `assento` varchar(10) NOT NULL,
  `data_reserva` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
