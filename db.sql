-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: localhost    Database: hh_wiki
-- ------------------------------------------------------
-- Server version	5.6.11

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
-- Table structure for table `hh_content`
--

DROP TABLE IF EXISTS `hh_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hh_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `term` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `description` text,
  `subject` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hh_content`
--

LOCK TABLES `hh_content` WRITE;
/*!40000 ALTER TABLE `hh_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `hh_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hh_grade`
--

DROP TABLE IF EXISTS `hh_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hh_grade` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hh_grade`
--

LOCK TABLES `hh_grade` WRITE;
/*!40000 ALTER TABLE `hh_grade` DISABLE KEYS */;
INSERT INTO `hh_grade` VALUES (1,'初一'),(2,'初二'),(3,'初三'),(4,'其他');
/*!40000 ALTER TABLE `hh_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hh_subject`
--

DROP TABLE IF EXISTS `hh_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hh_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hh_subject`
--

LOCK TABLES `hh_subject` WRITE;
/*!40000 ALTER TABLE `hh_subject` DISABLE KEYS */;
INSERT INTO `hh_subject` VALUES (1,'数学'),(2,'物理'),(3,'化学'),(4,'英语'),(5,'地理'),(6,'生物'),(7,'电脑'),(8,'其他');
/*!40000 ALTER TABLE `hh_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hh_term`
--

DROP TABLE IF EXISTS `hh_term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hh_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hh_term`
--

LOCK TABLES `hh_term` WRITE;
/*!40000 ALTER TABLE `hh_term` DISABLE KEYS */;
INSERT INTO `hh_term` VALUES (1,'上学期'),(2,'下学期');
/*!40000 ALTER TABLE `hh_term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hh_type`
--

DROP TABLE IF EXISTS `hh_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hh_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hh_type`
--

LOCK TABLES `hh_type` WRITE;
/*!40000 ALTER TABLE `hh_type` DISABLE KEYS */;
INSERT INTO `hh_type` VALUES (1,'课件','讲课要用到的幻灯片等课件'),(2,'资料','章总结，考试知识点文档，思维导图等资料'),(3,'视频','视频课程'),(4,'答案','习题，练习册的答案'),(5,'学校考卷','学校组织的考试，期中，期末，月考等正规试卷'),(6,'测试题','参考资料，网络等处收集的考卷测试题，非学校正规考试'),(7,'其他','其他类资料');
/*!40000 ALTER TABLE `hh_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-11 14:09:39
