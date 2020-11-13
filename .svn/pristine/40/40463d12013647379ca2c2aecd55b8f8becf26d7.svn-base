-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: siav
-- ------------------------------------------------------
-- Server version	5.7.17-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acionista`
--

DROP TABLE IF EXISTS `acionista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acionista` (
  `idAcionista` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idAcionista`),
  KEY `fk_acionista_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_acionista_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alerta`
--

DROP TABLE IF EXISTS `alerta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerta` (
  `idAlerta` int(11) NOT NULL AUTO_INCREMENT,
  `idCampanha` int(11) NOT NULL,
  `assunto` varchar(255) DEFAULT NULL,
  `texto` text,
  `tipoSelecao` int(11) DEFAULT NULL COMMENT '1 - Todas as Empresas / 2 -  Somente Empresas que Não Iniciaram o Cadastro',
  `totalEmpresas` int(11) DEFAULT NULL COMMENT 'Quantidade total de empresas para as quais foram envido os alertas',
  `situacao` int(11) DEFAULT '1' COMMENT '1 - Rascunho/ 2- Enviado',
  `usuarioAlteracao` varchar(255) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`idAlerta`),
  KEY `fk_alerta_campanha1_idx` (`idCampanha`),
  CONSTRAINT `fk_alerta_campanha1` FOREIGN KEY (`idCampanha`) REFERENCES `campanha` (`idCampanha`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arquivo`
--

DROP TABLE IF EXISTS `arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivo` (
  `idArquivo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArquivo` varchar(255) DEFAULT NULL,
  `novoNome` varchar(100) DEFAULT NULL,
  `dataImportacao` datetime DEFAULT NULL,
  `situacao` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idArquivo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arquivoempresa`
--

DROP TABLE IF EXISTS `arquivoempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivoempresa` (
  `idArquivoEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `idTipoArquivo` int(11) NOT NULL,
  `nomeArquivo` varchar(255) DEFAULT NULL,
  `novoNome` varchar(255) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idArquivoEmpresa`),
  KEY `fk_arquivoempresa_tipoArquivo1_idx` (`idTipoArquivo`),
  KEY `fk_arquivoempresa_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_arquivoempresa_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_arquivoempresa_tipoArquivo1` FOREIGN KEY (`idTipoArquivo`) REFERENCES `tipoarquivo` (`idTipoArquivo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arquivoretificacao`
--

DROP TABLE IF EXISTS `arquivoretificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivoretificacao` (
  `idArqRet` int(11) NOT NULL AUTO_INCREMENT,
  `idRetEmpresa` int(11) NOT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `nomeArquivo` varchar(255) DEFAULT NULL,
  `novoNome` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idArqRet`),
  KEY `fk_arquivoRetificacao_retificacaoempresa1_idx` (`idRetEmpresa`),
  CONSTRAINT `fk_arquivoRetificacao_retificacaoempresa1` FOREIGN KEY (`idRetEmpresa`) REFERENCES `retificacaoempresa` (`idRetEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `atodeclaratorio`
--

DROP TABLE IF EXISTS `atodeclaratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atodeclaratorio` (
  `idAtoDeclaratorio` int(11) NOT NULL AUTO_INCREMENT,
  `idIncentivoEmpresa` int(11) NOT NULL,
  `nomeArquivo` varchar(255) DEFAULT NULL,
  `novoNome` varchar(255) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAtoDeclaratorio`),
  KEY `fk_atodeclaratorio_incentivoempresa1_idx` (`idIncentivoEmpresa`),
  CONSTRAINT `fk_atodeclaratorio_incentivoempresa1` FOREIGN KEY (`idIncentivoEmpresa`) REFERENCES `incentivoempresa` (`idIncentivoEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `autenticacaoempresa`
--

DROP TABLE IF EXISTS `autenticacaoempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autenticacaoempresa` (
  `idAutenticacao` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(20) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`idAutenticacao`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=892 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cadastrofinanceiro`
--

DROP TABLE IF EXISTS `cadastrofinanceiro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cadastrofinanceiro` (
  `idCadastroFinanceiro` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `ehEstimado` int(11) DEFAULT NULL,
  `faturamentoBruto` decimal(18,2) DEFAULT NULL,
  `imobilizadoTotal` decimal(18,2) DEFAULT NULL,
  `reservaExercicio` decimal(18,2) DEFAULT NULL,
  `irDescontada` decimal(18,2) DEFAULT NULL,
  `valorIcms` decimal(18,2) DEFAULT NULL,
  `valorIssqn` decimal(18,2) DEFAULT NULL,
  `empregosDiretos` int(11) DEFAULT NULL,
  `despesaTerceiro` decimal(18,2) DEFAULT NULL,
  `terceirizadosExistentes` int(11) DEFAULT NULL,
  `pessoasEncargos` decimal(18,2) DEFAULT NULL,
  `impostosTaxasContribuicoes` decimal(18,2) DEFAULT NULL,
  `remuneracaoCapitalTerceiros` decimal(18,2) DEFAULT NULL,
  `remuneracaoCapitalProprio` decimal(18,2) DEFAULT NULL,
  `investimentoCapitalFixo` decimal(18,2) DEFAULT NULL,
  `faturamentoProdIncentivados` decimal(18,2) DEFAULT NULL,
  `reservaInvestimento` decimal(18,2) DEFAULT NULL,
  `valorIRtotal` decimal(18,2) DEFAULT NULL,
  `capitalGiro` decimal(18,2) DEFAULT NULL,
  `capitalFixo` decimal(18,2) DEFAULT NULL,
  `maoObraDireta` int(11) DEFAULT NULL,
  `maoObraIndiretaFixa` int(11) DEFAULT NULL,
  `maoObraReal` int(11) DEFAULT NULL,
  `recursosProprios` decimal(18,2) DEFAULT NULL,
  `previsaoIsencao` decimal(18,2) DEFAULT NULL COMMENT 'SUDAM/IRPJ - PREVISAO ISENCAO',
  `acionistas` decimal(18,2) DEFAULT NULL,
  `totalReinvestimento` decimal(18,2) DEFAULT NULL COMMENT 'total da somatoria dos campos:\n- recursos próprios\n- previsao isencao\n- acionistas\n',
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCadastroFinanceiro`),
  KEY `fk_cadastrofinanceiro_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_cadastrofinanceiro_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2432 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `campanha`
--

DROP TABLE IF EXISTS `campanha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campanha` (
  `idCampanha` int(11) NOT NULL AUTO_INCREMENT,
  `campanha` varchar(255) DEFAULT NULL,
  `anoBase` int(11) DEFAULT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `totalEmpresas` int(11) DEFAULT NULL,
  `situacao` int(11) DEFAULT NULL COMMENT 'Situacao da campanha:1 - Pré-Ativa / 2 - Ativa / 3 - Inativa / 4 - Encerrada',
  `usuarioAlteracao` varchar(255) DEFAULT NULL,
  `dataHoraAlteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCampanha`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contatoempresa`
--

DROP TABLE IF EXISTS `contatoempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contatoempresa` (
  `idContatoEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `funcao` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idContatoEmpresa`),
  UNIQUE KEY `idContatoEmpresa_UNIQUE` (`idContatoEmpresa`),
  KEY `fk_contatoempresa_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_contatoempresa_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detalhearquivo`
--

DROP TABLE IF EXISTS `detalhearquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalhearquivo` (
  `idDetalheArquivo` int(11) NOT NULL AUTO_INCREMENT,
  `idArquivo` int(11) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `linha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDetalheArquivo`),
  KEY `fk_detalhearquivo_arquivo1_idx` (`idArquivo`),
  CONSTRAINT `fk_detalhearquivo_arquivo1` FOREIGN KEY (`idArquivo`) REFERENCES `arquivo` (`idArquivo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `idMunicipio` int(11) NOT NULL,
  `idSituacao` int(11) NOT NULL,
  `idIncentivo` int(11) NOT NULL,
  `idModalidade` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `cnpjMatriz` varchar(20) DEFAULT NULL,
  `anoBase` int(11) DEFAULT NULL,
  `anoAprovacao` varchar(45) DEFAULT NULL,
  `razaoSocial` varchar(255) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fonteOrigem` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `enq` varchar(50) DEFAULT NULL,
  `numSudam` varchar(45) DEFAULT NULL,
  `procurador` varchar(255) DEFAULT NULL,
  `laudoData` date DEFAULT NULL,
  `laudoNumero` varchar(45) DEFAULT NULL,
  `anoCalendario` varchar(45) DEFAULT NULL,
  `resolucaoData` date DEFAULT NULL,
  `resolucaoNumero` varchar(45) DEFAULT NULL,
  `declaracaoData` date DEFAULT NULL,
  `declaracaoNumero` varchar(45) DEFAULT NULL,
  `situacaoCadastro` int(11) DEFAULT NULL COMMENT '1 - Iniciado / 2 - Concluído',
  `projetoSocial` int(11) DEFAULT NULL,
  `politicaAmbiental` int(11) DEFAULT NULL,
  `vigente` int(11) DEFAULT NULL COMMENT '1 - Vigente\n0 - Não vigente',
  `anoVigencia` int(11) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`),
  UNIQUE KEY `idEmpresa_UNIQUE` (`idEmpresa`),
  KEY `fk_empresa_municipio1_idx` (`idMunicipio`),
  KEY `fk_empresa_situacao1_idx` (`idSituacao`),
  KEY `fk_empresa_incentivos1_idx` (`idIncentivo`),
  KEY `fk_empresa_modalidade1_idx` (`idModalidade`),
  CONSTRAINT `fk_empresa_incentivos1` FOREIGN KEY (`idIncentivo`) REFERENCES `incentivos` (`idIncentivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_modalidade1` FOREIGN KEY (`idModalidade`) REFERENCES `modalidade` (`idModalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_municipio1` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_situacao1` FOREIGN KEY (`idSituacao`) REFERENCES `situacao` (`idSituacao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2437 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresaalerta`
--

DROP TABLE IF EXISTS `empresaalerta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresaalerta` (
  `idEmpresaAlerta` int(11) NOT NULL AUTO_INCREMENT,
  `idAlerta` int(11) NOT NULL,
  `idCampanha` int(11) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEmpresaAlerta`),
  KEY `fk_empresaalerta_alerta1_idx` (`idAlerta`),
  KEY `fk_empresaalerta_campanha1_idx` (`idCampanha`),
  CONSTRAINT `fk_empresaalerta_alerta1` FOREIGN KEY (`idAlerta`) REFERENCES `alerta` (`idAlerta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresaalerta_campanha1` FOREIGN KEY (`idCampanha`) REFERENCES `campanha` (`idCampanha`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresacampanha`
--

DROP TABLE IF EXISTS `empresacampanha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresacampanha` (
  `idEmpresaCampanha` int(11) NOT NULL AUTO_INCREMENT,
  `idCampanha` int(11) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 - Pendente/ 2 - Iniciado / 3 - Concluído / 4 - Expirado',
  PRIMARY KEY (`idEmpresaCampanha`),
  KEY `fk_empresacampanha_campanha1_idx` (`idCampanha`),
  CONSTRAINT `fk_empresacampanha_campanha1` FOREIGN KEY (`idCampanha`) REFERENCES `campanha` (`idCampanha`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresacontrole`
--

DROP TABLE IF EXISTS `empresacontrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresacontrole` (
  `idEmpresaControle` int(11) NOT NULL AUTO_INCREMENT,
  `idCampanha` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `dataInsercao` datetime DEFAULT NULL,
  `dataAlteracao` datetime DEFAULT NULL,
  `dataConclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`idEmpresaControle`),
  KEY `fk_controle_campanha1_idx` (`idCampanha`),
  KEY `fk_controle_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_controle_campanha1` FOREIGN KEY (`idCampanha`) REFERENCES `campanha` (`idCampanha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_controle_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `historicoretificacao`
--

DROP TABLE IF EXISTS `historicoretificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historicoretificacao` (
  `idHistRet` int(11) NOT NULL AUTO_INCREMENT,
  `idRetEmpresa` int(11) NOT NULL,
  `idRetSudam` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `idEmpresaRet` int(11) DEFAULT NULL,
  `anoBase` int(11) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 - Pendente\n2 - Concluído',
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idHistRet`),
  KEY `fk_historicoretificacao_empresa1_idx` (`idEmpresa`),
  KEY `fk_historicoretificacao_retificacaosudam1_idx` (`idRetSudam`),
  KEY `fk_historicoretificacao_retificacaoempresa1_idx` (`idRetEmpresa`),
  CONSTRAINT `fk_historicoretificacao_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historicoretificacao_retificacaoempresa1` FOREIGN KEY (`idRetEmpresa`) REFERENCES `retificacaoempresa` (`idRetEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historicoretificacao_retificacaosudam1` FOREIGN KEY (`idRetSudam`) REFERENCES `retificacaosudam` (`idRetSudam`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incentivoempresa`
--

DROP TABLE IF EXISTS `incentivoempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incentivoempresa` (
  `idIncentivoEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) DEFAULT NULL,
  `produtoIncentivado` text,
  `fonteOrigem` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `cnae` varchar(50) DEFAULT NULL,
  `faturamento` decimal(18,2) DEFAULT NULL,
  `emprego` int(11) DEFAULT NULL,
  `producao` varchar(45) DEFAULT NULL,
  `idUnidadeProducao` int(11) DEFAULT NULL,
  `capacidadeInstalada` varchar(255) DEFAULT NULL,
  `unidadeDescricao` varchar(255) NOT NULL COMMENT 'Relacionado somente à registros vindos do Arquivo Excel.',
  `idUnidadeCapacidade` varchar(45) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `vigente` int(11) DEFAULT NULL COMMENT '1 - Vigente\n0 - Não vigente',
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idIncentivoEmpresa`),
  KEY `fk_incentivoempresa_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_incentivoempresa_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2432 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incentivos`
--

DROP TABLE IF EXISTS `incentivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incentivos` (
  `idIncentivo` int(11) NOT NULL AUTO_INCREMENT,
  `incentivo` varchar(255) NOT NULL,
  PRIMARY KEY (`idIncentivo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incentivosexcel`
--

DROP TABLE IF EXISTS `incentivosexcel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incentivosexcel` (
  `idincentivo` int(11) NOT NULL AUTO_INCREMENT,
  `sudam_numero` varchar(255) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `situacao` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `uf` varchar(45) DEFAULT NULL,
  `setor` varchar(45) DEFAULT NULL,
  `mob_di` varchar(45) DEFAULT NULL,
  `mob_in` varchar(45) DEFAULT NULL,
  `mob_real` varchar(45) DEFAULT NULL,
  `objetivo` text,
  `cap_instalada` varchar(255) DEFAULT NULL,
  `unidade` varchar(255) DEFAULT NULL,
  `incentivo` varchar(255) DEFAULT NULL,
  `modalidade` varchar(255) DEFAULT NULL,
  `procurador` varchar(255) DEFAULT NULL,
  `data_laudo` varchar(45) DEFAULT NULL,
  `numero_laudo` varchar(45) DEFAULT NULL,
  `capital_fixo` varchar(45) DEFAULT NULL,
  `capital_giro` varchar(45) DEFAULT NULL,
  `enq` varchar(45) DEFAULT NULL,
  `declaracao_data` varchar(45) DEFAULT NULL,
  `declaracao_numero` varchar(45) DEFAULT NULL,
  `resolucao_data` varchar(45) DEFAULT NULL,
  `resolucao_numero` varchar(45) DEFAULT NULL,
  `recursos_proprios` varchar(45) DEFAULT NULL,
  `sudam_irpj` varchar(45) DEFAULT NULL,
  `acionistas` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idincentivo`)
) ENGINE=InnoDB AUTO_INCREMENT=2278 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `insumos`
--

DROP TABLE IF EXISTS `insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insumos` (
  `idInsumo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idInsumo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mercadoconsumidor`
--

DROP TABLE IF EXISTS `mercadoconsumidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mercadoconsumidor` (
  `idMercado` int(11) NOT NULL AUTO_INCREMENT,
  `idIncentivoEmpresa` int(11) NOT NULL,
  `quantidadeRegional` int(11) DEFAULT NULL,
  `valorRegional` double DEFAULT NULL,
  `quantidadeNacional` int(11) DEFAULT NULL,
  `valorNacional` double DEFAULT NULL,
  `quantidadeExterior` int(11) DEFAULT NULL,
  `valorExterior` double DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idMercado`),
  KEY `fk_mercadoConsumidor_incentivoempresa1_idx` (`idIncentivoEmpresa`),
  CONSTRAINT `fk_mercadoConsumidor_incentivoempresa1` FOREIGN KEY (`idIncentivoEmpresa`) REFERENCES `incentivoempresa` (`idIncentivoEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modalidade`
--

DROP TABLE IF EXISTS `modalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidade` (
  `idModalidade` int(11) NOT NULL,
  `idIncentivo` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idModalidade`),
  KEY `fk_modalidade_incentivos1_idx` (`idIncentivo`),
  CONSTRAINT `fk_modalidade_incentivos1` FOREIGN KEY (`idIncentivo`) REFERENCES `incentivos` (`idIncentivo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
  `idMunicipio` int(11) NOT NULL AUTO_INCREMENT,
  `regiao` enum('Norte','Nordeste','Centro-Oeste','Sudeste') DEFAULT NULL COMMENT '1 - Norte\n2 - Nordeste\n3 -  Centro-Oeste\n4 - Sudeste\n',
  `uf` char(2) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `microregiao` varchar(255) DEFAULT NULL,
  `tipologia` enum('1','2','3','4') DEFAULT NULL COMMENT '1 - Alta Renda\n2 - Baixa Renda\n3 - Dinâmica\n4 - Estagnada\n',
  `status` int(11) DEFAULT NULL COMMENT '1 - Ativo\n2 - Inativo',
  PRIMARY KEY (`idMunicipio`)
) ENGINE=InnoDB AUTO_INCREMENT=5300109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `origeminsumos`
--

DROP TABLE IF EXISTS `origeminsumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `origeminsumos` (
  `idOrigemInsumos` int(11) NOT NULL AUTO_INCREMENT,
  `idInsumo` int(11) NOT NULL,
  `idIncentivoEmpresa` int(11) NOT NULL,
  `quantidadeRegional` double DEFAULT NULL,
  `quantidadeNacional` double DEFAULT NULL,
  `quantidadeExterior` double DEFAULT NULL,
  PRIMARY KEY (`idOrigemInsumos`),
  KEY `fk_origemInsumos_insumos1_idx` (`idInsumo`),
  KEY `fk_origemInsumos_incentivoempresa1_idx` (`idIncentivoEmpresa`),
  CONSTRAINT `fk_origemInsumos_incentivoempresa1` FOREIGN KEY (`idIncentivoEmpresa`) REFERENCES `incentivoempresa` (`idIncentivoEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_origemInsumos_insumos1` FOREIGN KEY (`idInsumo`) REFERENCES `insumos` (`idInsumo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `politicaambiental`
--

DROP TABLE IF EXISTS `politicaambiental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `politicaambiental` (
  `idPolitica` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `residuosGerados` varchar(255) DEFAULT NULL,
  `descricaoTratamento` varchar(255) DEFAULT NULL,
  `quantGerado` decimal(18,2) DEFAULT NULL,
  `unidadeQg` varchar(45) DEFAULT NULL,
  `quantTratado` decimal(18,2) DEFAULT NULL,
  `unidadeQt` varchar(45) DEFAULT NULL,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPolitica`),
  KEY `fk_politicaambiental_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_politicaambiental_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projsocioambiental`
--

DROP TABLE IF EXISTS `projsocioambiental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projsocioambiental` (
  `idProjeto` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `nomeProjeto` varchar(255) DEFAULT NULL,
  `descricaoAtividade` varchar(255) DEFAULT NULL,
  `totalDespesas` decimal(18,2) DEFAULT NULL,
  `quantidadePessoas` int(11) DEFAULT NULL,
  `observacoes` text,
  `dataHoraAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idProjeto`),
  UNIQUE KEY `idProjetoProgramaSocialAmbiental_UNIQUE` (`idProjeto`),
  KEY `fk_projsocioambiental_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_projsocioambiental_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `retificacaoempresa`
--

DROP TABLE IF EXISTS `retificacaoempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retificacaoempresa` (
  `idRetEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` int(11) NOT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `anoBase` int(11) DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `justificativa` text,
  `status` int(1) DEFAULT NULL COMMENT '0 - Não Enviado\n1 - Enviado\n2 - Em Análise\n3 - Aprovado pela Sudam\n4 - Negado pela Sudam\n5 - Retificado',
  `dataSolicitacao` datetime DEFAULT NULL,
  `usuarioSolicitacao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRetEmpresa`),
  KEY `fk_retificacaoempresa_empresa1_idx` (`idEmpresa`),
  CONSTRAINT `fk_retificacaoempresa_empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `retificacaosudam`
--

DROP TABLE IF EXISTS `retificacaosudam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retificacaosudam` (
  `idRetSudam` int(11) NOT NULL AUTO_INCREMENT,
  `idRetEmpresa` int(11) NOT NULL,
  `justificativa` text,
  `status` int(11) DEFAULT NULL,
  `dataAlteracao` datetime DEFAULT NULL,
  `usuarioAlteracao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRetSudam`),
  KEY `fk_retificacaosudam_retificacaoempresa1_idx` (`idRetEmpresa`),
  CONSTRAINT `fk_retificacaosudam_retificacaoempresa1` FOREIGN KEY (`idRetEmpresa`) REFERENCES `retificacaoempresa` (`idRetEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `situacao`
--

DROP TABLE IF EXISTS `situacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacao` (
  `idSituacao` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idSituacao`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipoarquivo`
--

DROP TABLE IF EXISTS `tipoarquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoarquivo` (
  `idTipoArquivo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `formato` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idTipoArquivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unidademedida`
--

DROP TABLE IF EXISTS `unidademedida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidademedida` (
  `idUnidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `sigla` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUnidade`)
) ENGINE=InnoDB AUTO_INCREMENT=1060745300 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-10 13:00:13
