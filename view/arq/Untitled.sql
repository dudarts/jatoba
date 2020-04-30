-- MySQL dump 10.13  Distrib 5.6.22, for osx10.8 (x86_64)
--
-- Host: localhost    Database: jatoba
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `Cidade`
--

DROP TABLE IF EXISTS `Cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cidade` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cidade`
--

LOCK TABLES `Cidade` WRITE;
/*!40000 ALTER TABLE `Cidade` DISABLE KEYS */;
INSERT INTO `Cidade` VALUES (1,'Feira de Santna',NULL);
/*!40000 ALTER TABLE `Cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Marca`
--

DROP TABLE IF EXISTS `Marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Marca` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Marca`
--

LOCK TABLES `Marca` WRITE;
/*!40000 ALTER TABLE `Marca` DISABLE KEYS */;
INSERT INTO `Marca` VALUES (1,'Suave Fragrance'),(2,'Facinatus'),(3,'Fitoway'),(4,'Yes Comestics');
/*!40000 ALTER TABLE `Marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedido`
--

DROP TABLE IF EXISTS `Pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pedido` (
  `codigo` int(11) NOT NULL,
  `dataPedido` varchar(45) DEFAULT NULL,
  `dataDownload` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `Status_codigo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`,`Status_codigo`),
  KEY `fk_Pedido_Status1_idx` (`Status_codigo`),
  CONSTRAINT `fk_Pedido_Status1` FOREIGN KEY (`Status_codigo`) REFERENCES `Status` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedido`
--

LOCK TABLES `Pedido` WRITE;
/*!40000 ALTER TABLE `Pedido` DISABLE KEYS */;
INSERT INTO `Pedido` VALUES (1,'2016-09-19',NULL,'1',1);
/*!40000 ALTER TABLE `Pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedido_Produto`
--

DROP TABLE IF EXISTS `Pedido_Produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pedido_Produto` (
  `pedido` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valorUnitario` decimal(10,2) DEFAULT NULL,
  `valorCompra` decimal(10,2) DEFAULT NULL,
  `valorVenda` decimal(10,2) DEFAULT NULL,
  `valorLucro` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`pedido`,`produto`),
  KEY `fk_Pedido_has_Produto_Produto1_idx` (`produto`),
  KEY `fk_Pedido_has_Produto_Pedido1_idx` (`pedido`),
  CONSTRAINT `fk_Pedido_has_Produto_Pedido1` FOREIGN KEY (`pedido`) REFERENCES `Pedido` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_has_Produto_Produto1` FOREIGN KEY (`produto`) REFERENCES `Produto` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedido_Produto`
--

LOCK TABLES `Pedido_Produto` WRITE;
/*!40000 ALTER TABLE `Pedido_Produto` DISABLE KEYS */;
INSERT INTO `Pedido_Produto` VALUES (1,1,5,10.00,50.00,30.00,20.00),(1,2,1,5.00,5.00,3.00,2.00),(1,3,2,13.00,26.00,18.20,7.80);
/*!40000 ALTER TABLE `Pedido_Produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pessoa`
--

DROP TABLE IF EXISTS `Pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pessoa` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `cpf` char(11) DEFAULT NULL,
  `pontoReferencia` varchar(45) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `Status_codigo` int(11) NOT NULL,
  `Cidade_codigo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_Pessoa_Status1_idx` (`Status_codigo`),
  KEY `fk_Pessoa_Cidade1_idx` (`Cidade_codigo`),
  CONSTRAINT `fk_Pessoa_Cidade1` FOREIGN KEY (`Cidade_codigo`) REFERENCES `Cidade` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pessoa_Status1` FOREIGN KEY (`Status_codigo`) REFERENCES `Status` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pessoa`
--

LOCK TABLES `Pessoa` WRITE;
/*!40000 ALTER TABLE `Pessoa` DISABLE KEYS */;
INSERT INTO `Pessoa` VALUES (1,'Eduardo Mendes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1);
/*!40000 ALTER TABLE `Pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Produto`
--

DROP TABLE IF EXISTS `Produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Produto` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `Marca_codigo` int(11) NOT NULL,
  `Status_codigo` int(11) NOT NULL,
  `desconto` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`codigo`,`Marca_codigo`,`Status_codigo`),
  KEY `fk_Produto_Marca1_idx` (`Marca_codigo`),
  KEY `fk_Produto_Status1_idx` (`Status_codigo`),
  CONSTRAINT `fk_Produto_Marca1` FOREIGN KEY (`Marca_codigo`) REFERENCES `Marca` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Status1` FOREIGN KEY (`Status_codigo`) REFERENCES `Status` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produto`
--

LOCK TABLES `Produto` WRITE;
/*!40000 ALTER TABLE `Produto` DISABLE KEYS */;
INSERT INTO `Produto` VALUES (1,'Sabonete Íntimo de Menta',10.00,1,1,40.00),(2,'Creme Lizza Derm',5.00,1,1,40.00),(3,'Facínio - Sabone Íntimo',13.00,1,1,30.00);
/*!40000 ALTER TABLE `Produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Status`
--

DROP TABLE IF EXISTS `Status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Status` (
  `codigo` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Status`
--

LOCK TABLES `Status` WRITE;
/*!40000 ALTER TABLE `Status` DISABLE KEYS */;
INSERT INTO `Status` VALUES (0,'Inativo'),(1,'Ativo');
/*!40000 ALTER TABLE `Status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-25  8:48:04
