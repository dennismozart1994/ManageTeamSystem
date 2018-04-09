-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09-Abr-2018 às 21:14
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
  `nome_clt` varchar(255) NOT NULL,
  `active_clt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_cliente`
--

INSERT INTO `tab_cliente` (`id_clt`, `modalidade_clt`, `nome_clt`, `active_clt`) VALUES
(1, 'ATS', 'Redecard', 0),
(2, 'ATS', 'CIELO', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_fases`
--

CREATE TABLE `tab_fases` (
  `id_f` int(11) NOT NULL,
  `nome_f` varchar(255) NOT NULL,
  `desc_f` longtext NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_fases`
--

INSERT INTO `tab_fases` (`id_f`, `nome_f`, `desc_f`, `id_user`) VALUES
(1, 'Planejamento', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at metus nibh. Suspendisse ultricies quis elit in auctor. Ut sagittis dui sit amet lorem posuere interdum.', 1),
(2, 'Modelagem', '', 1),
(3, 'Estimativa', '', 1),
(4, 'Execução', '', 1),
(5, 'Finalizado', '', 1),
(6, 'Não se Aplica', '', 1),
(7, 'Regressivo', '', 1),
(8, 'Cancelado', '', 1);

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
  `id_prj` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_historico`
--

INSERT INTO `tab_historico` (`id_hst`, `data_hst`, `id_f`, `prvt_hst`, `rlzd_hst`, `desc_hst`, `id_prj`, `id_user`) VALUES
(1, '2018-04-09', 1, '100', '0', 'Projeto recebido para estimativa de custos', 1, 5),
(2, '2018-04-09', 1, '100', '0', 'Projeto recebido para estimativa de custos', 2, 5),
(3, '2018-04-09', 8, '', '', 'Alto Custo - ', 1, 5),
(4, '2018-04-09', 8, '', '', 'Cobertura - ', 2, 5),
(5, '2018-04-09', 1, '100', '0', 'Projeto recebido para estimativa de custos', 3, 5),
(6, '2018-04-09', 1, '100', '0', 'Projeto recebido para estimativa de custos', 4, 5),
(7, '2018-04-09', 8, '', '', 'Estratégia Interna do cliente - ', 3, 5),
(8, '2018-04-09', 8, '', '', 'Outros - ', 4, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_lider_cliente`
--

CREATE TABLE `tab_lider_cliente` (
  `id_lc` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `nome_lc` varchar(255) NOT NULL,
  `email_lc` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active_lc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_lider_cliente`
--

INSERT INTO `tab_lider_cliente` (`id_lc`, `id_clt`, `nome_lc`, `email_lc`, `id_user`, `active_lc`) VALUES
(1, 1, 'Não informado', 'na@na.com', 1, 0),
(2, 1, 'Cesar Luiz de Oliveira', 'cesar.oliveira@userede.com.br', 1, 0),
(3, 1, 'Daniel Alves dos Santos', 'daniel.santos@redecard.com.br', 1, 0),
(4, 1, 'Marcello Alves de Souza', 'marcello.souza@redecard.com.br', 1, 0),
(5, 1, 'Claudia Helena dos Reis Mazoni', 'claudia.mazoni@redecard.com.br', 1, 0),
(6, 1, 'Emerson Rogerio Camargo Motta', 'emerson.motta@redecardsa.rccorp.net', 1, 0),
(7, 1, 'Marcelo Casseb de Souza', 'marcelo.souza@redecard.com.br', 1, 0),
(8, 1, 'Paulo Cesar Rodrigues', 'paulo.rodrigues@redecard.com.br', 1, 0),
(9, 1, 'Lucas Leite Cesar', 'lucas.leite@redecard.com.br', 1, 0),
(10, 1, 'Amandia Neta Silva Santos', 'amandia.santos@redecard.com.br', 1, 0),
(11, 1, 'Fabiana Castello', 'fabiana.castello@redecard.com.br', 1, 0),
(12, 1, 'Rafael Rodrigues Sapia', 'rafael.sapia@redecardsa.rccorp.net', 1, 0),
(13, 1, 'Nanci Leal Rabello', 'nanci.rabello@redecard.com.br', 1, 0),
(14, 1, 'Junior', 'junior@userede.com.br', 1, 0),
(15, 1, 'Enoch Lima Sacramento Junior', 'enoch.lima@userede.com.br', 1, 0),
(16, 1, 'Gustavo Lima Vasconcelos', 'gustavo.vasconcelos@userede.com.br', 1, 0),
(17, 1, 'Leandro Silva Netario Moura', 'servicoinmetrics719178@redecard.com.br', 1, 0),
(18, 1, 'Roberto José Rocha', 'roberto.rocha@userede.com.br', 1, 0),
(19, 1, 'Bruno Almeida Ribeiro', 'bruno.ribeiro2@redecard.com.br', 1, 0),
(20, 1, 'Sergio Luis de Andrade', 'sergio.andrade@redecard.com.br', 1, 0),
(21, 1, 'André Oliveira', 'oliveira.andre@redecard.com.br', 1, 0),
(22, 1, 'Anderson Silva Viana', 'servicoyaman719952@redecard.com.br', 1, 0),
(23, 1, '', '', 5, 1),
(24, 1, 'sadasd', 'asdasd@asdasd', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_lider_projeto`
--

CREATE TABLE `tab_lider_projeto` (
  `id_lp` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `nome_lp` varchar(255) NOT NULL,
  `email_lp` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active_lp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_lider_projeto`
--

INSERT INTO `tab_lider_projeto` (`id_lp`, `id_clt`, `nome_lp`, `email_lp`, `id_user`, `active_lp`) VALUES
(1, 1, 'Não Informado', 'na@na.com', 1, 0),
(2, 1, 'Stephanie Campos', 'stephanie.campos@redecard.com.br', 1, 0),
(3, 1, 'Paulo Cesar Rodrigues', 'paulo.rodrigues@redecard.com.br', 1, 0),
(4, 1, 'Mario Adão', 'mario.adao@redecard.com.br', 1, 0),
(5, 1, 'Fernando Brum de Alcantara', 'fernando.alcantara@redecard.com.br', 1, 0),
(6, 1, 'Diogo Fernandes da Silva', 'diogo.fernandes@redecard.com.br', 1, 0),
(7, 1, 'Andrezza Yamaguchi', 'andrezza.yamaguchi@redecard.com.br', 1, 0),
(8, 1, 'Bruna Guimaraes Silva', 'bruna.silva@redecard.com.br', 1, 0),
(9, 1, 'Jessica Soares Barbosa', 'jessica.barbosa@redecard.com.br', 1, 0),
(10, 1, 'João Carvalho de Oliveira', 'joao.carvalho@redecard.com.br', 1, 0),
(11, 1, 'Guilherme Ginez da Silva', 'guilherme.silva@redecard.com.br', 1, 0),
(12, 1, 'Rogério Bianco', 'rogério.bianco@redecard.com.br', 1, 0),
(13, 1, 'Ricardo Cardorini', 'ricardo_cardorini5@redecard.com.br', 1, 0),
(14, 1, 'Lucas Leite Cesar', 'lucas.leite@redecard.com.br', 1, 0),
(15, 1, 'Rodrigo Fernando Mafioletti Staejak', 'rodrigo.staejak@redecard.com.br', 1, 0),
(16, 1, 'Ligia Maria da Silva Andrade', 'ligia.andrade@redecard.com.br', 1, 0),
(17, 1, 'Marcelo Aparecido de Simoni', 'marcelo.aparecido@redecard.com.br', 1, 0),
(18, 1, 'Enoch Lima Sacramento Junior', 'enoch.lima@userede.com.br', 1, 0),
(19, 1, 'Daniel Rodrigo Gerardo', 'daniel.gerardo@redecard.com.br', 1, 0),
(20, 1, 'Thiago Tanikawa de Primo', 'thiago.primo@redecard.com.br', 1, 0),
(21, 1, 'Rafael Albuquerque', 'rafael.albuquerque@userede.com.br', 1, 0),
(22, 1, 'Suzanne Rocha Lanfranchi de Aguiar', 'suzanne.aguiar@redecard.com.br', 1, 0),
(23, 1, 'Juliana Schuster dos Santos', 'juliana.schuster@userede.com.br', 1, 0),
(24, 1, 'Ademir Oliveira Melim', 'ademir.melim@redecard.com.br', 1, 0),
(25, 1, 'Rafael Godoy Freitas', 'rafael.godoy@redecard.com.br', 1, 0),
(26, 1, 'Claudinei Gibin Garcia', 'claudinei.garcia@redecard.com.br', 1, 0),
(27, 1, 'Marcelo José Izidro Faria', 'marcelo.faria@redecard.com.br', 1, 0),
(28, 1, 'Allan Magalhães da Silva', 'allan.silva@redecard.com.br', 1, 0),
(29, 1, 'Nataly Cuelhar', 'nataly.cuelhar@redecardsa.rccorp.net', 1, 0),
(30, 1, 'Renato Valenca Arruda Vieira', 'renato.vieira@userede.com.br', 1, 0),
(31, 1, 'Lucianne Cristhina B Charro', 'lucianne.charro@redecard.com.br', 1, 0),
(32, 1, 'Levy Angelo Minewaki Shinya', 'levy.shinya@redecard.com.br', 1, 0),
(33, 1, 'Tayna Lima Cordeiro', 'tayna.cordeiro@userede.com.br', 1, 0),
(34, 1, 'Ivo Henrique Porto de Souza', 'ivo.souza@redecard.com.br', 1, 0),
(35, 1, 'Priscila de Souza Peres', 'priscila.peres@userede.com.br', 1, 0),
(36, 1, 'Guilherme Araujo Bolango', 'guilherme.bolango@redecard.com.br', 1, 0),
(37, 1, 'Elisabeth Campezi Lazzarini', 'elisabeth.lazzarini@userede.com.br', 1, 0),
(38, 1, 'Sandra Silveira', 'sandra.silveira@redecard.com.br', 1, 0),
(39, 1, 'Marcelo Aguiar', 'marcelo.aguiar@redecard.com.br', 1, 0),
(40, 1, 'Marcelo Casseb de Souza', 'marcelo.souza@redecard.com.br', 1, 0),
(41, 1, 'Alison Medeiros de Souza', 'alison.souza@redecard.com.br', 1, 0),
(42, 1, 'Thales Carmozini', 'thales.carmozini@redecard.com.br', 1, 0),
(43, 1, 'Renata Meire Dupim', 'renata.dupim@redecard.com.br', 1, 0),
(44, 1, 'Guilherme Augustus Cruz Garcia', 'guilherme.augustus@redecard.com.br', 1, 0),
(45, 1, 'Claudia Helena dos Reis Mazoni Andrade', 'claudia.mazoni@redecard.com.br', 1, 0),
(46, 1, 'Daniel Alves dos Santos', 'daniel.santos@redecard.com.br', 1, 0),
(47, 1, 'Emerson Rogerio Camargo Motta', 'emerson.motta@redecardsa.rccorp.net', 1, 0),
(48, 1, 'Guilherme Ayusso Guimaraes', 'guilherme.guimaraes@userede.com.br', 1, 0),
(49, 1, 'Daniel Cicoti', 'daniel.cicoti@redecard.com.br', 1, 0),
(50, 1, 'Caroline Peixoto Silva', 'caroline_peixoto_silva4@redecard.com.br', 1, 0),
(51, 1, 'Sergio Luis de Andrade', 'sergio.andrade@redecard.com.br', 1, 0),
(52, 1, 'Tiago Gomes Sales', 'tiago.sales@redecard.com.br', 1, 0),
(53, 1, 'Guilherme Oliveira Tenuta', 'guilherme.tenuta@redecard.com.br', 1, 0),
(54, 1, 'Gian Felipe Guerra do Nascimento', 'gian.nascimento@redecard.com.br', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_mot_pend`
--

CREATE TABLE `tab_mot_pend` (
  `id_mtp` int(11) NOT NULL,
  `nome_mtp` varchar(255) NOT NULL,
  `desc_mtp` longtext NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_mot_pend`
--

INSERT INTO `tab_mot_pend` (`id_mtp`, `nome_mtp`, `desc_mtp`, `id_user`) VALUES
(1, 'Agendamento de Reunião', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at metus nibh.', 1),
(2, 'Recebimento de Documentação', '', 1),
(3, 'Massa de Dados', '', 1),
(4, 'Liberação do Ambiente', '', 1),
(5, 'Aprovação do Cronograma', '', 1),
(6, 'Aprovação do RTF', '', 1),
(7, 'Não se Aplica', '', 0);

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
  `description_notify` varchar(255) NOT NULL,
  `active_notify` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_notify`
--

INSERT INTO `tab_notify` (`id_notify`, `id_projeto`, `id_from_user`, `id_to_user`, `status_notify`, `description_notify`, `active_notify`) VALUES
(2, 8, 5, 5, 'Novo projeto!', 'Você possui um novo projeto sob sua responsabilidade!', 0),
(3, 9, 11, 4, 'Novo projeto!', 'Você possui um novo projeto sob sua responsabilidade!', 0),
(4, 1, 5, 4, 'Novo projeto!', 'Você possui um novo projeto sob sua responsabilidade!', 0),
(5, 2, 5, 4, 'Novo projeto!', 'Você possui um novo projeto sob sua responsabilidade!', 0),
(6, 3, 5, 4, 'Novo projeto!', 'Você possui um novo projeto sob sua responsabilidade!', 0),
(7, 4, 5, 4, 'Novo projeto!', 'Você possui um novo projeto sob sua responsabilidade!', 0);

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
(1, '1513186557930', 'teste', 1, 1, 1, 5, 4, 8, 1, 1, 1, 1, 1, 1, 1),
(2, '1513186175125', 'teste', 1, 1, 1, 5, 4, 8, 1, 1, 1, 1, 1, 1, 1),
(3, '1513256976175', 'teste', 1, 1, 1, 5, 4, 8, 1, 1, 1, 1, 1, 1, 1),
(4, '1513263102620', 'teste', 1, 1, 1, 5, 4, 8, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_reason`
--

CREATE TABLE `tab_reason` (
  `id_reason` int(11) NOT NULL,
  `name_reason` varchar(255) NOT NULL,
  `desc_reason` longtext NOT NULL,
  `active_reason` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `last_update_reason` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_reason`
--

INSERT INTO `tab_reason` (`id_reason`, `name_reason`, `desc_reason`, `active_reason`, `id_user`, `last_update_reason`) VALUES
(1, 'Alto Custo', '', 0, 17, '2017-10-30'),
(2, 'Cobertura', '', 0, 17, '2017-11-08'),
(3, 'Estratégia Interna do cliente', '', 0, 5, '2018-04-09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_status`
--

CREATE TABLE `tab_status` (
  `id_status` int(11) NOT NULL,
  `nome_status` varchar(255) NOT NULL,
  `desc_status` longtext NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_status`
--

INSERT INTO `tab_status` (`id_status`, `nome_status`, `desc_status`, `id_user`) VALUES
(1, 'Aguard. Aprovação', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at metus nibh. Suspendisse ultricies quis elit in auctor. Ut sagittis dui sit amet lorem posuere interdum.', 1),
(2, 'Em Andamento', '', 1),
(3, 'Pendente Cliente', '', 1),
(4, 'Aguard. Execução', '', 1),
(5, 'Não Iniciado', '', 1),
(6, 'Pendente Fábrica', '', 1),
(7, 'Atrasado', '', 1),
(8, 'Finalizado', '', 0),
(9, 'Cancelado', '', 0),
(10, 'Não se Aplica', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_treina`
--

CREATE TABLE `tab_treina` (
  `id_treina` int(11) NOT NULL,
  `tema_treina` varchar(255) NOT NULL,
  `desc_treina` longtext NOT NULL,
  `local_treina` varchar(255) NOT NULL,
  `date_treina` date NOT NULL,
  `time_treina` time NOT NULL,
  `id_users` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_treina`
--

INSERT INTO `tab_treina` (`id_treina`, `tema_treina`, `desc_treina`, `local_treina`, `date_treina`, `time_treina`, `id_users`) VALUES
(1, 'Teste de Treinamento', 'Resumo sobre o tema do treinamento', 'Sala Leonardo da Vinci', '2017-11-24', '15:00:00', 'start_6_10'),
(2, 'Teste de Treinamento 2', 'Resumo sobre o tema do treinamento', 'Sala Leonardo da Vinci', '2017-11-27', '14:00:00', 'start_5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_user`
--

CREATE TABLE `tab_user` (
  `id_user` int(11) NOT NULL,
  `id_cc` int(11) NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `funcao_user` varchar(255) NOT NULL,
  `tel_user` varchar(255) NOT NULL,
  `email_in_user` varchar(255) NOT NULL,
  `senha_user` varchar(255) NOT NULL,
  `thumbnail_user` varchar(255) NOT NULL,
  `active_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_user`
--

INSERT INTO `tab_user` (`id_user`, `id_cc`, `nome_user`, `funcao_user`, `tel_user`, `email_in_user`, `senha_user`, `thumbnail_user`, `active_user`) VALUES
(1, 1, 'Vitor Tanoue', 'Analista de Testes Sr.', '999998888', 'vitanoue@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac.jpg', 1),
(2, 1, 'Alex Arruda', 'Analista de Testes Pl.', '999998888', 'alexarr@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia.jpg', 1),
(3, 1, 'Tarcísia Ferreira', 'Analista de Testes Jr.', '999998888', 'tarcismot@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (27).jpg', 1),
(4, 1, 'Victor dos Santos', 'Analista de Testes Jr.', '999998888', 'victorsa@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (26).jpg', 0),
(5, 1, 'Dennis Mozart', 'Administrador', '999998888', 'densilva@inmetrics.com.br', 'Redecard01', 'e9bd35d29ae676109dbe9f9458e15203.png', 0),
(6, 1, 'Marcos Paulo', 'Analista de Testes Sr.', '999998888', 'mpafonso@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (24).jpg', 0),
(7, 1, 'José Carlos', 'Analista de Testes Jr.', '999998888', 'josemaci@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (23).jpg', 1),
(8, 1, 'Thiago Tittz', 'Analista de Testes Sr.', '999998888', 'thitittz@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (22).jpg', 1),
(9, 1, 'Thiales Douglas', 'Analista de Testes Jr.', '999998888', 'thialeds@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (21).jpg', 1),
(10, 1, 'Sergio Alexandre', 'Analista de Testes Pl.', '999998888', 'sergiome@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (20).jpg', 1),
(11, 1, 'Renan Dias', 'Analista de Testes Jr.', '999998888', 'rensilva@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (19).jpg', 0),
(12, 1, 'Rafaela Nascimento Tavares', 'Analista de Testes Jr.', '999998888', 'raftavares@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (18).jpg', 1),
(13, 1, 'Aline Aparecida de Azevedo Araujo Santos', 'Analista de Testes Pl.', '999998888', 'alsantos@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (17).jpg', 1),
(14, 1, 'Jessica Caroline', 'Analista de Testes Jr.', '999998888', 'jessicas@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (16).jpg', 0),
(15, 1, 'Israel José', 'Analista de Testes Pl.', '999998888', 'jomiguel@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (15).jpg', 1),
(16, 1, 'Diones Pereira', 'Líder de Testes', '999998888', 'digpere@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (14).jpg', 0),
(17, 1, 'Rafael Alexandrino', 'Líder de Testes', '999998888', 'rafsouza@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (13).jpg', 0),
(18, 1, 'William Casanova', 'Auxiliar de Testes', '999998888', 'wilcasanova@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (12).jpg', 1),
(19, 1, 'Nathan Guilherme Gomes', 'Analista de Testes Pl.', '999998888', 'naggomes@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (11).jpg', 1),
(20, 1, 'Renam Nogueira', 'Analista de Testes Jr.', '999998888', 'reapolin@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (10).jpg', 1),
(21, 1, 'Marcos Henrique', 'Analista de Testes Jr.', '999998888', 'marcosil@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (9).jpg', 1),
(22, 1, 'Gillamy Costa', 'Analista de Testes Jr.', '999998888', 'gilcosta@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (8).jpg', 1),
(23, 1, 'Thamires Nascimento', 'Analista de Testes Jr.', '999998888', 'thamisil@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (7).jpg', 1),
(24, 1, 'Michele Souza', 'Analista de Testes Jr.', '999998888', 'micsouza@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (6).jpg', 1),
(25, 1, 'Aline Rodrigues', 'Analista de Testes Jr.', '+55 (11) 99998-8888', 'alinerod@inmetrics.com.br', 'Redecard01', 'd11efd830de501722eddc1b6a67aee08.png', 0),
(26, 1, 'Lucas Alves Pereira', 'Analista de Automação Jr.', '999998888', 'lpereira@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (2).jpg', 1),
(27, 1, 'Viviane Pereira', 'Analista de Testes Jr.', '999998888', 'vivipereira@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (3).jpg', 1),
(28, 1, 'Mike Tyson Schwarzenegger Pradella', 'Auxiliar de Automação', '999998888', 'pradella@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (4).jpg', 1),
(29, 1, 'Marcos Makoto Eto', 'Analista de Testes Jr.', '999998888', 'marcoeto@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (28).jpg', 1),
(30, 1, 'Adriano Lopes de Lima', 'Auxiliar de Testes', '999998888', 'adrilima@inmetrics.com.br', 'Redecard01', '37db2b4a8471fc9c1714cdb7d34469ac - Copia (29).jpg', 1);

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
-- Indexes for table `tab_notify`
--
ALTER TABLE `tab_notify`
  ADD PRIMARY KEY (`id_notify`);

--
-- Indexes for table `tab_projeto`
--
ALTER TABLE `tab_projeto`
  ADD PRIMARY KEY (`id_prj`);

--
-- Indexes for table `tab_reason`
--
ALTER TABLE `tab_reason`
  ADD PRIMARY KEY (`id_reason`);

--
-- Indexes for table `tab_status`
--
ALTER TABLE `tab_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tab_treina`
--
ALTER TABLE `tab_treina`
  ADD PRIMARY KEY (`id_treina`);

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
  MODIFY `id_hst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tab_lider_cliente`
--
ALTER TABLE `tab_lider_cliente`
  MODIFY `id_lc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tab_lider_projeto`
--
ALTER TABLE `tab_lider_projeto`
  MODIFY `id_lp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `tab_mot_pend`
--
ALTER TABLE `tab_mot_pend`
  MODIFY `id_mtp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tab_notify`
--
ALTER TABLE `tab_notify`
  MODIFY `id_notify` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tab_projeto`
--
ALTER TABLE `tab_projeto`
  MODIFY `id_prj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tab_reason`
--
ALTER TABLE `tab_reason`
  MODIFY `id_reason` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tab_status`
--
ALTER TABLE `tab_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tab_treina`
--
ALTER TABLE `tab_treina`
  MODIFY `id_treina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tab_user`
--
ALTER TABLE `tab_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
