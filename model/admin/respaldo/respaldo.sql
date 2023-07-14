-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: siferapp
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carroceria`
--

DROP TABLE IF EXISTS `carroceria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carroceria` (
  `id_carroceria` int(3) NOT NULL AUTO_INCREMENT,
  `carroceria` varchar(20) NOT NULL,
  PRIMARY KEY (`id_carroceria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carroceria`
--

LOCK TABLES `carroceria` WRITE;
/*!40000 ALTER TABLE `carroceria` DISABLE KEYS */;
/*!40000 ALTER TABLE `carroceria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id_category` int(5) NOT NULL AUTO_INCREMENT,
  `category` text DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cilindraje`
--

DROP TABLE IF EXISTS `cilindraje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cilindraje` (
  `id_cilindraje` int(3) NOT NULL AUTO_INCREMENT,
  `cilindraje` int(4) NOT NULL,
  PRIMARY KEY (`id_cilindraje`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cilindraje`
--

LOCK TABLES `cilindraje` WRITE;
/*!40000 ALTER TABLE `cilindraje` DISABLE KEYS */;
/*!40000 ALTER TABLE `cilindraje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colores_moto`
--

DROP TABLE IF EXISTS `colores_moto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colores_moto` (
  `id_color` int(3) NOT NULL,
  `nombre_color` varchar(50) NOT NULL,
  PRIMARY KEY (`id_color`),
  UNIQUE KEY `id_color` (`id_color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colores_moto`
--

LOCK TABLES `colores_moto` WRITE;
/*!40000 ALTER TABLE `colores_moto` DISABLE KEYS */;
/*!40000 ALTER TABLE `colores_moto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `combustible`
--

DROP TABLE IF EXISTS `combustible`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `combustible` (
  `id_combustible` int(3) NOT NULL AUTO_INCREMENT,
  `combustible` varchar(20) NOT NULL,
  PRIMARY KEY (`id_combustible`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combustible`
--

LOCK TABLES `combustible` WRITE;
/*!40000 ALTER TABLE `combustible` DISABLE KEYS */;
/*!40000 ALTER TABLE `combustible` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datetime_entry`
--

DROP TABLE IF EXISTS `datetime_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datetime_entry` (
  `id_entry` int(10) NOT NULL AUTO_INCREMENT,
  `date_entry` datetime NOT NULL,
  `document` int(10) NOT NULL,
  PRIMARY KEY (`id_entry`),
  KEY `datetime_entry_ibfk_1` (`document`),
  CONSTRAINT `datetime_entry_ibfk_1` FOREIGN KEY (`document`) REFERENCES `user` (`document`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datetime_entry`
--

LOCK TABLES `datetime_entry` WRITE;
/*!40000 ALTER TABLE `datetime_entry` DISABLE KEYS */;
INSERT INTO `datetime_entry` VALUES (145,'2023-05-05 08:04:03',1110460410);
/*!40000 ALTER TABLE `datetime_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datetime_out`
--

DROP TABLE IF EXISTS `datetime_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datetime_out` (
  `id_out` int(10) NOT NULL AUTO_INCREMENT,
  `date_out` datetime NOT NULL,
  `document_user` int(10) NOT NULL,
  PRIMARY KEY (`id_out`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datetime_out`
--

LOCK TABLES `datetime_out` WRITE;
/*!40000 ALTER TABLE `datetime_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `datetime_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `id_documento` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gender` (
  `id_gender` int(2) NOT NULL AUTO_INCREMENT,
  `gender` text NOT NULL,
  PRIMARY KEY (`id_gender`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'masculino'),(2,'femenino'),(3,'otro');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `id_marca` int(5) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas_motos`
--

DROP TABLE IF EXISTS `marcas_motos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas_motos` (
  `id` int(5) unsigned NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas_motos`
--

LOCK TABLES `marcas_motos` WRITE;
/*!40000 ALTER TABLE `marcas_motos` DISABLE KEYS */;
/*!40000 ALTER TABLE `marcas_motos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelos`
--

DROP TABLE IF EXISTS `modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelos` (
  `id_modelo` int(3) NOT NULL,
  `modelo_año` int(4) NOT NULL,
  PRIMARY KEY (`id_modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelos`
--

LOCK TABLES `modelos` WRITE;
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorcycles`
--

DROP TABLE IF EXISTS `motorcycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motorcycles` (
  `placa` varchar(6) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `km` int(10) NOT NULL,
  `id_modelo` int(3) NOT NULL,
  `id_marca` int(5) unsigned NOT NULL,
  `id_color` int(3) NOT NULL,
  `id_carroceria` int(3) NOT NULL,
  `document` int(11) NOT NULL,
  `id_cilindraje` int(3) NOT NULL,
  `id_combustible` int(3) NOT NULL,
  `id_servicio_moto` int(3) NOT NULL,
  PRIMARY KEY (`placa`),
  KEY `motorcycles_ibfk_1` (`document`),
  KEY `motorcycles_ibfk_2` (`id_carroceria`),
  KEY `id_color` (`id_color`),
  KEY `id_combustible` (`id_combustible`),
  KEY `motorcycles_ibfk_6` (`id_marca`),
  KEY `motorcycles_ibfk_7` (`id_modelo`),
  KEY `id_servicio_moto` (`id_servicio_moto`),
  KEY `id_cilindraje` (`id_cilindraje`),
  CONSTRAINT `motorcycles_ibfk_1` FOREIGN KEY (`document`) REFERENCES `user` (`document`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_2` FOREIGN KEY (`id_carroceria`) REFERENCES `carroceria` (`id_carroceria`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_4` FOREIGN KEY (`id_color`) REFERENCES `colores_moto` (`id_color`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_5` FOREIGN KEY (`id_combustible`) REFERENCES `combustible` (`id_combustible`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_6` FOREIGN KEY (`id_marca`) REFERENCES `marcas_motos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_7` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id_modelo`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_8` FOREIGN KEY (`id_servicio_moto`) REFERENCES `servicio_moto` (`id_servicio_moto`) ON UPDATE CASCADE,
  CONSTRAINT `motorcycles_ibfk_9` FOREIGN KEY (`id_cilindraje`) REFERENCES `cilindraje` (`id_cilindraje`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorcycles`
--

LOCK TABLES `motorcycles` WRITE;
/*!40000 ALTER TABLE `motorcycles` DISABLE KEYS */;
/*!40000 ALTER TABLE `motorcycles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `name_pro` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_estado` int(2) NOT NULL,
  `id_marca` int(2) NOT NULL,
  `cantidad` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_vendidos`
--

DROP TABLE IF EXISTS `productos_vendidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos_vendidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `id_producto` bigint(20) unsigned NOT NULL,
  `existencia` bigint(20) unsigned NOT NULL,
  `id_venta` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_venta` (`id_venta`),
  CONSTRAINT `productos_vendidos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `productos_vendidos_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_vendidos`
--

LOCK TABLES `productos_vendidos` WRITE;
/*!40000 ALTER TABLE `productos_vendidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos_vendidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id_services` int(5) NOT NULL AUTO_INCREMENT,
  `code_service` varchar(20) NOT NULL,
  `service` text NOT NULL,
  `costo_service` decimal(10,2) NOT NULL,
  `cantidad_ser` int(1) NOT NULL,
  PRIMARY KEY (`id_services`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio_moto`
--

DROP TABLE IF EXISTS `servicio_moto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio_moto` (
  `id_servicio_moto` int(3) NOT NULL AUTO_INCREMENT,
  `servicio_moto` varchar(20) NOT NULL,
  PRIMARY KEY (`id_servicio_moto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio_moto`
--

LOCK TABLES `servicio_moto` WRITE;
/*!40000 ALTER TABLE `servicio_moto` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicio_moto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_detail`
--

DROP TABLE IF EXISTS `shop_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_detail` (
  `id_shop_detail` int(6) NOT NULL,
  `cant_product` int(5) NOT NULL,
  `id_shopping` int(8) NOT NULL,
  `id_product` int(10) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id_shop_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_detail`
--

LOCK TABLES `shop_detail` WRITE;
/*!40000 ALTER TABLE `shop_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping`
--

DROP TABLE IF EXISTS `shopping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping` (
  `id_shopping` int(8) NOT NULL,
  `document` int(10) NOT NULL,
  `document_trabajador` int(11) NOT NULL,
  `shop_datetime` datetime NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_shopping`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping`
--

LOCK TABLES `shopping` WRITE;
/*!40000 ALTER TABLE `shopping` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id_state` int(2) NOT NULL AUTO_INCREMENT,
  `state` text NOT NULL,
  PRIMARY KEY (`id_state`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'activo'),(2,'inactivo');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_user`
--

DROP TABLE IF EXISTS `type_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_user` (
  `id_type_user` int(2) NOT NULL AUTO_INCREMENT,
  `type_user` text NOT NULL,
  PRIMARY KEY (`id_type_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_user`
--

LOCK TABLES `type_user` WRITE;
/*!40000 ALTER TABLE `type_user` DISABLE KEYS */;
INSERT INTO `type_user` VALUES (1,'admin'),(2,'trabajador'),(3,'cliente');
/*!40000 ALTER TABLE `type_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `document` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_user` date NOT NULL,
  `id_type_user` int(2) NOT NULL,
  `id_gender` int(2) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `id_state` int(2) NOT NULL,
  PRIMARY KEY (`document`),
  KEY `id_gender` (`id_gender`),
  KEY `user_ibfk_3` (`id_state`),
  KEY `user_ibfk_4` (`id_type_user`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id_gender`) ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`id_type_user`) REFERENCES `type_user` (`id_type_user`) ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_5` FOREIGN KEY (`id_state`) REFERENCES `state` (`id_state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1110460410,'Luis','Munoz','3213301955','luisalejandrm533@gmail.com','2021-04-14',1,1,'$2y$15$aqvxGtEbvQ2yZBGTy/41TOACpUzwULx/cg.64GFIsvJH4AdkhLbXy','siferapp20',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL,
  `placa` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(7,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_ibfk_1` (`document`),
  KEY `ventas_ibfk_2` (`placa`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`document`) REFERENCES `user` (`document`) ON UPDATE CASCADE,
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`placa`) REFERENCES `motorcycles` (`placa`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-05  8:04:13
