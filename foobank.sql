-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: foobank
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Current Database: `foobank`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `foobank` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `foobank`;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `balance` float unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `account_num` int(15) NOT NULL,
  PRIMARY KEY (`account_num`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (53,1,1234),(148,2,5678),(100,2,6789);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tan_numbers`
--

DROP TABLE IF EXISTS `tan_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tan_numbers` (
  `user_id` int(10) unsigned NOT NULL,
  `seq_number` int(10) unsigned NOT NULL,
  `tan` varchar(15) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `expiry_date` datetime NOT NULL,
  `expired` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`tan`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tan_numbers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tan_numbers`
--

LOCK TABLES `tan_numbers` WRITE;
/*!40000 ALTER TABLE `tan_numbers` DISABLE KEYS */;
INSERT INTO `tan_numbers` VALUES (1,5,'1KZLPwf6OiTfvpw','2014-12-12 00:00:00',0),(1,67,'25weKn7R6WclCcw','2014-12-12 00:00:00',0),(1,92,'3H6QfhhfPb98EOg','2014-12-12 00:00:00',0),(1,13,'3Z2wqpFFDu763Lc','2014-12-12 00:00:00',0),(1,77,'3iGIlTg6i9d4VEc','2014-12-12 00:00:00',0),(1,4,'3n39OdIgtirbhon','2014-12-12 00:00:00',0),(1,48,'4WYzw9tc3QgcKGP','2014-12-12 00:00:00',1),(1,30,'4s5mSXnA4qiMmT1','2014-12-12 00:00:00',0),(1,80,'66zOK6Ml7nBLiHt','2014-12-12 00:00:00',0),(1,62,'6WHrrtI3KYbx28l','2014-12-12 00:00:00',0),(1,52,'6WlUeEdlSDmvJFZ','2014-12-12 00:00:00',0),(1,82,'6dSwqds2DpfE1DM','2014-12-12 00:00:00',0),(1,27,'6z8t9QpnZzi3c2B','2014-12-12 00:00:00',0),(1,63,'7HjE12c5DXQzgxH','2014-12-12 00:00:00',0),(1,11,'8F3RwUZZo22IPgS','2014-12-12 00:00:00',0),(1,23,'8Lg4Ie0PRXcZoXu','2014-12-12 00:00:00',0),(1,98,'9L7YPOBdEcWuF5M','2014-12-12 00:00:00',1),(1,9,'BRTraImVddeXnIA','2014-12-12 00:00:00',0),(1,16,'BYOcaHttfqOBscz','2014-12-12 00:00:00',0),(1,15,'Br14dijjnnTlkMx','2014-12-12 00:00:00',0),(1,43,'BsVtyu2Zj1S7cPl','2014-12-12 00:00:00',0),(1,99,'CX72ncmVPenJFP5','2014-12-12 00:00:00',0),(1,60,'DYuVlcLcQhmeiyF','2014-12-12 00:00:00',0),(1,26,'EqHcTJJCyt1OXKm','2014-12-12 00:00:00',0),(1,94,'G9pCQKkxpzOpxT2','2014-12-12 00:00:00',0),(1,32,'HajDC0Zp1TXag7s','2014-12-12 00:00:00',0),(1,66,'HbLmyny4L3LJZR9','2014-12-12 00:00:00',0),(1,39,'Hkndbea0SjmFQmg','2014-12-12 00:00:00',0),(1,56,'HvaWknFeTbpCYm6','2014-12-12 00:00:00',0),(1,59,'IBkXRU1gQkRMija','2014-12-12 00:00:00',0),(1,71,'IWxdyc83Ev4E9hF','2014-12-12 00:00:00',0),(1,87,'Ia1qB5oBd93TsoZ','2014-12-12 00:00:00',0),(1,61,'J7GuUYEL3UvKhTu','2014-12-12 00:00:00',0),(1,35,'JxRimi7LW9hPobQ','2014-12-12 00:00:00',0),(1,14,'KabC4RUW6fhCPxd','2014-12-12 00:00:00',0),(1,17,'KegCZ9k7iOl1yKD','2014-12-12 00:00:00',0),(1,88,'L0EZ6mGmeBuvz0e','2014-12-12 00:00:00',0),(1,86,'LpMFirq24IRxGth','2014-12-12 00:00:00',0),(1,21,'MJ6786FwfMIS4X3','2014-12-12 00:00:00',0),(1,54,'O4PyOt3qVLt663C','2014-12-12 00:00:00',0),(1,12,'P81e0RdpLKGtRax','2014-12-12 00:00:00',0),(1,76,'PzsxsK4bAOfqT8f','2014-12-12 00:00:00',0),(1,38,'QQTooyQqedBLkAV','2014-12-12 00:00:00',0),(1,64,'QteYbLGjFR7gEze','2014-12-12 00:00:00',0),(1,20,'RMFsBuj7IIZO619','2014-12-12 00:00:00',1),(1,74,'Rhj3cGs0TEpFdzl','2014-12-12 00:00:00',0),(1,95,'T20t5bSHlIuT1HY','2014-12-12 00:00:00',0),(1,19,'T7uy9IyjGXwsMl2','2014-12-12 00:00:00',1),(1,90,'UMXYlS9r3etoPif','2014-12-12 00:00:00',0),(1,47,'VagxYjEEeuVRrjf','2014-12-12 00:00:00',0),(1,40,'W1vpgaewG7PHIyH','2014-12-12 00:00:00',0),(1,89,'W94Op6IT7mT14Af','2014-12-12 00:00:00',0),(1,2,'WDFkkJSQaLs97MU','2014-12-12 00:00:00',0),(1,29,'Wl4XU4m8hAyF3R8','2014-12-12 00:00:00',1),(1,33,'WpYySZkyBV2p4BK','2014-12-12 00:00:00',0),(1,53,'WxbBJZ3hzEBPR72','2014-12-12 00:00:00',0),(1,55,'XRzxT9LLgBRiQhf','2014-12-12 00:00:00',0),(1,49,'Ybo4OBeSG7CcPuA','2014-12-12 00:00:00',0),(1,96,'ZOYDRoO0b3poic6','2014-12-12 00:00:00',0),(1,70,'ZgQmMcohckCVtsn','2014-12-12 00:00:00',0),(1,57,'a7OQugP5sv68TMg','2014-12-12 00:00:00',0),(1,28,'b7rjaAtjDhT5voF','2014-12-12 00:00:00',0),(1,8,'bQZ0u6esnoZ2fgp','2014-12-12 00:00:00',0),(1,97,'bvzReusw1T4mlwt','2014-12-12 00:00:00',0),(1,81,'ctJ4ct7dz7C5ahX','2014-12-12 00:00:00',0),(1,41,'d6sGZIkz92Yl7oM','2014-12-12 00:00:00',0),(1,10,'djQ1a9y4rciGUDm','2014-12-12 00:00:00',0),(1,42,'eADPpkpIXvGk3PZ','2014-12-12 00:00:00',0),(1,68,'fkOrLBU96g3IpSZ','2014-12-12 00:00:00',0),(1,78,'gTRPG9aBabP5Gh4','2014-12-12 00:00:00',0),(1,3,'gvVEYTrbCWSMWR0','2014-12-12 00:00:00',0),(1,24,'hJWnBruokzamTYl','2014-12-12 00:00:00',0),(1,93,'j7bDljLJ0nrtWFh','2014-12-12 00:00:00',0),(1,1,'jAjm8nDtp0KA9nh','2014-12-12 00:00:00',0),(1,37,'kTV007ZyJvxqAbH','2014-12-12 00:00:00',0),(1,83,'kg6uaYeY1UX4Pwb','2014-12-12 00:00:00',0),(1,75,'kmQDMWVPdgXVmiL','2014-12-12 00:00:00',0),(1,84,'ks32fkVMdY28duB','2014-12-12 00:00:00',0),(1,18,'lMbzp16ZkbEydwQ','2014-12-12 00:00:00',0),(1,79,'lbcskDBF9kFceah','2014-12-12 00:00:00',0),(1,6,'ljafio8qJrP1Hwg','2014-12-12 00:00:00',0),(1,45,'nTd7CRr5qRw7OPM','2014-12-12 00:00:00',0),(1,25,'oWwJS5oIK5enUI8','2014-12-12 00:00:00',0),(1,44,'otls8RTnZoZfPSu','2014-12-12 00:00:00',0),(1,69,'pKVbpfEmwB9PmBq','2014-12-12 00:00:00',1),(1,65,'pxmP1dGTZKpp9Kc','2014-12-12 00:00:00',0),(1,72,'q6m5izYLXzwZJgG','2014-12-12 00:00:00',0),(1,85,'qUimD7AhX10svFe','2014-12-12 00:00:00',0),(1,31,'rpcmBvgnuDnjJg0','2014-12-12 00:00:00',0),(1,51,'sCoX72YbKeZM6n6','2014-12-12 00:00:00',0),(1,91,'t4enIIjSbh3tZyu','2014-12-12 00:00:00',1),(1,50,'toWHeIHMlBdGdoM','2014-12-12 00:00:00',0),(1,34,'uIlUMnKlTB4ocbl','2014-12-12 00:00:00',0),(1,7,'uoqIz45V1I3Jooz','2014-12-12 00:00:00',0),(1,22,'xmF2UGm3EvBe88X','2014-12-12 00:00:00',0),(1,73,'xoekHSCGKH1FL1n','2014-12-12 00:00:00',0),(1,46,'y35Zm3p4hEi5kwO','2014-12-12 00:00:00',0),(1,36,'yLZZflCpMVrH8Ii','2014-12-12 00:00:00',0),(1,58,'yVROr10xVJOAMmm','2014-12-12 00:00:00',0),(1,100,'zOGwlXAmzEDLzJG','2014-12-12 00:00:00',0);
/*!40000 ALTER TABLE `tan_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `user_id` int(10) unsigned NOT NULL,
  `source_account` int(15) NOT NULL,
  `destination_account` int(15) NOT NULL,
  `amount` float unsigned NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_approved` tinyint(4) DEFAULT '0',
  `approval_date` datetime DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`transaction_id`),
  KEY `user_id` (`user_id`),
  KEY `source_account` (`source_account`),
  KEY `destination_account` (`destination_account`),
  KEY `approved_by` (`approved_by`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`source_account`) REFERENCES `accounts` (`account_num`),
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`destination_account`) REFERENCES `accounts` (`account_num`),
  CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`approved_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1234,1234,20,'2014-10-18 10:26:52',NULL,NULL,NULL,1),(1,1234,5678,2,'0000-00-00 00:00:00',1,NULL,NULL,2),(1,1234,5678,2,'0000-00-00 00:00:00',1,NULL,NULL,3),(1,1234,5678,2,'2014-10-22 12:16:41',1,NULL,NULL,4),(1,1234,5678,2,'2014-10-22 12:22:31',1,NULL,NULL,5),(1,1234,5678,2,'2014-10-22 12:23:37',1,NULL,NULL,6),(1,1234,5678,1,'2014-10-22 12:24:49',1,NULL,NULL,7),(1,1234,5678,2,'2014-10-22 14:11:01',1,NULL,NULL,8),(1,1234,5678,2,'2014-10-23 21:55:27',1,NULL,NULL,9),(1,1234,5678,2,'2014-10-23 21:56:08',1,NULL,NULL,10),(1,1234,5678,2,'2014-10-23 21:56:30',1,NULL,NULL,11),(1,1234,5678,2,'2014-10-23 21:59:25',1,NULL,NULL,12),(1,1234,5678,1,'2014-10-23 22:01:27',1,NULL,NULL,13),(1,1234,5678,1,'2014-10-23 22:02:24',1,NULL,NULL,14),(1,1234,5678,1,'2014-10-23 22:02:24',1,NULL,NULL,15),(1,1234,5678,1,'2014-10-23 22:03:29',1,NULL,NULL,16),(1,1234,5678,1,'2014-10-23 22:20:26',1,NULL,NULL,17),(1,1234,5678,1,'2014-10-23 22:35:47',1,NULL,NULL,18),(1,1234,5678,1,'2014-10-23 22:37:00',1,NULL,NULL,19),(1,1234,5678,1,'2014-10-24 15:23:58',1,NULL,NULL,20),(1,1234,5678,2,'2014-10-24 15:24:10',1,NULL,NULL,21),(1,1234,5678,1,'2014-10-24 15:27:04',1,NULL,NULL,22),(1,1234,5678,1.5,'2014-10-24 15:28:43',1,NULL,NULL,23),(1,1234,5678,2.1,'2014-10-24 15:28:44',1,NULL,NULL,24);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `activation_date` datetime DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (NULL,'2014-10-18 12:25:42',NULL,'user','dummy@dummy.com',1,'dummy1234','5c90b96a75d4f9d5a1cfaa6f532afdc8'),('2014-10-21 13:36:37','2014-10-21 13:36:37',1,'user','darwin@hmsbeagle.com',2,'darwin','5ebe2294ecd0e0f08eab');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-25  0:34:54
