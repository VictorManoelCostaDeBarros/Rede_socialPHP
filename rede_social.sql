-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Maio-2021 às 19:26
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rede_social`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizades`
--

CREATE TABLE `amizades` (
  `id` int(11) NOT NULL,
  `enviou` int(11) NOT NULL,
  `recebeu` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `amizades`
--

INSERT INTO `amizades` (`id`, `enviou`, `recebeu`, `status`) VALUES
(2, 1, 2, 1),
(3, 2, 3, 1),
(4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `usuario_id`, `post`, `date`) VALUES
(1, 2, 'Oba!', '2021-05-13 10:48:53'),
(2, 2, 'Oba! dnv', '2021-05-13 10:54:05'),
(3, 2, 'Oba! dnv', '2021-05-13 10:56:48'),
(4, 2, 'Oba! dnv', '2021-05-13 10:59:15'),
(5, 2, '<p>Oba</p>', '2021-05-13 11:08:42'),
(6, 2, '<p>opa ![image=https://cursos.dankicode.com/app/Views/public/images/uploads/cursos/591f197b0f718.jpg]\r\n</p>', '2021-05-13 11:09:32'),
(7, 2, '<p>opa ![imagem=https://cursos.dankicode.com/app/Views/public/images/uploads/cursos/591f197b0f718.jpg]</p>', '2021-05-13 11:09:56'),
(8, 2, '<p>opa !<p><img src=\"https://cursos.dankicode.com/app/Views/public/images/uploads/cursos/591f197b0f718.jpg\" />', '2021-05-13 11:10:32'),
(9, 1, '<p>Ola post do victor manoel\r\n</p>', '2021-05-13 11:30:00'),
(10, 3, '<p>coe rapaziada</p>', '2021-05-13 14:22:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` text NOT NULL,
  `ultimo_post` datetime NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `ultimo_post`, `img`) VALUES
(1, 'Victor Manoel Costa de Barros', 'victor.manoel8@hotmail.com', '$2a$08$MTk3NTc4MTAwOTYwOWQ1O.qiuM9CP4Jx9eQQ8CVMGIalp0aKzJ6aC', '2021-05-13 11:30:00', '609d5e0d4e363.jpg'),
(2, 'Vitinho', 'victor.manoel8@gmail.com', '$2a$08$MTM5MjY0OTU3NjYwOWM2ZeqrH2E/516/PE0k.0HxsYEypvDkyYUcK', '2021-05-13 11:10:32', '609d60892fca1.jpg'),
(3, 'Teste', 'teste@gmail.com', '$2a$08$MjQyMDU3MzA2MDljNmYzO.2GzkllAGUsOvmJqxY4HipcZthNGhmRm', '2021-05-13 14:22:58', '609d606366a2d.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `amizades`
--
ALTER TABLE `amizades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `amizades`
--
ALTER TABLE `amizades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
