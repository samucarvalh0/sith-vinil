-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/07/2026 às 14:22
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
-- Banco de dados: `sinth_vinil`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`id`, `nome`, `usuario`, `senha`) VALUES
(1, 'loja', 'admin', 'admin@');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(2, 'MPB'),
(3, 'Country'),
(4, 'Jazz'),
(5, 'Samba');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `senha`, `endereco`) VALUES
(1, 'Gabriel Santana', 'gabriel@gmail.com', '(12) 99802-0987', '$2y$10$CelU77Uoiir3NdTIMs1Tu.vAPI8dLbOddbJW5n2LcG0AO0uPypT.K', 'R. Tancredo Cruz, nº 72, Vila Moura - Caçapava / SP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_pedido`
--

INSERT INTO `itens_pedido` (`id`, `pedido_id`, `produto_id`, `quantidade`, `valor_unitario`) VALUES
(1, 1, 4, 1, 36.90),
(2, 1, 5, 1, 51.99),
(3, 1, 6, 1, 107.70);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `data`, `total`, `status`) VALUES
(1, 1, '2026-07-04 09:08:43', 206.59, 'pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_categorias` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `artista` varchar(150) NOT NULL,
  `ano` year(4) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_categorias`, `titulo`, `artista`, `ano`, `preco`, `estoque`, `descricao`, `imagem`) VALUES
(1, 2, 'Vidas - Trilha Sonora Original', 'Vários Artistas', '1976', 57.80, 1, 'Antigo e Original Disco de Vinil - LP - VIDAS - Trilha Sonora Original da novela - 1976', 'uploads/prod_6a486886759507.27366564.jpg'),
(2, 2, 'Pulsa Coração', 'Alcione', '1992', 37.40, 1, '-', 'uploads/prod_6a48a26c246052.75316057.jpg'),
(3, 2, 'História da música popular brasileira', 'Tom Jobim', '1982', 112.50, 1, '- ', 'uploads/prod_6a48a3732b5c29.36821666.jpg'),
(4, 3, 'Ciranda De Pedra – Trilha Sonora Original', 'Vários Artistas', '1981', 36.90, 1, 'A1 Sandra Sá*– Mona Lisa\r\nA2 Antonio Marcos– Eu Vou Ter Sempre Você\r\nA3 Gal Costa– Dez Anos\r\nA4 Maria Creuza– Frenesi\r\nA5 João Gilberto– The Trolley Song\r\nA6 Quarteto Em Cy– Céu Cor-De-Rosa\r\nB1 Ronnie Von– Coquetel Para Dois\r\nB2 Nara Leão– Trevo De Quatro Folhas\r\nB3 Pholhas– Serenata Ao Luar\r\nB4 Santa Cruz (12)– Quantas São?\r\nB5 Cauby Peixoto– Serenata Ständchen\r\nB6 Altemar Dutra– Dançando Com Lágrima Nos Olhos', 'uploads/prod_6a48a44867c9e7.60585967.jpg'),
(5, 2, 'Coletânea Roberto Carlos', 'Roberto Carlos', '1988', 51.99, 1, '-', 'uploads/prod_6a48a4f72c04f3.80665642.jpg'),
(6, 4, 'Gigantes do Jazz', 'Sarah Vaughan', '1978', 107.70, 1, '', 'uploads/prod_6a48a564378c04.00718567.jpg'),
(7, 5, 'O Carnaval De Gal', 'Gal Costa', '1979', 78.35, 1, 'O álbum \"O Carnaval De Gal\", da icônica artista brasileira Gal Costa, é uma celebração vibrante e autêntica do espírito carnavalesco do Brasil. Lançado em formato LP, este disco de vinil é uma verdadeira joia para os amantes da música brasileira e colecionadores de discos. Produzido pela renomada gravadora Philips, \"O Carnaval De Gal\" captura a essência e a energia do carnaval, trazendo a voz única e incomparável de Gal Costa em interpretações que vão desde o samba até outros ritmos tradicionais. Este LP é um item essencial para quem aprecia a música brasileira e deseja experimentar a magia do carnaval através da arte de uma das maiores cantoras do país.', 'uploads/prod_6a48a5e07c38b6.64698895.jpg'),
(8, 2, 'Historia da Musica Popular Brasileira', 'Ary Barroso', '1982', 45.60, 1, '', 'uploads/prod_6a48a6562b85e3.95654925.jpg'),
(9, 5, 'Sambas Enredo Das Escolas ', 'Vários Artistas', '1987', 69.80, 1, '', 'uploads/prod_6a48a6b35e3981.54683092.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
