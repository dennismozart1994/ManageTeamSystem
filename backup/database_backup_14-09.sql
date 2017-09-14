-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Set-2017 às 00:19
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inproject`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cc`
--

CREATE TABLE `tab_cc` (
  `id_cc` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `desc_cc` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_cc`
--

INSERT INTO `tab_cc` (`id_cc`, `id_clt`, `desc_cc`, `id_user`) VALUES
(1, 1, 'REDE164994', 1),
(2, 2, 'CIELO99987', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cliente`
--

CREATE TABLE `tab_cliente` (
  `id_clt` int(11) NOT NULL,
  `modalidade_clt` varchar(255) NOT NULL,
  `nome_clt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_cliente`
--

INSERT INTO `tab_cliente` (`id_clt`, `modalidade_clt`, `nome_clt`) VALUES
(1, 'ATS', 'Redecard'),
(2, 'ATS', 'CIELO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_fases`
--

CREATE TABLE `tab_fases` (
  `id_f` int(11) NOT NULL,
  `nome_f` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_fases`
--

INSERT INTO `tab_fases` (`id_f`, `nome_f`, `id_user`) VALUES
(1, 'Planejamento', 1),
(2, 'Modelagem', 1),
(3, 'Estimativa', 1),
(4, 'Execução', 1),
(5, 'Finalizado', 1),
(6, 'Não se Aplica', 1),
(7, 'Regressivo', 1),
(8, 'Cancelado', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_historico`
--

CREATE TABLE `tab_historico` (
  `id_hst` int(11) NOT NULL,
  `data_hst` date NOT NULL,
  `id_f` int(11) NOT NULL,
  `prvt_hst` varchar(255) NOT NULL,
  `rlzd_hst` varchar(255) NOT NULL,
  `desc_hst` longtext NOT NULL,
  `id_prj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_lider_cliente`
--

CREATE TABLE `tab_lider_cliente` (
  `id_lc` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `nome_lc` varchar(255) NOT NULL,
  `email_lc` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_lider_projeto`
--

CREATE TABLE `tab_lider_projeto` (
  `id_lp` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `nome_lp` varchar(255) NOT NULL,
  `email_lp` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_mot_pend`
--

CREATE TABLE `tab_mot_pend` (
  `id_mtp` int(11) NOT NULL,
  `nome_mtp` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_mot_pend`
--

INSERT INTO `tab_mot_pend` (`id_mtp`, `nome_mtp`, `id_user`) VALUES
(1, 'Agendamento de Reunião', 1),
(2, 'Recebimento de Documentação', 1),
(3, 'Massa de Dados', 1),
(4, 'Liberação do Ambiente', 1),
(5, 'Aprovação do Cronograma', 1),
(6, 'Aprovação do RTF', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_notify`
--

CREATE TABLE `tab_notify` (
  `id_notify` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `id_from_user` int(11) NOT NULL,
  `id_to_user` int(11) NOT NULL,
  `status_notify` varchar(255) NOT NULL,
  `description_notify` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_projeto`
--

CREATE TABLE `tab_projeto` (
  `id_prj` int(11) NOT NULL,
  `ts_prj` varchar(255) NOT NULL,
  `nmp_prj` varchar(255) NOT NULL,
  `id_cc` int(11) NOT NULL,
  `id_lc` int(11) NOT NULL,
  `id_lp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_inmetrics_user` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_mtp` int(11) NOT NULL,
  `doc_prj` int(11) NOT NULL,
  `reu_prj` int(11) NOT NULL,
  `mrr_prj` int(11) NOT NULL,
  `crono_prj` int(11) NOT NULL,
  `aprv_prj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_projeto`
--

INSERT INTO `tab_projeto` (`id_prj`, `ts_prj`, `nmp_prj`, `id_cc`, `id_lc`, `id_lp`, `id_user`, `id_inmetrics_user`, `id_f`, `id_status`, `id_mtp`, `doc_prj`, `reu_prj`, `mrr_prj`, `crono_prj`, `aprv_prj`) VALUES
(1, '999.999', 'Projeto Teste', 1, 1, 1, 1, 1, 1, 1, 5, 1, 1, 1, 1, 1),
(2, '888.888', 'Teste de projeto 2', 2, 2, 2, 1, 1, 1, 1, 5, 1, 1, 1, 1, 1),
(3, '777.777', 'Teste de Projeto', 1, 1, 1, 1, 1, 1, 1, 5, 1, 1, 1, 1, 1),
(4, '555.555', 'Teste de projeto finalizado', 1, 1, 1, 1, 5, 5, 1, 2, 1, 1, 1, 1, 1),
(5, '444.444', 'Teste de projeto Cancelado', 1, 1, 1, 1, 1, 8, 1, 2, 1, 1, 1, 1, 1),
(6, '555.555', 'Projeto teste 20', 1, 1, 1, 1, 5, 2, 2, 2, 1, 1, 1, 1, 1),
(7, '123.456', 'Teste projeto 300', 1, 1, 1, 1, 5, 3, 3, 5, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_status`
--

CREATE TABLE `tab_status` (
  `id_status` int(11) NOT NULL,
  `nome_status` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_status`
--

INSERT INTO `tab_status` (`id_status`, `nome_status`, `id_user`) VALUES
(1, 'Aguard. Aprovação', 1),
(2, 'Em Andamento', 1),
(3, 'Pendente Cliente', 1),
(4, 'Aguard. Execução', 1),
(5, 'Não Iniciado', 1),
(6, 'Pendente Fábrica', 1),
(7, 'Atrasado', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_user`
--

CREATE TABLE `tab_user` (
  `id_user` int(11) NOT NULL,
  `id_cc` int(11) NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `funcao_user` varchar(255) NOT NULL,
  `tel_user` int(20) NOT NULL,
  `email_in_user` varchar(255) NOT NULL,
  `senha_user` varchar(255) NOT NULL,
  `thumbnail_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_user`
--

INSERT INTO `tab_user` (`id_user`, `id_cc`, `nome_user`, `funcao_user`, `tel_user`, `email_in_user`, `senha_user`, `thumbnail_user`) VALUES
(1, 1, 'Dennis Mozart', 'Analista de Testes Jr.', 986786566, 'densilva@inmetrics.com.br', 'teste', ''),
(4, 1, 'Rafael Alexandrino', 'Líder de Testes', 988887777, 'rafsouza@inmetrics.com.br', 'teste', ''),
(5, 1, 'Victor dos Santos', 'Analista de Testes Jr.', 988877788, 'victorsa@inmetrics.com.br', 'teste', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_cc`
--
ALTER TABLE `tab_cc`
  ADD PRIMARY KEY (`id_cc`);

--
-- Indexes for table `tab_cliente`
--
ALTER TABLE `tab_cliente`
  ADD PRIMARY KEY (`id_clt`);

--
-- Indexes for table `tab_fases`
--
ALTER TABLE `tab_fases`
  ADD PRIMARY KEY (`id_f`);

--
-- Indexes for table `tab_historico`
--
ALTER TABLE `tab_historico`
  ADD PRIMARY KEY (`id_hst`);

--
-- Indexes for table `tab_lider_cliente`
--
ALTER TABLE `tab_lider_cliente`
  ADD PRIMARY KEY (`id_lc`),
  ADD UNIQUE KEY `email` (`email_lc`);

--
-- Indexes for table `tab_lider_projeto`
--
ALTER TABLE `tab_lider_projeto`
  ADD PRIMARY KEY (`id_lp`);

--
-- Indexes for table `tab_mot_pend`
--
ALTER TABLE `tab_mot_pend`
  ADD PRIMARY KEY (`id_mtp`);

--
-- Indexes for table `tab_projeto`
--
ALTER TABLE `tab_projeto`
  ADD PRIMARY KEY (`id_prj`);

--
-- Indexes for table `tab_status`
--
ALTER TABLE `tab_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tab_user`
--
ALTER TABLE `tab_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_in` (`email_in_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_cc`
--
ALTER TABLE `tab_cc`
  MODIFY `id_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tab_cliente`
--
ALTER TABLE `tab_cliente`
  MODIFY `id_clt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tab_fases`
--
ALTER TABLE `tab_fases`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tab_historico`
--
ALTER TABLE `tab_historico`
  MODIFY `id_hst` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_lider_cliente`
--
ALTER TABLE `tab_lider_cliente`
  MODIFY `id_lc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_lider_projeto`
--
ALTER TABLE `tab_lider_projeto`
  MODIFY `id_lp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_mot_pend`
--
ALTER TABLE `tab_mot_pend`
  MODIFY `id_mtp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tab_projeto`
--
ALTER TABLE `tab_projeto`
  MODIFY `id_prj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tab_status`
--
ALTER TABLE `tab_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tab_user`
--
ALTER TABLE `tab_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
