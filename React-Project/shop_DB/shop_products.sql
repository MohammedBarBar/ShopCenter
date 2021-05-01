-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.7.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `idProducts` int(11) NOT NULL AUTO_INCREMENT,
  `ProductsName` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `Image` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `CategoryId` int(11) DEFAULT NULL,
  `CategorName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idProducts`),
  KEY `CategoryId_idx` (`CategoryId`),
  CONSTRAINT `CategoryId` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`idCategories`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (14,'HP PAVLION',1300,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/11/HP-15-CS3002NJ-600x600.png.webp',1,'Laptops'),(15,'ACER NITRO',2000,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/ACER-NHQ9HEC009-600x600.png.webp',1,'Laptops'),(16,'Lenovo gamin',1500,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2021/01/LAP-82EY00JFIV-600x600.png.webp',1,'Laptops'),(17,'ASOUS VivoBook',1800,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/S530FN-BQ012T-600x600.png.webp',1,'Laptops'),(18,'HEADSET LOGITECH ',120,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/G432-600x600.png.webp',3,'HEADSET'),(19,'HEADSET LENOVO H500',90,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/Lenovo-H500-Pro-600x600.png.webp',3,'HEADSET'),(20,'HEADSET CORSAIR HS50',100,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/HS50-600x600.png.webp',3,'HEADSET'),(21,'KEYBORD LOGITECH',300,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2021/03/KB-G613-WI-MCAL-600x600.png.webp',2,'Mouse&Keybord'),(22,'KEYBOARD T-DAGGER',85,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/tgk301-600x600.png.webp',2,'Mouse&Keybord'),(23,'KB GLORIOUS GMMK',150,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2021/01/Glorious-GMMK-Full-Size-Pre-Built-WHITE-2-600x600.png.webp',2,'Mouse&Keybord'),(25,'MOUSE LOGITECH G903',180,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/11/MS-G903-16K-600x600.png.webp',2,'Mouse&Keybord'),(34,'LAPTOP ACER SPIN',4200,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2021/01/Untitled-design-1-1-600x600.png.webp',1,'Laptops'),(35,'CHAIR COUGAR',280,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2020/12/armor-one-black-600x600.png.webp',4,'CHAIR'),(37,'CHAIR GAMING',350,'https://watanimall.com/wp-content/webp-express/webp-images/uploads/2021/01/Omen-chair-600x600.jpg.webp',4,'CHAIR');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-28 22:04:44
