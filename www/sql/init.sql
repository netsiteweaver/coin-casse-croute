-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: cassecroute
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `commits`
--

DROP TABLE IF EXISTS `commits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commits` (
  `commit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`commit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commits`
--

LOCK TABLES `commits` WRITE;
/*!40000 ALTER TABLE `commits` DISABLE KEYS */;
/*!40000 ALTER TABLE `commits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `legal_name` varchar(50) NOT NULL,
  `brn` varchar(30) DEFAULT NULL,
  `vat` varchar(30) DEFAULT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `skype` varchar(30) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `working_hours` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Coin Casse Croute','cassecroute',NULL,'','','','Quatre Bornes','Rep. of Mauritius','12345678','','','info@nowhere.com','','','','','','','','');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `customer_code` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `title` enum('Mr','Mrs','Miss','Dr') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Mr',
  `first_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone_number1` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `phone_number2` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nic` varchar(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dob` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `remarks` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `discount` float NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `nic` (`nic`),
  KEY `fk_customers_users1_idx` (`created_by`),
  CONSTRAINT `fk_customers_users1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'74ADEBAA-F48F-9D43-CB28-39E2417E7461','ullamcorper,','Mrs','Thane','Garrett','130-1373 Nulla. Avenue','Aurillac','83127768','03359484','fusce.mollis.duis@hotmail.ca','C606892010727K','2024-12-12',NULL,9,1,1,'2023-05-18 21:04:28'),(2,'E3EB646B-DE69-171A-2692-782C754293BE','molestie','Mrs','Bruce','Carson','7154 Nunc Av.','Wattrelos','29212112','94488148','lectus.rutrum@aol.org','F080717320966I','2024-06-05',NULL,8,1,1,'2024-04-05 15:05:26'),(3,'C53CBC23-A344-2402-D2B1-567ACE8756E7','dignissim','Mr','Alice','Bryant','P.O. Box 702, 7034 Ultrices St.','Biarritz','41877716','95084336','id@outlook.couk','Y573437164547D','2024-01-02',NULL,8,1,1,'2024-09-18 23:03:34'),(4,'8A2DF610-673A-3E55-4CF2-4EE14B93A954','ac','Miss','Alice','England','9006 Nec Ave','Lisieux','61055625','18256381','molestie.in.tempus@protonmail.com','T937314785818Z','2023-06-23',NULL,3,1,1,'2024-11-14 02:04:35'),(5,'77AC3726-776B-520A-F108-D7CE036EE4A1','ac','Mr','Thaddeus','Watson','Ap #279-2381 A Road','Tourcoing','75066453','55352515','orci@outlook.net','K657642176182W','2024-04-06',NULL,5,1,1,'2023-07-14 18:05:39'),(6,'C9AFDCCD-7EC1-B034-0E8A-0AA0552A19CF','Fusce','Mrs','Sybill','Buckner','382-8835 Elit Av.','Vannes','33464587','57881821','velit@outlook.org','K418634293365I','2024-05-30',NULL,7,1,1,'2023-07-02 22:07:56'),(7,'97043DD8-EC68-0958-7EDE-F46CC1F1E7B2','cursus,','Miss','Alana','Powell','Ap #471-3109 Pede, Rd.','Talence','16858369','61186864','blandit.at.nisi@outlook.org','O223593255324W','2025-01-24',NULL,7,1,1,'2024-07-18 06:04:44'),(8,'E1E1565D-51DA-1B08-5186-F662ADE3C644','eu,','Miss','Fallon','Powell','717-3953 Nulla Avenue','Issy-les-Moulineaux','97512233','31412636','duis.sit.amet@google.couk','Y256748253986G','2024-09-08',NULL,1,1,1,'2024-05-08 00:03:20'),(9,'AB42BB90-4D5B-A168-4579-4C765391BCDD','lobortis,','Miss','Emerson','Le','662-780 Elit St.','Vertou','94035759','97789722','consectetuer.rhoncus.nullam@protonmail.com','U434335814516D','2024-07-24',NULL,9,1,1,'2024-02-24 03:06:36'),(10,'D1B9135C-1D99-D9BE-8755-D8774539BB2B','natoque','Miss','Camden','Frazier','Ap #921-5823 Quam. Rd.','Saint-Nazaire','62017117','66870878','vel.venenatis@outlook.edu','S977405327433Y','2023-06-10',NULL,2,1,1,'2024-01-22 06:01:20'),(11,'FD64688C-B998-B291-3D85-C6DD6D5AA3DD','laoreet,','Mr','TaShya','Roman','229-7277 Orci. Ave','Anglet','12904522','41225600','cras@outlook.ca','Z671991824985N','2024-10-25',NULL,4,1,1,'2024-06-02 21:07:58'),(12,'6F9B1A4C-A262-0ED0-955D-48E86C9D5EBB','dui.','Mrs','Lacota','Wilder','P.O. Box 739, 1374 Tempus Street','Évreux','42491256','27738356','amet.risus@protonmail.couk','K862533954873Q','2023-05-25',NULL,5,1,1,'2023-03-22 07:03:54'),(13,'44DC5DF1-9C84-DAD9-CBF9-E3BB8B979A1A','ut','Dr','Amery','Beasley','P.O. Box 180, 6786 Interdum St.','Nantes','81357169','51978328','purus.nullam@icloud.net','Q590756457642Z','2024-11-17',NULL,5,1,1,'2024-02-18 11:07:11'),(14,'2C7A22C9-5180-5075-5BE1-EB8F682E860C','parturient','Miss','Emmanuel','Booth','709-1124 Ipsum. Rd.','Reims','57346325','96468317','vitae@outlook.net','Q830502577883K','2023-08-15',NULL,10,1,1,'2023-12-25 23:01:39'),(15,'EB682186-9F98-5C3B-7046-1D80DDA229A1','ligula.','Miss','Jasmine','Delacruz','253-3120 Erat. Rd.','Bègles','16196367','62768662','nullam.vitae@hotmail.ca','D346337414825W','2023-07-31',NULL,8,1,1,'2023-02-23 19:04:18'),(16,'41B3781B-A2E6-D784-CB48-AD5BFFBED8E2','luctus','Mrs','Tara','Dillard','Ap #577-9419 Porttitor Av.','Saint-Étienne-du-Rouvray','65263058','15684914','pede.blandit@icloud.org','D835645686465C','2024-06-24',NULL,5,1,1,'2023-05-12 01:05:26'),(17,'08E9A4E8-1D5B-4CDF-C67D-99026D0BE485','vel','Miss','Wayne','Wright','Ap #156-9635 In Street','Abbeville','12738978','66215775','lobortis.quam@aol.edu','C841808842134T','2023-12-06',NULL,9,1,1,'2024-09-23 07:01:53'),(18,'3C3A3DA4-504B-8C36-5839-E9367D1C7DBE','nec,','Mr','Quon','Harrell','3706 Ornare. Av.','Épernay','75243817','55582870','metus.aenean@outlook.couk','E044723618277B','2025-01-17',NULL,9,1,1,'2023-09-03 14:07:10'),(19,'594E4157-2670-39CC-37B2-D30521DBEC43','eu,','Dr','Brynn','Rasmussen','372-3425 Dolor. Avenue','Dunkerque','43456242','26776446','fringilla.cursus@hotmail.org','E801577186389Q','2023-02-25',NULL,5,1,1,'2025-01-24 17:05:42'),(20,'F912DA72-EC4B-C8DC-1CD5-E193E3FE3DB7','erat','Mrs','Keane','Castro','Ap #795-3470 Vel Street','Lisieux','34387818','81919285','vestibulum@outlook.couk','S447439214748C','2023-08-18',NULL,9,1,1,'2023-06-16 18:05:27'),(21,'6610E08B-3902-6898-20A3-60727C8FB57D','non,','Mrs','Kirestin','Lambert','814-3549 Quis Street','Antibes','51725286','43238467','aliquam.nisl@aol.com','T972247555713Y','2023-02-23',NULL,1,1,1,'2023-08-29 11:02:17'),(22,'7B02759C-1FAB-281E-2626-E02D546C897A','eu','Miss','Basil','Armstrong','P.O. Box 269, 2371 Penatibus Road','Toulouse','88888888','99999999','sed.facilisis.vitae@google.couk','N328883939542L','2023-07-01','xx',2,1,1,'2023-10-05 20:04:56'),(23,'C1435597-3CC1-1206-7522-228819C70734','nascetur','Mrs','Elton','Henry','Ap #409-3985 Dapibus Street','Laon','52206362','02552825','justo.praesent.luctus@protonmail.couk','V801844648640V','2023-05-08',NULL,2,1,1,'2024-05-03 16:05:15'),(24,'CC002AE7-4189-B8A8-8406-B5DA0B16F4BB','at,','Mr','Charissa','Davenport','516-8186 Nec Ave','Aurillac','35227271','86183719','tellus.eu.augue@hotmail.org','Z741292498238V','2023-04-08',NULL,1,1,1,'2023-04-07 02:05:56'),(25,'556E8FD1-52B7-E57A-84E7-3538C87060BA','nec,','Mr','Bryar','Cooke','551-8854 Aliquam Rd.','Boulogne-Billancourt','18365395','25582714','aliquam.iaculis.lacus@protonmail.couk','O316956878736V','2023-11-27',NULL,2,1,1,'2024-10-06 15:07:58'),(26,'36FDC754-B1C6-1DBD-1404-826EE41EA2B5','dolor','Miss','Anastasia','Mccullough','Ap #263-5698 Orci. Av.','Brive-la-Gaillarde','02493610','44503354','in@protonmail.couk','O343485683859H','2023-09-18',NULL,4,1,1,'2023-08-25 07:05:10'),(27,'CC9031E2-8B20-BDB8-9C98-40659302EAEB','lorem','Mrs','Clinton','Riggs','512-1049 Tristique Avenue','Le Havre','98537576','45880289','egestas@yahoo.couk','R824754892516X','2023-06-27',NULL,1,1,1,'2023-03-06 13:01:31'),(28,'B393116A-406D-1474-64D0-3DD1278563E5','vitae','Miss','Rashad','Hobbs','P.O. Box 587, 3554 Sit Street','Reims','89286712','48272586','phasellus.dolor@aol.org','O327484514483X','2023-11-09',NULL,9,1,1,'2024-11-20 18:03:08'),(29,'BFCEC889-4365-DC54-114E-6AD3A62ABA0A','mattis.','Miss','Martina','Cole','445-5003 Feugiat Street','Saint-Étienne-du-Rouvray','11496441','85114422','sapien@icloud.edu','Q110307547759J','2024-03-17',NULL,3,1,1,'2023-07-19 05:03:41'),(30,'4DA34352-25D1-1CF6-CBB6-A54C1C44E624','Phasellus','Miss','Rebecca','Manning','130-7736 Quis, Rd.','Pontarlier','84353581','58866747','cursus.purus@protonmail.net','N087227585189N','2023-10-30',NULL,3,1,1,'2024-07-12 03:05:02'),(31,'0C6DEDB8-82E3-3935-D436-9F36D9CD247B','urna.','Mrs','Steven','Peters','Ap #512-4723 Nascetur Av.','Saintes','93329763','34297871','dictum.eu@protonmail.com','B956128595549J','2023-08-22',NULL,4,1,1,'2024-06-24 13:01:48'),(32,'CF72A402-D8EA-BF0A-683E-C74252ED15CD','nibh','Dr','Tallulah','English','6705 Quis Road','Nantes','95582954','25066147','sed.eu@protonmail.net','M488823566122P','2023-10-15',NULL,9,1,1,'2024-02-11 14:07:29'),(33,'4592CA47-7BE6-D3CE-41C6-73CB6671CAC1','Integer','Mrs','Jonas','Holt','Ap #290-7139 Dignissim Rd.','Thionville','06146192','77217148','nec.urna.et@icloud.ca','S678133159795W','2024-06-25',NULL,1,1,1,'2023-08-31 22:04:43'),(34,'34EE3DD7-3B19-2597-1BFB-111299C22E7C','Sed','Miss','Griffith','Roth','P.O. Box 547, 2484 Non, Rd.','Beauvais','84152339','62398676','fringilla.purus.mauris@outlook.com','L302557153852M','2024-01-15',NULL,1,1,1,'2024-08-07 11:03:50'),(35,'BEB75435-C22B-D4B9-39DF-7165212225C9','torquent','Miss','Nicholas','Chang','Ap #747-7219 Urna. St.','Charleville-Mézières','78647494','82518083','ut@google.edu','H042174136446F','2023-09-08',NULL,1,1,1,'2024-06-17 09:01:58'),(36,'E87BE82E-5182-8578-9289-2F2D75F4B73C','pellentesque','Mrs','Isaiah','Hopper','P.O. Box 450, 7054 Sed Rd.','Saint-Nazaire','38187375','68474461','at.velit.pellentesque@google.org','R104627325714U','2024-04-25',NULL,9,1,1,'2024-08-23 14:05:18'),(37,'72B97C13-4721-4E85-B233-0C13ECF4F737','mollis','Miss','Unity','Lynch','423-6747 Vestibulum St.','Le Mans','55623319','77423484','phasellus.in@yahoo.couk','S554417857630P','2024-01-11',NULL,7,1,1,'2023-03-05 21:07:42'),(38,'96596C08-8ED3-3364-35A0-9AB282C85717','in','Mrs','Aspen','Patel','896-6197 Facilisis St.','Compiègne','16412475','37456223','nam.consequat@icloud.net','E423022191040N','2023-06-28',NULL,4,1,1,'2024-04-26 02:05:57'),(39,'AB7D89F1-8222-8062-81E2-3425C6BEBBF3','ac','Mr','Genevieve','Potter','P.O. Box 506, 9639 Scelerisque Rd.','Dole','83752920','34339482','nam.ac.nulla@aol.org','G319771541133V','2023-10-09',NULL,5,1,1,'2024-06-18 13:02:08'),(40,'1B5D695C-38A0-4683-93D6-334A7AAAE5EA','consectetuer','Mr','Brooke','Winters','3927 Lorem Rd.','Le Puy-en-Velay','81794582','14684835','eu@google.org','N510125916524D','2024-08-04',NULL,1,1,1,'2023-06-27 20:02:21'),(41,'6A882B19-22E8-7ABD-B09B-64326B657A7D','purus.','Mrs','Alika','Best','962-1630 At, St.','Tarbes','62124768','74784917','ut.molestie@google.edu','W215433344548E','2024-02-02',NULL,4,1,1,'2024-08-15 17:04:34'),(42,'089DA52A-8416-EFB7-697E-417C7E13FD94','diam','Mr','Chadwick','Carpenter','Ap #186-1080 Netus St.','Nevers','11915626','53587006','in@outlook.org','R616714273545X','2024-02-28',NULL,8,1,1,'2024-01-15 11:01:47'),(43,'4EDBDF11-CD6C-876A-E7D3-42BF79E0E335','amet','Miss','Xenos','Bishop','117-8088 Aliquam Rd.','Montigny-lès-Metz','62960252','20292866','cursus@hotmail.couk','I515716878212S','2023-05-28',NULL,2,1,1,'2023-07-12 12:03:44'),(44,'1C2BB4CA-CA76-CBD1-1BDB-9237C64663F9','Phasellus','Dr','Fulton','Fisher','641-8620 Bibendum St.','Tarbes','03728636','85752220','ut@icloud.net','T700602440074F','2023-04-25',NULL,8,1,1,'2023-08-21 06:01:43'),(45,'FE7C7CC2-D0C0-1452-E9C5-D628159F3F54','amet','Miss','Hu','Kramer','Ap #941-8902 Auctor, Road','Talence','28605618','00688620','a@google.org','B531549637343Z','2024-01-03',NULL,0,1,1,'2023-06-23 21:05:40'),(46,'B4DA891A-A3C6-2DD0-61B8-54018D547218','convallis','Mrs','Hedwig','Travis','421-8049 Vitae Road','Montigny-lès-Metz','57573823','10415231','erat.etiam@google.edu','N380588358244S','2025-01-29',NULL,6,1,1,'2023-05-11 08:04:20'),(47,'8EFBBBC1-9AA6-6302-8D1B-1DF7B88F3A19','ac','Mr','Hilary','Roth','P.O. Box 516, 6057 Arcu. Road','Lunel','74170535','14225837','nonummy.ac@outlook.com','W107325754395L','2023-11-26',NULL,0,1,1,'2024-03-24 09:07:03'),(48,'0546BB1D-B844-D20A-1DF1-8E4EE61F9923','ipsum.','Mrs','Lani','Greene','6887 Integer Rd.','Béziers','65486164','09578932','enim.condimentum.eget@outlook.com','G355194541191J','2024-04-09',NULL,9,1,1,'2023-08-23 16:03:43'),(49,'33B53F55-4606-7087-1B14-5141B89C9CAB','Curabitur','Mrs','Kyra','Bradford','4098 Nunc Road','Laon','23436729','16336522','sed@aol.com','T051458404715L','2024-01-03',NULL,3,1,1,'2023-05-09 02:02:40'),(50,'9F239634-CAB9-6B71-3B62-EA98809871AF','pellentesque','Mrs','Mallory','Diaz','P.O. Box 991, 9404 Mauris Rd.','Pontarlier','40587042','10172545','vel@aol.com','N464404779683Q','2023-05-28',NULL,3,1,1,'2023-03-21 04:02:59'),(51,'c5109103-9d75-4684-a5d4-720ef231e378','','Mr','John','Doe','askahs','Curepip','12345678','1234567',NULL,'D111122223345R','2000-01-01','haha',0,1,2,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departments_users_idx` (`created_by`),
  CONSTRAINT `fk_departments_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'b1df526c-e91e-4d48-8ae6-cfb09841a51c','Store',NULL,'','',1,1,'2022-11-15 22:02:51');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_queue`
--

DROP TABLE IF EXISTS `email_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_queue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `recipients` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `stage` varchar(10) NOT NULL DEFAULT 'new',
  `tracking_code` text,
  `opened` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_queue`
--

LOCK TABLES `email_queue` WRITE;
/*!40000 ALTER TABLE `email_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `glyphicons`
--

DROP TABLE IF EXISTS `glyphicons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `glyphicons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classname` varchar(30) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=594 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `glyphicons`
--

LOCK TABLES `glyphicons` WRITE;
/*!40000 ALTER TABLE `glyphicons` DISABLE KEYS */;
INSERT INTO `glyphicons` VALUES (1,'fa-align-center','formatting'),(2,'fa-adjust',''),(3,'fa-adn',''),(4,'fa-align-left','formatting'),(5,'fa-align-justify','formatting'),(6,'fa-align-right','formatting'),(7,'fa-angellist',''),(8,'fa-ambulance','transport'),(9,'fa-anchor',''),(10,'fa-angle-double-down','arrows'),(11,'fa-angle-double-left','arrows'),(12,'fa-android',''),(13,'fa-angle-double-up','arrows'),(14,'fa-angle-left','arrows'),(15,'fa-angle-double-right','arrows'),(16,'fa-angle-down','arrows'),(17,'fa-angle-up','arrows'),(18,'fa-angle-right','arrows'),(19,'fa-apple',''),(20,'fa-area-chart',''),(21,'fa-arrow-circle-down','arrows'),(22,'fa-arrow-circle-o-down','arrows'),(23,'fa-archive',''),(24,'fa-arrow-circle-left','arrows'),(25,'fa-arrow-circle-o-left','arrows'),(26,'fa-arrow-down','arrows'),(27,'fa-arrow-circle-right','arrows'),(28,'fa-arrow-circle-o-up','arrows'),(29,'fa-arrow-circle-o-right','arrows'),(30,'fa-arrow-circle-up','arrows'),(31,'fa-arrow-left','arrows'),(32,'fa-arrows-h',''),(33,'fa-arrow-right','arrows'),(34,'fa-arrows-alt','arrows'),(35,'fa-arrow-up','arrows'),(36,'fa-arrows','arrows'),(37,'fa-arrows-v','arrows'),(38,'fa-asterisk',''),(39,'fa-at',''),(40,'fa-backward',''),(41,'fa-ban',''),(42,'fa-automobile',''),(43,'fa-bank',''),(44,'fa-bar-chart','graphs'),(45,'fa-bars','graphs'),(46,'fa-bar-chart-o','graphs'),(47,'fa-bed',''),(48,'fa-barcode',''),(49,'fa-beer',''),(50,'fa-behance-square',''),(51,'fa-bell-slash',''),(52,'fa-bell-o',''),(53,'fa-behance',''),(54,'fa-bell',''),(55,'fa-bell-slash-o',''),(56,'fa-birthday-cake',''),(57,'fa-bitbucket',''),(58,'fa-bitbucket-square',''),(59,'fa-bicycle','transport'),(60,'fa-binoculars',''),(61,'fa-bitcoin',''),(62,'fa-bookmark',''),(63,'fa-book',''),(64,'fa-bomb',''),(65,'fa-bolt',''),(66,'fa-bold',''),(67,'fa-bookmark-o',''),(68,'fa-bug',''),(69,'fa-building',''),(70,'fa-building-o',''),(71,'fa-btc',''),(72,'fa-briefcase',''),(73,'fa-bullhorn',''),(74,'fa-bullseye',''),(75,'fa-buysellads',''),(76,'fa-calculator',''),(77,'fa-bus',''),(78,'fa-cab',''),(79,'fa-calendar',''),(80,'fa-camera-retro',''),(81,'fa-car','transport'),(82,'fa-caret-down',''),(83,'fa-calendar-o',''),(84,'fa-camera',''),(85,'fa-caret-left',''),(86,'fa-caret-square-o-up',''),(87,'fa-caret-square-o-right',''),(88,'fa-caret-right',''),(89,'fa-caret-square-o-left',''),(90,'fa-caret-square-o-down',''),(91,'fa-caret-up',''),(92,'fa-cc','e-commerce'),(93,'fa-cart-plus','e-commerce'),(94,'fa-cart-arrow-down','e-commerce'),(95,'fa-cc-discover','e-commerce'),(96,'fa-cc-amex','e-commerce'),(97,'fa-cc-mastercard','e-commerce'),(98,'fa-cc-visa','e-commerce'),(99,'fa-cc-stripe',''),(100,'fa-certificate',''),(101,'fa-chain-broken',''),(102,'fa-chain',''),(103,'fa-cc-paypal','e-commerce'),(104,'fa-check',''),(105,'fa-check-square',''),(106,'fa-check-circle',''),(107,'fa-chevron-circle-down',''),(108,'fa-check-square-o',''),(109,'fa-check-circle-o',''),(110,'fa-chevron-circle-left',''),(111,'fa-chevron-circle-right',''),(112,'fa-chevron-right',''),(113,'fa-chevron-down',''),(114,'fa-chevron-left',''),(115,'fa-chevron-circle-up',''),(116,'fa-chevron-up',''),(117,'fa-circle-o',''),(118,'fa-clipboard',''),(119,'fa-circle-o-notch',''),(120,'fa-circle-thin',''),(121,'fa-child',''),(122,'fa-circle',''),(123,'fa-cloud',''),(124,'fa-clock-o',''),(125,'fa-cny',''),(126,'fa-cloud-upload',''),(127,'fa-cloud-download',''),(128,'fa-close',''),(129,'fa-code',''),(130,'fa-cog',''),(131,'fa-code-fork',''),(132,'fa-cogs',''),(133,'fa-coffee',''),(134,'fa-codepen',''),(135,'fa-columns',''),(136,'fa-comment',''),(137,'fa-comments-o',''),(138,'fa-compass',''),(139,'fa-comments',''),(140,'fa-comment-o',''),(141,'fa-compress',''),(142,'fa-connectdevelop',''),(143,'fa-copyright',''),(144,'fa-copy',''),(145,'fa-credit-card',''),(146,'fa-crop',''),(147,'fa-crosshairs',''),(148,'fa-css3',''),(149,'fa-cube',''),(150,'fa-cutlery',''),(151,'fa-cubes',''),(152,'fa-cut',''),(153,'fa-dashcube',''),(154,'fa-dashboard',''),(155,'fa-dedent',''),(156,'fa-database',''),(157,'fa-delicious',''),(158,'fa-desktop',''),(159,'fa-diamond',''),(160,'fa-deviantart',''),(161,'fa-digg',''),(162,'fa-dollar',''),(163,'fa-dot-circle-o',''),(164,'fa-download',''),(165,'fa-dribbble',''),(166,'fa-drupal',''),(167,'fa-dropbox',''),(168,'fa-eject',''),(169,'fa-edit',''),(170,'fa-ellipsis-h',''),(171,'fa-ellipsis-v',''),(172,'fa-empire',''),(173,'fa-eraser',''),(174,'fa-envelope-o',''),(175,'fa-envelope-square',''),(176,'fa-envelope',''),(177,'fa-eur',''),(178,'fa-exchange',''),(179,'fa-euro',''),(180,'fa-exclamation',''),(181,'fa-exclamation-triangle',''),(182,'fa-exclamation-circle',''),(183,'fa-expand',''),(184,'fa-eye-slash',''),(185,'fa-external-link',''),(186,'fa-eye',''),(187,'fa-eyedropper',''),(188,'fa-external-link-square',''),(189,'fa-facebook',''),(190,'fa-facebook-official',''),(191,'fa-facebook-square',''),(192,'fa-fast-forward',''),(193,'fa-fast-backward',''),(194,'fa-facebook-f',''),(195,'fa-fax',''),(196,'fa-file-audio-o',''),(197,'fa-file',''),(198,'fa-female','person'),(199,'fa-file-archive-o',''),(200,'fa-fighter-jet',''),(201,'fa-file-code-o',''),(202,'fa-file-excel-o',''),(203,'fa-file-movie-o',''),(204,'fa-file-image-o',''),(205,'fa-file-o',''),(206,'fa-file-photo-o',''),(207,'fa-file-pdf-o',''),(208,'fa-file-picture-o',''),(209,'fa-file-sound-o',''),(210,'fa-file-powerpoint-o',''),(211,'fa-file-text',''),(212,'fa-file-text-o',''),(213,'fa-file-word-o',''),(214,'fa-file-video-o',''),(215,'fa-file-zip-o',''),(216,'fa-fire',''),(217,'fa-files-o',''),(218,'fa-fire-extinguisher',''),(219,'fa-filter',''),(220,'fa-film',''),(221,'fa-flag',''),(222,'fa-flag-o',''),(223,'fa-flask',''),(224,'fa-flickr',''),(225,'fa-flash',''),(226,'fa-flag-checkered',''),(227,'fa-floppy-o',''),(228,'fa-folder-o',''),(229,'fa-folder',''),(230,'fa-forumbee',''),(231,'fa-font',''),(232,'fa-folder-open-o',''),(233,'fa-folder-open',''),(234,'fa-forward',''),(235,'fa-foursquare',''),(236,'fa-futbol-o',''),(237,'fa-gavel',''),(238,'fa-gamepad',''),(239,'fa-frown-o',''),(240,'fa-gbp',''),(241,'fa-ge',''),(242,'fa-gear',''),(243,'fa-gift',''),(244,'fa-gears',''),(245,'fa-genderless',''),(246,'fa-git',''),(247,'fa-github',''),(248,'fa-glass',''),(249,'fa-github-square',''),(250,'fa-gittip',''),(251,'fa-github-alt',''),(252,'fa-git-square',''),(253,'fa-google',''),(254,'fa-globe',''),(255,'fa-google-wallet',''),(256,'fa-google-plus-square',''),(257,'fa-graduation-cap',''),(258,'fa-google-plus',''),(259,'fa-gratipay',''),(260,'fa-group',''),(261,'fa-hacker-news',''),(262,'fa-hand-o-down',''),(263,'fa-h-square',''),(264,'fa-hand-o-left',''),(265,'fa-hand-o-right',''),(266,'fa-header',''),(267,'fa-hand-o-up',''),(268,'fa-headphones',''),(269,'fa-heart',''),(270,'fa-hdd-o',''),(271,'fa-heartbeat',''),(272,'fa-heart-o',''),(273,'fa-home',''),(274,'fa-history',''),(275,'fa-hospital-o',''),(276,'fa-hotel',''),(277,'fa-html5',''),(278,'fa-inbox',''),(279,'fa-ils',''),(280,'fa-image',''),(281,'fa-info',''),(282,'fa-indent',''),(283,'fa-info-circle',''),(284,'fa-inr',''),(285,'fa-italic',''),(286,'fa-ioxhost',''),(287,'fa-institution',''),(288,'fa-instagram',''),(289,'fa-joomla',''),(290,'fa-jpy',''),(291,'fa-jsfiddle',''),(292,'fa-krw',''),(293,'fa-key',''),(294,'fa-keyboard-o',''),(295,'fa-language',''),(296,'fa-laptop',''),(297,'fa-leaf',''),(298,'fa-legal',''),(299,'fa-leanpub',''),(300,'fa-lastfm-square',''),(301,'fa-lastfm',''),(302,'fa-lemon-o',''),(303,'fa-level-up',''),(304,'fa-level-down',''),(305,'fa-life-ring',''),(306,'fa-life-buoy',''),(307,'fa-life-bouy',''),(308,'fa-lightbulb-o',''),(309,'fa-link',''),(310,'fa-line-chart',''),(311,'fa-life-saver',''),(312,'fa-linkedin-square',''),(313,'fa-linkedin',''),(314,'fa-linux',''),(315,'fa-list-ol',''),(316,'fa-location-arrow',''),(317,'fa-list-ul',''),(318,'fa-list-alt',''),(319,'fa-list',''),(320,'fa-lock',''),(321,'fa-long-arrow-down',''),(322,'fa-long-arrow-up',''),(323,'fa-long-arrow-right',''),(324,'fa-magic',''),(325,'fa-long-arrow-left',''),(326,'fa-magnet',''),(327,'fa-mail-reply',''),(328,'fa-mail-forward',''),(329,'fa-male','person'),(330,'fa-mail-reply-all',''),(331,'fa-map-marker',''),(332,'fa-mars',''),(333,'fa-mars-double',''),(334,'fa-mars-stroke-h',''),(335,'fa-mars-stroke',''),(336,'fa-maxcdn',''),(337,'fa-meanpath',''),(338,'fa-mars-stroke-v',''),(339,'fa-medium',''),(340,'fa-medkit',''),(341,'fa-meh-o',''),(342,'fa-microphone',''),(343,'fa-microphone-slash',''),(344,'fa-mercury',''),(345,'fa-minus-circle',''),(346,'fa-minus',''),(347,'fa-minus-square',''),(348,'fa-mobile',''),(349,'fa-mobile-phone',''),(350,'fa-minus-square-o',''),(351,'fa-money',''),(352,'fa-moon-o',''),(353,'fa-mortar-board',''),(354,'fa-music',''),(355,'fa-navicon',''),(356,'fa-motorcycle',''),(357,'fa-newspaper-o',''),(358,'fa-neuter',''),(359,'fa-outdent',''),(360,'fa-paint-brush',''),(361,'fa-pagelines',''),(362,'fa-openid',''),(363,'fa-paper-plane',''),(364,'fa-paper-plane-o',''),(365,'fa-paperclip',''),(366,'fa-pause',''),(367,'fa-paste',''),(368,'fa-paragraph',''),(369,'fa-paw',''),(370,'fa-pencil',''),(371,'fa-paypal',''),(372,'fa-pencil-square-o',''),(373,'fa-pencil-square',''),(374,'fa-phone',''),(375,'fa-phone-square',''),(376,'fa-photo',''),(377,'fa-picture-o',''),(378,'fa-pied-piper-alt',''),(379,'fa-pie-chart',''),(380,'fa-pied-piper',''),(381,'fa-pinterest',''),(382,'fa-pinterest-p',''),(383,'fa-pinterest-square',''),(384,'fa-plane',''),(385,'fa-play',''),(386,'fa-plug',''),(387,'fa-plus-circle',''),(388,'fa-play-circle-o',''),(389,'fa-plus',''),(390,'fa-play-circle',''),(391,'fa-plus-square',''),(392,'fa-plus-square-o',''),(393,'fa-print',''),(394,'fa-puzzle-piece',''),(395,'fa-power-off',''),(396,'fa-qq',''),(397,'fa-qrcode',''),(398,'fa-question',''),(399,'fa-ra',''),(400,'fa-quote-left',''),(401,'fa-question-circle',''),(402,'fa-quote-right',''),(403,'fa-random',''),(404,'fa-recycle',''),(405,'fa-reddit',''),(406,'fa-rebel',''),(407,'fa-reddit-square',''),(408,'fa-refresh',''),(409,'fa-renren',''),(410,'fa-remove',''),(411,'fa-repeat',''),(412,'fa-reply',''),(413,'fa-reply-all',''),(414,'fa-reorder',''),(415,'fa-retweet',''),(416,'fa-rotate-right',''),(417,'fa-rocket',''),(418,'fa-road',''),(419,'fa-rmb',''),(420,'fa-rotate-left',''),(421,'fa-rouble',''),(422,'fa-rupee',''),(423,'fa-ruble',''),(424,'fa-rss-square',''),(425,'fa-rss',''),(426,'fa-rub',''),(427,'fa-save',''),(428,'fa-scissors',''),(429,'fa-search',''),(430,'fa-search-plus',''),(431,'fa-search-minus',''),(432,'fa-sellsy',''),(433,'fa-send',''),(434,'fa-share',''),(435,'fa-share-alt',''),(436,'fa-share-alt-square',''),(437,'fa-server',''),(438,'fa-send-o',''),(439,'fa-share-square',''),(440,'fa-sheqel',''),(441,'fa-shield',''),(442,'fa-shekel',''),(443,'fa-ship',''),(444,'fa-share-square-o',''),(445,'fa-shirtsinbulk',''),(446,'fa-shopping-cart',''),(447,'fa-sign-in',''),(448,'fa-sign-out',''),(449,'fa-simplybuilt',''),(450,'fa-signal',''),(451,'fa-sitemap',''),(452,'fa-slack',''),(453,'fa-skyatlas',''),(454,'fa-sliders',''),(455,'fa-slideshare',''),(456,'fa-skype',''),(457,'fa-smile-o',''),(458,'fa-soccer-ball-o',''),(459,'fa-sort-alpha-asc',''),(460,'fa-sort-amount-asc',''),(461,'fa-sort-alpha-desc',''),(462,'fa-sort',''),(463,'fa-sort-amount-desc',''),(464,'fa-sort-down',''),(465,'fa-sort-numeric-asc',''),(466,'fa-sort-asc',''),(467,'fa-sort-desc',''),(468,'fa-sort-numeric-desc',''),(469,'fa-space-shuttle',''),(470,'fa-soundcloud',''),(471,'fa-sort-up',''),(472,'fa-spinner',''),(473,'fa-spoon',''),(474,'fa-spotify',''),(475,'fa-square',''),(476,'fa-stack-overflow',''),(477,'fa-stack-exchange',''),(478,'fa-square-o',''),(479,'fa-star',''),(480,'fa-star-half',''),(481,'fa-star-half-o',''),(482,'fa-star-half-full',''),(483,'fa-steam',''),(484,'fa-star-o',''),(485,'fa-star-half-empty',''),(486,'fa-steam-square',''),(487,'fa-step-forward',''),(488,'fa-step-backward',''),(489,'fa-stop',''),(490,'fa-street-view',''),(491,'fa-stethoscope',''),(492,'fa-strikethrough',''),(493,'fa-stumbleupon',''),(494,'fa-stumbleupon-circle',''),(495,'fa-subscript',''),(496,'fa-subway',''),(497,'fa-suitcase',''),(498,'fa-sun-o',''),(499,'fa-superscript',''),(500,'fa-tablet',''),(501,'fa-tachometer',''),(502,'fa-table',''),(503,'fa-support',''),(504,'fa-tag',''),(505,'fa-tags',''),(506,'fa-taxi',''),(507,'fa-tasks',''),(508,'fa-terminal',''),(509,'fa-text-height',''),(510,'fa-tencent-weibo',''),(511,'fa-text-width',''),(512,'fa-thumb-tack',''),(513,'fa-th-large',''),(514,'fa-th',''),(515,'fa-th-list',''),(516,'fa-thumbs-down',''),(517,'fa-thumbs-o-down',''),(518,'fa-thumbs-o-up',''),(519,'fa-ticket',''),(520,'fa-thumbs-up',''),(521,'fa-times',''),(522,'fa-times-circle-o',''),(523,'fa-times-circle',''),(524,'fa-tint',''),(525,'fa-toggle-left',''),(526,'fa-toggle-down',''),(527,'fa-toggle-on',''),(528,'fa-toggle-right',''),(529,'fa-toggle-off',''),(530,'fa-toggle-up',''),(531,'fa-train',''),(532,'fa-trash-o',''),(533,'fa-transgender-alt',''),(534,'fa-trash',''),(535,'fa-transgender',''),(536,'fa-tree',''),(537,'fa-trello',''),(538,'fa-truck',''),(539,'fa-trophy',''),(540,'fa-tty',''),(541,'fa-try',''),(542,'fa-tumblr',''),(543,'fa-tumblr-square',''),(544,'fa-twitch',''),(545,'fa-turkish-lira',''),(546,'fa-twitter',''),(547,'fa-twitter-square',''),(548,'fa-umbrella',''),(549,'fa-underline',''),(550,'fa-unlink',''),(551,'fa-university',''),(552,'fa-undo',''),(553,'fa-unlock',''),(554,'fa-unlock-alt',''),(555,'fa-unsorted',''),(556,'fa-upload',''),(557,'fa-user',''),(558,'fa-usd',''),(559,'fa-user-md',''),(560,'fa-user-plus',''),(561,'fa-user-times',''),(562,'fa-user-secret',''),(563,'fa-users',''),(564,'fa-venus',''),(565,'fa-venus-double',''),(566,'fa-venus-mars',''),(567,'fa-viacoin',''),(568,'fa-video-camera',''),(569,'fa-vimeo-square',''),(570,'fa-vine',''),(571,'fa-vk',''),(572,'fa-volume-down',''),(573,'fa-volume-up',''),(574,'fa-volume-off',''),(575,'fa-warning',''),(576,'fa-wechat',''),(577,'fa-weixin',''),(578,'fa-weibo',''),(579,'fa-wheelchair',''),(580,'fa-whatsapp',''),(581,'fa-windows',''),(582,'fa-wifi',''),(583,'fa-wordpress',''),(584,'fa-won',''),(585,'fa-wrench',''),(586,'fa-yahoo',''),(587,'fa-xing-square',''),(588,'fa-xing',''),(589,'fa-yen',''),(590,'fa-yelp',''),(591,'fa-youtube-play',''),(592,'fa-youtube',''),(593,'fa-youtube-square','');
/*!40000 ALTER TABLE `glyphicons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `abbr` varchar(2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `flag` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en',1,'united-kingdom-flag-icon-32.png');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `user_id` int NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `uri` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_users1_idx` (`user_id`),
  CONSTRAINT `fk_log_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'c5276e04-1058-42d6-ad59-8bfac5a97628','2024-02-22 22:34:29',1,'127.0.0.1','backoffice','off','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'backoffice/off'),(2,'d40bc40e-e1a9-42aa-adf7-5a38d87ad5e4','2024-02-22 22:34:29',1,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,''),(3,'ea680213-1458-4948-8d0f-4014ddc781b1','2024-02-22 22:47:24',1,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(4,'7d6c5a2c-5620-4984-9330-a84f9881bfde','2024-02-22 22:47:46',1,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(5,'d2e1424f-448c-4bbb-a2ed-2861f07f7155','2024-02-22 22:47:58',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"Zhennan\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(6,'bcb25a52-3ee3-4146-8808-fe6ff7983371','2024-02-22 22:49:28',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"Zhennan\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(7,'4f6b8ed0-2513-448b-b63f-3d140c2c4abe','2024-02-22 22:49:48',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"Zhennan\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(8,'b2aa89be-136d-4ecb-8a76-1f0996bd2a76','2024-02-22 22:49:51',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(9,'da263247-3dd1-4a5e-aca9-f03f2464c2b7','2024-02-22 22:51:29',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(10,'79c42187-c53c-4cfd-9de3-e5dc3fa0de9b','2024-02-22 22:51:45',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(11,'b964d4e5-8215-43af-8364-35754ead30f9','2024-02-22 22:52:08',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(12,'61175044-1a20-4f18-938a-399598a3ec5f','2024-02-22 22:52:21',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(13,'c3ab2383-7e56-4e80-9f99-6b40ec3bb030','2024-02-22 22:53:31',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(14,'bb7c9a37-3644-4046-bd6d-da9e5a2fb70b','2024-02-22 22:53:39',1,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(15,'d6cd3ddb-7961-468e-b6e5-891c991c002f','2024-02-22 23:57:23',2,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'dashboard/index'),(16,'3acc7a39-bc77-4886-8f46-838a3eb7a5b4','2024-02-22 23:57:26',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(17,'33023770-c2f8-425a-bb25-a8ce92cdb1a6','2024-02-22 23:57:35',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(18,'c6fa26b8-4faf-4a1a-bf22-d517948fe75e','2024-02-22 23:58:02',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/AA51D1A3-AB6D-31F1-5C35-B28D0D94283B'),(19,'08b66784-f85e-49e2-8f3a-71d10905947b','2024-02-22 23:58:44',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/AA51D1A3-AB6D-31F1-5C35-B28D0D94283B'),(20,'ae3781df-4e03-476a-8236-39519e2d5a7e','2024-02-22 23:59:15',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/AA51D1A3-AB6D-31F1-5C35-B28D0D94283B'),(21,'8366cbe2-bdd3-4875-9387-c4e9040c3cfe','2024-02-22 23:59:31',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/AA51D1A3-AB6D-31F1-5C35-B28D0D94283B'),(22,'7a49283f-a475-42b3-aa6b-13e94b98d0d2','2024-02-23 00:00:10',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/AA51D1A3-AB6D-31F1-5C35-B28D0D94283B'),(23,'4ccfb29a-979e-440c-9fe1-a30917a34a75','2024-02-23 00:00:22',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(24,'8a4e8207-8c91-4e2f-b7ce-00acca3f2e82','2024-02-23 00:00:24',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/51D99B11-2267-32EB-E19A-C22D4A0612DD'),(25,'36b49ed5-cd7d-4a14-a290-3f70409d6d50','2024-02-23 00:00:27',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(26,'09e5e16a-a323-408f-a024-08b3a9a3859f','2024-02-23 00:00:28',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/B97DD45E-843A-2B4A-B651-B250CBD29D4C'),(27,'85b02c98-8b21-43be-b53f-2995c80952a9','2024-02-23 00:00:31',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(28,'fb3847e3-2f7b-4eed-820b-da7453622111','2024-02-23 00:00:32',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/D9E0D292-C3F7-2211-37B8-B2DBEBDD55A1'),(29,'8a22f81a-eadb-40c8-a334-7d83fdf996bd','2024-02-23 00:00:48',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(30,'a2ddd806-0fae-4e09-ae1c-f34183d66551','2024-02-23 00:00:50',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/2\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/AA51D1A3-AB6D-31F1-5C35-B28D0D94283B'),(31,'715e1353-e78a-4695-be3c-89c486c1b5f7','2024-02-23 00:01:22',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"AA51D1A3-AB6D-31F1-5C35-B28D0D94283B\",\"referer\":\"customers\\/listing\\/2\",\"customer_code\":\"Nulla\",\"title\":\"Mrs\",\"first_name\":\"Hallx\",\"last_name\":\"Andersonx\",\"address\":\"P.O. Box 606, 9126 Faucibus Rd.x\",\"city\":\"Brive-la-Gaillardex\",\"nic\":\"T698825074211X\",\"dob\":\"2023-06-01\",\"remarks\":\"\",\"email\":\"metus.vitae@yahoo.edu\",\"phone_number1\":\"57924967\",\"phone_number2\":\"53100212\"},\"FILES\":[]}',1,'customers/save'),(32,'d516e639-effb-492a-b6df-901dbaac14dc','2024-02-23 00:01:22',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/2'),(33,'484c307e-3773-4f6f-929c-f82cc28841f1','2024-02-23 00:01:28',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(34,'8bf4d248-3030-4f79-b091-537d8e2060d9','2024-02-23 00:01:31',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/89CEF9CD-1E92-EDBC-1D3C-EA108A3BA155'),(35,'7c9db988-a942-4be8-99ec-588aaaf49a18','2024-02-23 00:02:03',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"89CEF9CD-1E92-EDBC-1D3C-EA108A3BA155\",\"referer\":\"customers\\/listing\\/1\",\"customer_code\":\"gravida.\",\"title\":\"Mrs\",\"first_name\":\"Kylynn\",\"last_name\":\"Boyle\",\"address\":\"P.O. Box 769, 3752 Dapibus St.\",\"city\":\"Carcassonne\",\"nic\":\"E736956128768N\",\"dob\":\"2010-02-02\",\"remarks\":\"\",\"email\":\"id.ante.nunc@outlook.com\",\"phone_number1\":\"52626527\",\"phone_number2\":\"51798194\"},\"FILES\":[]}',1,'customers/save'),(36,'9a1e5984-8610-411d-ad80-e76fecc77bbf','2024-02-23 00:02:03',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/1'),(37,'a1235505-7dc1-4423-8a8a-cf762e1a97b3','2024-02-23 00:02:07',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/89CEF9CD-1E92-EDBC-1D3C-EA108A3BA155'),(38,'36e9a30b-ed9a-49ff-a5ad-c8b1f13422c1','2024-02-23 00:05:10',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(39,'4e642f44-049d-4dcc-a39f-32bd3d198c2e','2024-02-23 00:05:41',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(40,'4e2187a2-9e63-4d39-bffa-cdb23fb0853f','2024-02-23 00:05:49',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(41,'418de288-7705-4d33-86ee-e9a417a5d390','2024-02-23 00:05:52',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/74ADEBAA-F48F-9D43-CB28-39E2417E7461'),(42,'fdbb5764-7272-4c34-992a-863b09ead3f8','2024-02-23 00:06:00',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(43,'0eaf2ee5-52e3-4ee3-aafd-84d82a26ba3d','2024-02-23 00:06:47',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(44,'dadf44cb-82e9-4501-957a-afc1c7dd42b7','2024-02-23 00:07:05',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(45,'84ce0abb-72c4-41e6-95d3-14e188e85f55','2024-02-23 00:08:55',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/7B02759C-1FAB-281E-2626-E02D546C897A'),(46,'fafefaac-1cb3-4421-8352-99fa9354c1cc','2024-02-23 00:09:05',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"7B02759C-1FAB-281E-2626-E02D546C897A\",\"referer\":\"customers\\/listing\\/1\",\"customer_code\":\"eu\",\"title\":\"Mrs\",\"first_name\":\"Basilx\",\"last_name\":\"Armstrongx\",\"address\":\"P.O. Box 269, 2371 Penatibus Roadx\",\"city\":\"Toulousex\",\"nic\":\"N328883939542L\",\"dob\":\"2023-07-18\",\"remarks\":\"xx\",\"email\":\"sed.facilisis.vitae@google.couk\",\"phone_number1\":\"52240924\",\"phone_number2\":\"37378632\"},\"FILES\":[]}',1,'customers/save'),(47,'2619e308-60a5-4bdf-8a7f-256f79ece240','2024-02-23 00:09:45',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"7B02759C-1FAB-281E-2626-E02D546C897A\",\"referer\":\"customers\\/listing\\/1\",\"customer_code\":\"eu\",\"title\":\"Mrs\",\"first_name\":\"Basilx\",\"last_name\":\"Armstrongx\",\"address\":\"P.O. Box 269, 2371 Penatibus Roadx\",\"city\":\"Toulousex\",\"nic\":\"N328883939542L\",\"dob\":\"2023-07-18\",\"remarks\":\"xx\",\"email\":\"sed.facilisis.vitae@google.couk\",\"phone_number1\":\"52240924\",\"phone_number2\":\"37378632\"},\"FILES\":[]}',1,'customers/save'),(48,'1d9bc7ec-782e-411f-b3ee-3c16e989cf59','2024-02-23 00:09:45',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/1'),(49,'09b2d974-4110-4ef6-aacd-2afb18fb60c1','2024-02-23 00:09:49',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/7B02759C-1FAB-281E-2626-E02D546C897A'),(50,'e49baa15-6324-4ac4-b73b-d8ecb28bb665','2024-02-23 00:10:16',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"7B02759C-1FAB-281E-2626-E02D546C897A\",\"referer\":\"customers\\/listing\\/1\",\"customer_code\":\"eu\",\"title\":\"Mrs\",\"first_name\":\"Basilx\",\"last_name\":\"Armstrongx\",\"address\":\"P.O. Box 269, 2371 Penatibus Roadx\",\"city\":\"Toulousex\",\"nic\":\"N328883939542L\",\"dob\":\"2023-07-01\",\"remarks\":\"xx\",\"email\":\"sed.facilisis.vitae@google.couk\",\"phone_number1\":\"88888888\",\"phone_number2\":\"99999999\"},\"FILES\":[]}',1,'customers/save'),(51,'6ec208c8-312c-4138-b21c-db6c3aae53c7','2024-02-23 00:10:16',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/1'),(52,'81a836a8-4550-472c-8e92-fb6cb63edfbf','2024-02-23 00:10:18',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/7B02759C-1FAB-281E-2626-E02D546C897A'),(53,'ff717041-ed09-44af-b287-a3c76d350660','2024-02-23 00:10:33',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"7B02759C-1FAB-281E-2626-E02D546C897A\",\"referer\":\"customers\\/listing\\/1\",\"customer_code\":\"eu\",\"title\":\"Miss\",\"first_name\":\"Basil\",\"last_name\":\"Armstrong\",\"address\":\"P.O. Box 269, 2371 Penatibus Road\",\"city\":\"Toulouse\",\"nic\":\"N328883939542L\",\"dob\":\"2023-07-01\",\"remarks\":\"xx\",\"email\":\"sed.facilisis.vitae@google.couk\",\"phone_number1\":\"88888888\",\"phone_number2\":\"99999999\"},\"FILES\":[]}',1,'customers/save'),(54,'02ed261f-b692-4446-a3b1-30867a4782ce','2024-02-23 00:10:33',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/1'),(55,'c6e1e906-0a33-47e9-9ea7-dd180ee79c66','2024-02-23 00:10:37',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/4'),(56,'c2efb658-7295-46ea-a927-577057d529d2','2024-02-23 00:10:38',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(57,'0c87f87a-b204-49e1-9cd1-edd248a2e195','2024-02-23 00:11:41',2,'127.0.0.1','customers','add','','{\"GET\":{\"referer\":\"customers\\/listing\\/5\"},\"POST\":[],\"FILES\":[]}',1,'customers/add'),(58,'3fe24980-217e-4748-839a-2782071c8139','2024-02-23 00:12:29',2,'127.0.0.1','customers','save','','{\"GET\":[],\"POST\":{\"uuid\":\"\",\"referer\":\"customers\\/listing\\/5\",\"customer_code\":\"\",\"title\":\"Mr\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"address\":\"askahs\",\"city\":\"Curepip\",\"nic\":\"D111122223345R\",\"dob\":\"2000-01-01\",\"remarks\":\"haha\",\"email\":\"reeazr@gmail.com\",\"phone_number1\":\"12345678\",\"phone_number2\":\"1234567\"},\"FILES\":[]}',1,'customers/save'),(59,'c128a11a-79d4-4a04-b469-606cda3128e3','2024-02-23 00:12:29',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(60,'bd4a593a-b44a-4e97-8d1c-ef3af821b4d6','2024-02-23 00:12:33',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"doe\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(61,'42b8faa8-a2d5-4945-8204-bbd7c9b0cc8b','2024-02-23 00:12:37',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(62,'1e05656f-77f5-4808-9b19-98a93d0809d6','2024-02-23 00:12:51',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"doe\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(63,'112bcee9-cd6f-4d87-bd02-3f22d3b10a5a','2024-02-23 00:12:57',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"john\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(64,'9d2bc265-7592-4aad-a2a6-f69b37b22236','2024-02-23 00:13:00',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(65,'f42cae7e-6386-4e99-aac2-a07fe3757cd7','2024-02-23 00:13:45',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"than\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(66,'6f80f649-b943-4b1a-a8fa-2bc7d4d4a365','2024-02-23 00:13:49',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(67,'e66289e3-a59b-426d-85fd-bdcc9ea99e9b','2024-02-23 00:13:54',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(68,'b0b5567e-f21d-4210-a17d-475e74a621d7','2024-02-23 00:13:59',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"doe\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(69,'55645038-e064-42fd-8c79-5a6270fd7aac','2024-02-23 00:14:03',2,'127.0.0.1','customers','edit','','{\"GET\":{\"referer\":\"customers\\/listing\\/1\"},\"POST\":[],\"FILES\":[]}',1,'customers/edit/c5109103-9d75-4684-a5d4-720ef231e378'),(70,'d863bf27-695b-468b-aa7a-8bd6e68f10f7','2024-02-23 00:14:12',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing'),(71,'78564aee-fe07-4156-bd66-afe0e98144d3','2024-02-23 00:14:16',2,'127.0.0.1','customers','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(72,'99b2b032-4918-4679-986a-5ac7c9f43d56','2024-02-23 00:14:21',2,'127.0.0.1','customers','listing','','{\"GET\":{\"display\":\"10\",\"search_text\":\"doe\"},\"POST\":[],\"FILES\":[]}',1,'customers/listing/5'),(73,'03f84f7f-20c0-47ac-a40a-aab8b7ee076c','2024-02-23 00:39:47',2,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'dashboard/index'),(74,'2344c3fc-c1d2-4ea5-9de1-61941a205ba7','2024-02-23 00:49:04',2,'127.0.0.1','users','signout','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'users/signout'),(75,'4d9a4ba4-3774-469f-b2ac-ab6caf63a429','2024-02-23 01:38:45',2,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'dashboard/index'),(76,'018328e3-d50f-43fc-8d98-54e7d131ebdd','2024-02-23 01:38:47',2,'127.0.0.1','backoffice','on','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'backoffice/on'),(77,'0507d25b-393a-4be9-8ed0-25f857d07b04','2024-02-23 01:38:47',2,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,''),(78,'7b75b9ab-8e60-4f91-8893-b254d8cf7619','2024-02-23 01:38:51',2,'127.0.0.1','departments','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'departments/listing'),(79,'96375c79-9f6f-4df7-8f77-113a8cf64f9b','2024-02-23 01:38:52',2,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,''),(80,'49162ceb-f41d-4de9-82e9-0ce52604ea44','2024-02-23 01:40:00',2,'127.0.0.1','dashboard','index','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,''),(81,'c20bfd88-4abb-42fd-a553-46065f1a02a9','2024-02-23 01:40:11',2,'127.0.0.1','settings','menu_order','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'settings/menu_order'),(82,'a396e910-2f5e-4b84-a15b-c6ae2322c8a5','2024-02-23 01:41:30',2,'127.0.0.1','settings','menu_order','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'settings/menu_order'),(83,'a3a0fe75-e758-4e84-9ab2-b0a86ea9cf12','2024-02-23 01:41:54',2,'127.0.0.1','settings','menu_order','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'settings/menu_order'),(84,'59dea062-732b-46f5-9022-608a2634337d','2024-02-23 01:42:30',2,'127.0.0.1','settings','menu_order','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'settings/menu_order'),(85,'729312d1-02a1-4a60-a130-b6c5de97abf9','2024-02-23 01:43:35',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(86,'a3252289-01a4-4ea6-a521-4ad4828bf18b','2024-02-23 01:45:55',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(87,'e0d1a722-616c-4f57-9781-3b8c7ee93fdc','2024-02-23 01:46:56',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(88,'389c8550-a8fc-4e8f-8840-75979c4d83a7','2024-02-23 01:53:30',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(89,'479c77e5-7cca-4ff5-af00-0f8fac251128','2024-02-23 01:55:02',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(90,'f219fea4-d1d1-4891-9c76-eae7ff31f78c','2024-02-23 01:55:44',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(91,'c5546abc-8e27-4e68-917b-68897eb9a2b0','2024-02-23 01:56:15',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(92,'b004fe4c-b0b9-4c23-a06e-79e734e4c1b9','2024-02-23 01:56:34',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(93,'8e765e03-0eca-4d46-8c8f-7fe1cf701ddb','2024-02-23 01:57:03',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(94,'db86c8c1-1248-40e8-bd51-6aa4e72fe070','2024-02-23 01:57:16',2,'127.0.0.1','customers','add','','{\"GET\":{\"referer\":\"customers\\/listing\"},\"POST\":[],\"FILES\":[]}',1,'customers/add'),(95,'09eb26c5-10a7-4ece-a0c8-f558984d5ee2','2024-02-23 01:57:20',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(96,'0e56144b-cfa0-4747-8326-709d48fc6e13','2024-02-23 01:57:39',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(97,'68e3516e-84f6-4f01-8080-ca050713daa9','2024-02-23 01:57:42',2,'127.0.0.1','products','add','','{\"GET\":{\"referer\":\"products\\/listing\"},\"POST\":[],\"FILES\":[]}',1,'products/add'),(98,'5130f9fd-8e28-487c-b192-dfab9aeaaefb','2024-02-23 01:58:13',2,'127.0.0.1','products','add','','{\"GET\":{\"referer\":\"products\\/listing\"},\"POST\":[],\"FILES\":[]}',1,'products/add'),(99,'e0afdf7f-5746-4195-82ef-dcff39391771','2024-02-23 01:58:58',2,'127.0.0.1','products','add','','{\"GET\":{\"referer\":\"products\\/listing\"},\"POST\":[],\"FILES\":[]}',1,'products/add'),(100,'7a8dfeb0-43df-4f42-9189-ba2e7e1a6b25','2024-02-23 02:00:14',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(101,'6c3f2655-3155-4eee-b27e-5cb3e768bf91','2024-02-23 02:00:16',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(102,'8d1ebaa6-db3d-4cec-a61b-2d1644b55175','2024-02-23 02:00:39',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(103,'7daec525-0602-46c9-8e31-c4d9f64e2a11','2024-02-23 02:01:25',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(104,'ab15d630-275c-4340-93dd-5b02aa152f33','2024-02-23 02:01:40',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(105,'7dfec90a-fd80-4056-acf9-ca0853573a79','2024-02-23 02:02:21',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"VS123X09ZZ\",\"id\":\"2\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(106,'bb794d89-19dc-4159-ba88-30a853d46129','2024-02-23 02:02:21',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"1b623059-2f07-4a1f-9eca-d7545f6d814e\",\"id\":\"2\",\"stockref\":\"VS123X09ZZ\",\"name\":\"VESTEZZ\",\"description\":\"ZZ\",\"category_id\":\"7\",\"cost_price\":\"1\",\"selling_price\":\"10000\",\"deleted_image\":\"\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(107,'0b423a73-1a67-408f-8bd0-b194f2a61d17','2024-02-23 02:02:21',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(108,'5bb55545-6ff7-4635-a27f-cb52b01976ba','2024-02-23 02:02:25',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(109,'f1989373-1cfd-4b16-977e-77d66c7390fb','2024-02-23 02:02:31',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"VS123X09ZZ\",\"id\":\"2\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(110,'7a7e3d80-995c-4601-bc8c-b6304b4d2a7e','2024-02-23 02:02:31',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"1b623059-2f07-4a1f-9eca-d7545f6d814e\",\"id\":\"2\",\"stockref\":\"VS123X09ZZ\",\"name\":\"VESTEZZ\",\"description\":\"ZZ\",\"category_id\":\"10\",\"cost_price\":\"1\",\"selling_price\":\"10000\",\"deleted_image\":\"\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(111,'3a405b7d-0969-4a7e-9a07-72bfb33390fc','2024-02-23 02:02:31',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(112,'6cdafaee-04d7-4891-84fd-9d49808cb637','2024-02-23 02:02:37',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/bb0d0cfd-41ce-4a3d-8580-48b61fd69f8e'),(113,'6a8c0a0a-723f-483d-9498-275ffb1b01f4','2024-02-23 02:02:44',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(114,'5ff26983-f9d8-4527-951b-d6ddd238a3c3','2024-02-23 02:02:46',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(115,'2d0ff4fe-e0b5-4480-ae42-a917fa60ca73','2024-02-23 02:02:48',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(116,'dc51fb3a-e301-460d-a293-0ff3cb0a257d','2024-02-23 02:02:50',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/72a903c5-c2ac-46f9-aaad-c8167f8936cf'),(117,'5fdee749-30ed-4aff-a942-c62c6582d4d1','2024-02-23 02:03:24',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/72a903c5-c2ac-46f9-aaad-c8167f8936cf'),(118,'57a42ab8-152d-4632-a300-a1b301209799','2024-02-23 02:04:15',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/72a903c5-c2ac-46f9-aaad-c8167f8936cf'),(119,'d019297a-9106-4d42-97ad-8c90476a7f53','2024-02-23 02:04:23',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"SKADL\",\"id\":\"9\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(120,'5d497ddf-ac6b-4dce-a817-c331dc1c7e3d','2024-02-23 02:04:23',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"72a903c5-c2ac-46f9-aaad-c8167f8936cf\",\"id\":\"9\",\"stockref\":\"SKADL\",\"name\":\"NSAD BNSADN B\",\"description\":\"SADDSAD\",\"category_id\":\"1\",\"cost_price\":\"0\",\"selling_price\":\"24999\",\"deleted_image\":\"http:\\/\\/casse-croute.local\\/www\\/uploads\\/products\\/7848539d48f2eb924a83416e3eb607b4.jpg\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(121,'9b4b3108-088a-4187-ae78-4b57df18e613','2024-02-23 02:04:23',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(122,'ee318c40-a140-4f75-a3d3-db692d8b39f7','2024-02-23 02:04:28',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/bb0d0cfd-41ce-4a3d-8580-48b61fd69f8e'),(123,'830e9d27-cff7-432e-b06b-7e0e52ea79bf','2024-02-23 02:04:32',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"BM003\",\"id\":\"3\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(124,'a1a7cc2c-d989-43fd-9151-9fe70f447c86','2024-02-23 02:04:32',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"bb0d0cfd-41ce-4a3d-8580-48b61fd69f8e\",\"id\":\"3\",\"stockref\":\"BM003\",\"name\":\"BERMUDA\",\"description\":\"SIMPLE BERMUDA\",\"category_id\":\"1\",\"cost_price\":\"0\",\"selling_price\":\"1299\",\"deleted_image\":\"http:\\/\\/casse-croute.local\\/www\\/uploads\\/products\\/4b0fe06c7e621133e2bae3b1e5211f4d.png\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(125,'5a2e2acf-ed97-437d-a39a-b258bd7a52b4','2024-02-23 02:04:32',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(126,'b813b2e7-5dce-48b5-a208-353f36b930d0','2024-02-23 02:04:36',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(127,'adf281c5-f3c9-4bb2-a2f8-e14e17613003','2024-02-23 02:04:39',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"VS123X09ZZ\",\"id\":\"2\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(128,'d9ee02d6-7a95-4f59-af2a-af268b4b5c68','2024-02-23 02:04:39',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"1b623059-2f07-4a1f-9eca-d7545f6d814e\",\"id\":\"2\",\"stockref\":\"VS123X09ZZ\",\"name\":\"VESTEZZ\",\"description\":\"ZZ\",\"category_id\":\"10\",\"cost_price\":\"1\",\"selling_price\":\"10000\",\"deleted_image\":\"http:\\/\\/casse-croute.local\\/www\\/uploads\\/products\\/f06be8f5957ada3e7432050636e041f9.jpg\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(129,'2e288785-b564-4267-a523-c02b85024d9c','2024-02-23 02:04:39',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(130,'8b75b6fa-e58d-45ee-9cc7-421735fb5298','2024-02-23 02:04:41',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/1b623059-2f07-4a1f-9eca-d7545f6d814e'),(131,'1688d7bf-5b90-4c01-a6ba-4e48dd608f15','2024-02-23 02:04:44',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(132,'334c3c2b-494e-41ed-baaf-1efbdf0e59d3','2024-02-23 02:04:46',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/72a903c5-c2ac-46f9-aaad-c8167f8936cf'),(133,'1869c767-6223-46c9-8465-7ee2e9e5dbea','2024-02-23 02:04:48',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(134,'c159aade-baad-4f02-a233-ab84ff24ad57','2024-02-23 02:04:49',2,'127.0.0.1','products','edit','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/edit/b5b8694f-5f56-4a13-88ca-1920addc4dae'),(135,'e2bd5eba-dacd-4748-90f5-6c22f1c78352','2024-02-23 02:04:52',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"TIE\",\"id\":\"11\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(136,'2bde66c9-2506-489e-91d9-218be410230d','2024-02-23 02:04:53',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"b5b8694f-5f56-4a13-88ca-1920addc4dae\",\"id\":\"11\",\"stockref\":\"TIE\",\"name\":\"TIE\",\"description\":\"HELLO\",\"category_id\":\"1\",\"cost_price\":\"100\",\"selling_price\":\"1800\",\"deleted_image\":\"http:\\/\\/casse-croute.local\\/www\\/uploads\\/products\\/cb432524f99de4263a5cee9b10844566.png\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(137,'a5efc679-6116-4d47-89bc-f603dff87df1','2024-02-23 02:04:53',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(138,'6d772da5-2e65-4b20-936d-3ae29f1b1dcb','2024-02-23 02:08:33',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing'),(139,'7f73fd3c-ef0d-49ad-9f1b-e7778e40993b','2024-02-23 02:08:36',2,'127.0.0.1','products','add','','{\"GET\":{\"referer\":\"products\\/listing\"},\"POST\":[],\"FILES\":[]}',1,'products/add'),(140,'773a8c7c-c495-40e8-be56-190674d37493','2024-02-23 02:08:40',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"vzxbzxvb\",\"id\":\"\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(141,'5cebceb4-3952-4945-9362-5d20b0c73d86','2024-02-23 02:08:53',2,'127.0.0.1','products','stockRefExists','','{\"GET\":{\"stockref\":\"vzxbzxvb\",\"id\":\"\"},\"POST\":[],\"FILES\":[]}',1,'products/stockRefExists'),(142,'eed51791-c6a7-4663-817a-f39142db933b','2024-02-23 02:08:53',2,'127.0.0.1','products','save','','{\"GET\":[],\"POST\":{\"uuid\":\"\",\"id\":\"\",\"stockref\":\"vzxbzxvb\",\"name\":\"Testing\",\"description\":\"asdhasjkds\",\"category_id\":\"8\",\"cost_price\":\"1000\",\"selling_price\":\"3450\"},\"FILES\":{\"photos\":{\"name\":[\"\"],\"type\":[\"\"],\"tmp_name\":[\"\"],\"error\":[4],\"size\":[0]}}}',1,'products/save'),(143,'b2d4dfd3-135f-4d3b-928b-69590ee58169','2024-02-23 02:08:53',2,'127.0.0.1','products','listing','','{\"GET\":[],\"POST\":[],\"FILES\":[]}',1,'products/listing');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_history`
--

DROP TABLE IF EXISTS `login_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` text,
  `user_id` int DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `result` enum('SUCCESS','FAILED','OTHER') NOT NULL,
  `ip` text NOT NULL,
  `result_other` text NOT NULL,
  `os` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_login_history_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_history`
--

LOCK TABLES `login_history` WRITE;
/*!40000 ALTER TABLE `login_history` DISABLE KEYS */;
INSERT INTO `login_history` VALUES (9,'root',1,'2024-02-22 22:29:57','SUCCESS','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:123.0) Gecko/20100101 Firefox/123.0','Linux','Firefox 123.0'),(10,'reeaz',2,'2024-02-22 23:57:20','SUCCESS','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:123.0) Gecko/20100101 Firefox/123.0','Linux','Firefox 123.0'),(11,'reeaz',2,'2024-02-23 00:39:44','SUCCESS','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:123.0) Gecko/20100101 Firefox/123.0','Linux','Firefox 123.0'),(12,'reeaz',2,'2024-02-23 01:38:42','SUCCESS','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:123.0) Gecko/20100101 Firefox/123.0','Linux','Firefox 123.0');
/*!40000 ALTER TABLE `login_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('menu','section','divider') DEFAULT 'menu',
  `nom` varchar(30) DEFAULT NULL,
  `controller` varchar(30) DEFAULT NULL,
  `action` varchar(30) DEFAULT NULL,
  `params` varchar(30) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `display_order` int DEFAULT '50',
  `parent_menu` int DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `Normal` int DEFAULT '0',
  `Admin` int DEFAULT '0',
  `Root` int DEFAULT '1',
  `module` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `backoffice` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'menu','Dashboard','dashboard','index',NULL,NULL,'fa-square',1,0,1,1,1,1,0,1,0),(10,'menu','Users','users','',NULL,NULL,'fa-square',2,0,1,0,1,1,0,1,1),(11,'menu','Listing','users','listing',NULL,NULL,'fa-angle-right',10,10,1,1,1,1,0,1,1),(12,'menu','Add','users','add',NULL,NULL,'fa-angle-right',20,10,1,0,1,1,0,1,1),(13,'menu','Edit','users','edit',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(14,'menu','Delete','users','delete',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(15,'menu','Permission','users','permission',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(16,'menu','Activate','users','activate',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(17,'menu','De-Activate','users','deactivate',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(18,'menu','My Profile','users','myprofile',NULL,NULL,'',999,0,0,1,1,1,0,1,1),(20,'menu','Menu','menu','',NULL,NULL,'fa-square',4,0,1,NULL,0,1,0,1,1),(21,'menu','Listing','menu','listing',NULL,NULL,'fa-angle-right',10,20,1,NULL,0,1,0,1,1),(22,'menu','Add','menu','add',NULL,NULL,'fa-angle-right',20,20,1,1,0,1,0,1,1),(23,'menu','Edit','menu','edit',NULL,NULL,'',999,0,0,NULL,0,1,0,1,1),(24,'menu','Delete','menu','delete',NULL,NULL,'',999,0,0,0,0,1,0,1,1),(25,'menu','CRUD','menu','crud',NULL,NULL,'fa-angle-right',30,20,1,NULL,0,1,0,1,1),(110,'menu','Settings','settings','',NULL,NULL,'fa-square',6,0,1,NULL,1,1,0,1,1),(111,'menu','Company','settings','company',NULL,NULL,'fa-angle-right',10,110,1,0,1,1,0,1,1),(112,'menu','Params','settings','params',NULL,NULL,'fa-angle-right',20,110,1,0,1,1,0,1,1),(113,'menu','Menu Order','settings','menu_order',NULL,NULL,'fa-angle-right',30,110,1,0,1,1,0,1,1),(135,'menu','Users','users','',NULL,NULL,'fa-square',100,0,1,NULL,1,1,0,0,1),(158,'menu','Notifications','settings','notifications',NULL,NULL,'fa-angle-right',50,110,1,NULL,1,1,0,1,1),(159,'menu','Audit Trail','audittrail','',NULL,NULL,'fa-square',7,0,1,NULL,NULL,1,0,1,1),(160,'menu','Listing','audittrail','listing',NULL,NULL,'fa-angle-right',10,159,1,NULL,NULL,1,0,1,1),(161,'menu','View','audittrail','view',NULL,NULL,'',50,0,0,NULL,NULL,1,0,1,1),(260,'menu','Departments','departments','',NULL,NULL,'fa-square',3,0,1,NULL,0,1,0,1,1),(261,'menu','Listing','departments','listing',NULL,NULL,'fa-angle-right',10,260,1,0,0,1,0,1,1),(262,'menu','Add','departments','add',NULL,NULL,'fa-angle-right',20,260,1,0,0,1,0,1,1),(263,'menu','Edit','departments','edit',NULL,NULL,'',999,0,0,0,0,1,0,1,1),(264,'menu','Delete','departments','delete',NULL,NULL,'',999,0,0,0,0,1,0,1,1),(380,'menu','Payment Modes','paymentmodes','',NULL,NULL,'fa-square',5,0,1,0,1,1,0,1,1),(381,'menu','Listing','paymentmodes','listing',NULL,NULL,'fa-angle-right',10,380,1,0,1,1,0,1,1),(382,'menu','Add','paymentmodes','add',NULL,NULL,'fa-angle-right',20,380,1,0,1,1,0,1,1),(383,'menu','Edit','paymentmodes','edit',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(384,'menu','Delete','paymentmodes','delete',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(410,'menu','Orders','orders','',NULL,NULL,'fa-square',60,0,1,1,1,1,0,1,0),(411,'menu','Listing','orders','listing',NULL,NULL,'fa-angle-right',10,410,1,1,1,1,0,1,0),(412,'menu','Add','orders','add',NULL,NULL,'fa-angle-right',20,410,1,1,1,1,0,1,0),(413,'menu','Edit','orders','edit',NULL,NULL,'',999,0,0,1,1,1,0,1,0),(414,'menu','View','orders','View',NULL,NULL,'',999,0,0,1,1,1,0,1,0),(415,'menu','Delete','orders','delete',NULL,NULL,'',999,0,0,1,1,1,0,1,0),(430,'menu','Products','products','',NULL,NULL,'fa-square',70,0,1,0,1,1,0,1,1),(431,'menu','Listing','products','listing',NULL,NULL,'fa-angle-right',10,430,1,0,1,1,0,1,1),(432,'menu','Add','products','add',NULL,NULL,'fa-angle-right',20,430,1,0,1,1,0,1,1),(433,'menu','Edit','products','edit',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(434,'menu','View','products','View',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(435,'menu','Delete','products','delete',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(440,'menu','Product Categories','product_categories','',NULL,NULL,'fa-square',80,0,1,0,1,1,0,1,1),(441,'menu','Listing','product_categories','listing',NULL,NULL,'fa-angle-right',10,440,1,0,1,1,0,1,1),(442,'menu','Add','product_categories','add',NULL,NULL,'fa-angle-right',20,440,1,0,1,1,0,1,1),(443,'menu','Edit','product_categories','edit',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(444,'menu','View','product_categories','View',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(445,'menu','Delete','product_categories','delete',NULL,NULL,'',999,0,0,0,1,1,0,1,1),(450,'menu','Customers','customers','',NULL,NULL,'fa-square',70,0,1,1,1,1,0,1,0),(451,'menu','Listing','customers','listing',NULL,NULL,'fa-angle-right',10,450,1,1,1,1,0,1,0),(452,'menu','Add','customers','add',NULL,NULL,'fa-angle-right',20,450,1,1,1,1,0,1,0),(453,'menu','Edit','customers','edit',NULL,NULL,'',999,0,0,1,1,1,0,1,0),(454,'menu','View','customers','View',NULL,NULL,'',999,0,0,1,1,1,0,1,0),(455,'menu','Delete','customers','delete',NULL,NULL,'',999,0,0,1,1,1,0,1,0),(500,'menu','Messages','messages','',NULL,NULL,'fa-square',60,0,1,0,1,1,0,1,0),(501,'menu','Listing','messages','listing',NULL,NULL,'fa-angle-right',10,500,1,0,1,1,0,1,0),(502,'menu','Add','messages','add',NULL,NULL,'fa-angle-right',20,500,1,0,1,1,0,1,0),(503,'menu','Edit','messages','edit',NULL,NULL,'',999,0,0,0,1,1,0,1,0),(504,'menu','View','messages','View',NULL,NULL,'',999,0,0,0,1,1,0,1,0),(505,'menu','Delete','messages','delete',NULL,NULL,'',999,0,0,0,1,1,0,1,0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recipient_id` int NOT NULL,
  `received_on` datetime DEFAULT NULL,
  `read_on` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `order_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (29);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `measurements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `fabric_reference` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fabric_color` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `size` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `additional_fields` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_id` (`order_id`),
  KEY `fk_order_product` (`product_id`),
  CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details_stage_history`
--

DROP TABLE IF EXISTS `order_details_stage_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details_stage_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_details_id` int NOT NULL,
  `date_updated` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `stage_id` int NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details_stage_history`
--

LOCK TABLES `order_details_stage_history` WRITE;
/*!40000 ALTER TABLE `order_details_stage_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details_stage_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int NOT NULL,
  `customer_id` int NOT NULL,
  `order_date` datetime NOT NULL,
  `amount` float NOT NULL,
  `discount` float NOT NULL,
  `deposit` float NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `delivery_store_id` int NOT NULL,
  `document_number` varchar(20) NOT NULL,
  `department_id` int NOT NULL DEFAULT '1',
  `trial_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users_idx` (`created_by`),
  KEY `fk_order_dept` (`department_id`),
  CONSTRAINT `fk_order_dept` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_comments`
--

DROP TABLE IF EXISTS `orders_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int NOT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marked_out` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_comments`
--

LOCK TABLES `orders_comments` WRITE;
/*!40000 ALTER TABLE `orders_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_images`
--

DROP TABLE IF EXISTS `orders_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_ext` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` float NOT NULL,
  `image_width` int NOT NULL,
  `image_height` int NOT NULL,
  `image_type` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_images`
--

LOCK TABLES `orders_images` WRITE;
/*!40000 ALTER TABLE `orders_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_remarks`
--

DROP TABLE IF EXISTS `orders_remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_remarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_id` int NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marked_out` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_remarks`
--

LOCK TABLES `orders_remarks` WRITE;
/*!40000 ALTER TABLE `orders_remarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_remarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `params`
--

DROP TABLE IF EXISTS `params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `params` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `value` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `params`
--

LOCK TABLES `params` WRITE;
/*!40000 ALTER TABLE `params` DISABLE KEYS */;
INSERT INTO `params` VALUES (1,'rows_per_page','10',1),(3,'theme','AdminLTE',1),(4,'sidebar_collapse','0',1),(5,'theme_color','red',1),(6,'rows_per_page_vehicles','10',1),(7,'rows_per_page_clients','10',1),(8,'rows_per_page_suppliers','10',1),(9,'logo','logo-casse-croute.jpg',1),(11,'send_enquiries_to','[]',1),(13,'current_version','0.40',1),(14,'smtp_settings','{\"hostname\":\"mail.staging-server.xyz\",\"username\":\"lemonyellow@staging-server.xyz\",\"from\":\"lemonyellow@staging-server.xyz\",\"displayname\":\"Lemon Yellow\",\"password\":\"FxN3S2#*O&Dq\",\"port\":\"587\"}',1),(16,'currency','Rs',1),(35,'dashboard','[{\"label\":\"Sales\",\"url\":\"sales\\/add\",\"class\":\"btn-info\",\"icon\":\"fa-dollar\",\"width\":\"4\"},{\"label\":\"Purchases\",\"url\":\"purchases\\/add\",\"class\":\"btn-warning\",\"icon\":\"fa-dollar\",\"width\":\"4\"},{\"label\":\"Products\",\"url\":\"products\\/listing\",\"class\":\"btn-danger\",\"icon\":\"fa-list\",\"width\":\"4\"},{\"label\":\"Categories\",\"url\":\"productcategory\\/listing\",\"class\":\"btn-info\",\"icon\":\"fa-list\",\"width\":\"4\"},{\"label\":\"Inventory\",\"url\":\"#inventory\\/listing\",\"class\":\"btn-warning\",\"icon\":\"fa-list\",\"width\":\"4\"},{\"label\":\"Customers\",\"url\":\"customers\\/listing\",\"class\":\"btn-primary\",\"icon\":\"fa-users\",\"width\":\"4\"},{\"label\":\"Suppliers\",\"url\":\"suppliers\\/listing\",\"class\":\"btn-danger\",\"icon\":\"fa-users\",\"width\":\"4\"},{\"label\":\"Users\",\"url\":\"users\\/listing\",\"class\":\"btn-info\",\"icon\":\"fa-users\",\"width\":\"4\"}]',1),(36,'stockref_lastnumber','1',1),(37,'stockref_length','8',1),(38,'sales_last_number','1',1),(39,'sales_maxlength','10',1),(40,'sales_prefix','INV',1),(50,'testing_mode','no',1),(61,'notifications','[{\"stage\":\"1\",\"user\":\"2\"},{\"stage\":\"1\",\"user\":\"1\"},{\"stage\":\"23\",\"user\":\"2\"},{\"stage\":\"23\",\"user\":\"1\"},{\"stage\":\"9\",\"user\":\"5\"},{\"stage\":\"9\",\"user\":\"2\"},{\"stage\":\"9\",\"user\":\"1\"},{\"stage\":\"10\",\"user\":\"4\"},{\"stage\":\"10\",\"user\":\"2\"}]',1),(68,'login_background','[\r\n{\"image\":\"breakfast-2649620_1920.jpg\"},\r\n{\"image\":\"businesses-2897328_1920.jpg\"},\r\n{\"image\":\"cafe-789635_1920.jpg\"},\r\n{\"image\":\"city-4298285_1920.jpg\"},\r\n{\"image\":\"people-8563622_1920.jpg\"},\r\n{\"image\":\"restaurant-237060_1920.jpg\"}\r\n]',1);
/*!40000 ALTER TABLE `params` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_modes`
--

DROP TABLE IF EXISTS `payment_modes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_modes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `attachment` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_modes`
--

LOCK TABLES `payment_modes` WRITE;
/*!40000 ALTER TABLE `payment_modes` DISABLE KEYS */;
INSERT INTO `payment_modes` VALUES (1,'8c1189ba-6b24-4d64-88ec-debeca965e6b','Cash',1,1,'2022-11-15 22:02:51',0),(2,'eb4c6f5b-fa17-4c01-8693-56ae749ecb60','MCB Juice',1,1,'2022-11-15 22:02:51',1),(4,'ba75a19d-4284-4106-b425-a9d523aa670d','MyT Money',1,1,'2023-01-16 16:08:23',1);
/*!40000 ALTER TABLE `payment_modes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `profile_id` int DEFAULT NULL,
  `menu_id` int DEFAULT NULL,
  `create` int DEFAULT NULL,
  `read` int DEFAULT NULL,
  `update` int DEFAULT NULL,
  `delete` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_permissions_menu1_idx` (`menu_id`),
  KEY `fk_permissions_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=797 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,NULL,1,0,1,0,0),(2,1,NULL,10,0,1,0,0),(3,1,NULL,11,0,1,0,0),(4,1,NULL,12,0,1,0,0),(5,1,NULL,13,0,1,0,0),(6,1,NULL,14,0,1,0,0),(7,1,NULL,15,0,1,0,0),(8,1,NULL,16,0,1,0,0),(9,1,NULL,17,0,1,0,0),(10,1,NULL,18,0,1,0,0),(17,1,NULL,95,0,1,0,0),(18,1,NULL,110,0,1,0,0),(19,1,NULL,111,0,1,0,0),(20,1,NULL,112,0,1,0,0),(21,1,NULL,113,0,1,0,0),(22,1,NULL,158,0,1,0,0),(23,1,NULL,159,0,1,0,0),(24,1,NULL,160,0,1,0,0),(25,1,NULL,161,0,1,0,0),(26,1,NULL,170,0,1,0,0),(27,1,NULL,171,0,1,0,0),(28,1,NULL,172,0,1,0,0),(29,1,NULL,173,0,1,0,0),(30,1,NULL,174,0,1,0,0),(31,1,NULL,180,0,1,0,0),(32,1,NULL,181,0,1,0,0),(33,1,NULL,182,0,1,0,0),(34,1,NULL,183,0,1,0,0),(35,1,NULL,184,0,1,0,0),(36,1,NULL,190,0,1,0,0),(37,1,NULL,191,0,1,0,0),(38,1,NULL,192,0,1,0,0),(39,1,NULL,193,0,1,0,0),(40,1,NULL,194,0,1,0,0),(41,1,NULL,200,0,1,0,0),(42,1,NULL,201,0,1,0,0),(43,1,NULL,202,0,1,0,0),(44,1,NULL,203,0,1,0,0),(45,1,NULL,204,0,1,0,0),(46,1,NULL,210,0,1,0,0),(47,1,NULL,211,0,1,0,0),(48,1,NULL,212,0,1,0,0),(49,1,NULL,213,0,1,0,0),(50,1,NULL,214,0,1,0,0),(51,1,NULL,220,0,1,0,0),(52,1,NULL,221,0,1,0,0),(53,1,NULL,222,0,1,0,0),(54,1,NULL,223,0,1,0,0),(55,1,NULL,224,0,1,0,0),(56,1,NULL,230,0,1,0,0),(57,1,NULL,231,0,1,0,0),(58,1,NULL,232,0,1,0,0),(59,1,NULL,233,0,1,0,0),(60,1,NULL,234,0,1,0,0),(61,1,NULL,240,0,1,0,0),(62,1,NULL,241,0,1,0,0),(63,1,NULL,242,0,1,0,0),(64,1,NULL,243,0,1,0,0),(65,1,NULL,244,0,1,0,0),(66,1,NULL,250,0,1,0,0),(67,1,NULL,251,0,1,0,0),(68,1,NULL,252,0,1,0,0),(69,1,NULL,253,0,1,0,0),(70,1,NULL,254,0,1,0,0),(71,1,NULL,260,0,1,0,0),(72,1,NULL,261,0,1,0,0),(73,1,NULL,262,0,1,0,0),(74,1,NULL,263,0,1,0,0),(75,1,NULL,264,0,1,0,0),(77,1,NULL,340,0,1,0,0),(78,1,NULL,341,0,1,0,0),(79,1,NULL,342,0,1,0,0),(80,1,NULL,343,0,1,0,0),(81,1,NULL,344,0,1,0,0),(82,1,NULL,350,0,1,0,0),(83,1,NULL,351,0,1,0,0),(84,1,NULL,352,0,1,0,0),(85,1,NULL,353,0,1,0,0),(86,1,NULL,354,0,1,0,0),(87,1,NULL,360,0,1,0,0),(88,1,NULL,361,0,1,0,0),(89,1,NULL,362,0,1,0,0),(90,1,NULL,363,0,1,0,0),(91,1,NULL,364,0,1,0,0),(94,1,NULL,377,0,1,0,0),(95,1,NULL,380,0,1,0,0),(96,1,NULL,381,0,1,0,0),(97,1,NULL,382,0,1,0,0),(98,1,NULL,383,0,1,0,0),(99,1,NULL,384,0,1,0,0),(100,1,NULL,390,0,1,0,0),(101,1,NULL,391,0,1,0,0),(102,1,NULL,392,0,1,0,0),(103,1,NULL,393,0,1,0,0),(104,1,NULL,394,0,1,0,0),(442,1,NULL,395,0,1,0,0),(508,1,NULL,20,0,1,0,0),(509,1,NULL,21,0,1,0,0),(510,1,NULL,23,0,1,0,0),(511,1,NULL,24,0,1,0,0),(512,1,NULL,22,0,1,0,0),(513,1,NULL,25,0,1,0,0),(585,1,NULL,410,0,1,0,0),(586,1,NULL,411,0,1,0,0),(587,1,NULL,413,0,1,0,0),(588,1,NULL,414,0,1,0,0),(589,1,NULL,415,0,1,0,0),(590,1,NULL,412,0,1,0,0),(603,1,NULL,430,0,1,0,0),(604,1,NULL,431,0,1,0,0),(605,1,NULL,433,0,1,0,0),(606,1,NULL,434,0,1,0,0),(607,1,NULL,435,0,1,0,0),(608,1,NULL,432,0,1,0,0),(609,1,NULL,440,0,1,0,0),(610,1,NULL,441,0,1,0,0),(611,1,NULL,443,0,1,0,0),(612,1,NULL,444,0,1,0,0),(613,1,NULL,445,0,1,0,0),(614,1,NULL,442,0,1,0,0),(627,1,NULL,450,0,1,0,0),(628,1,NULL,451,0,1,0,0),(629,1,NULL,453,0,1,0,0),(630,1,NULL,454,0,1,0,0),(631,1,NULL,455,0,1,0,0),(632,1,NULL,452,0,1,0,0),(633,2,NULL,1,0,1,0,0),(634,2,NULL,10,0,1,0,0),(635,2,NULL,11,0,1,0,0),(636,2,NULL,13,0,1,0,0),(637,2,NULL,14,0,1,0,0),(638,2,NULL,15,0,1,0,0),(639,2,NULL,16,0,1,0,0),(640,2,NULL,17,0,1,0,0),(641,2,NULL,18,0,1,0,0),(642,2,NULL,12,0,1,0,0),(643,2,NULL,380,0,1,0,0),(644,2,NULL,381,0,1,0,0),(645,2,NULL,383,0,1,0,0),(646,2,NULL,384,0,1,0,0),(647,2,NULL,382,0,1,0,0),(648,2,NULL,110,0,1,0,0),(649,2,NULL,111,0,1,0,0),(650,2,NULL,112,0,1,0,0),(651,2,NULL,113,0,1,0,0),(652,2,NULL,158,0,1,0,0),(659,2,NULL,430,0,1,0,0),(660,2,NULL,431,0,1,0,0),(661,2,NULL,433,0,1,0,0),(662,2,NULL,434,0,1,0,0),(663,2,NULL,435,0,1,0,0),(664,2,NULL,432,0,1,0,0),(665,2,NULL,450,0,1,0,0),(666,2,NULL,451,0,1,0,0),(667,2,NULL,453,0,1,0,0),(668,2,NULL,454,0,1,0,0),(669,2,NULL,455,0,1,0,0),(670,2,NULL,452,0,1,0,0),(671,2,NULL,440,0,1,0,0),(672,2,NULL,441,0,1,0,0),(673,2,NULL,443,0,1,0,0),(674,2,NULL,444,0,1,0,0),(675,2,NULL,445,0,1,0,0),(676,2,NULL,442,0,1,0,0),(677,2,NULL,260,0,1,0,0),(678,2,NULL,261,0,1,0,0),(679,2,NULL,263,0,1,0,0),(680,2,NULL,264,0,1,0,0),(681,2,NULL,262,0,1,0,0),(682,2,NULL,410,0,1,0,0),(683,2,NULL,411,0,1,0,0),(684,2,NULL,413,0,1,0,0),(685,2,NULL,414,0,1,0,0),(686,2,NULL,415,0,1,0,0),(687,2,NULL,412,0,1,0,0),(767,1,NULL,500,0,1,0,0),(768,1,NULL,501,0,1,0,0),(769,1,NULL,502,0,1,0,0),(770,1,NULL,503,0,1,0,0),(771,1,NULL,504,0,1,0,0),(772,1,NULL,505,0,1,0,0),(773,2,NULL,500,0,1,0,0),(774,2,NULL,501,0,1,0,0),(775,2,NULL,502,0,1,0,0),(776,2,NULL,503,0,1,0,0),(777,2,NULL,504,0,1,0,0),(778,2,NULL,505,0,1,0,0);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'94c5f9c4-f1c3-42a9-85bc-29c4655cb3ca','Azhello 1',1,'2023-06-20 13:10:06',1,NULL),(7,'af11b543-727c-4082-bed0-2164805f0569','Veste',1,'2023-06-20 13:10:11',1,'669a25ef5dfea72e5da4128fc9094fbb.jpg'),(8,'22228c9a-590b-4950-ad5c-6a4343a3698f','Ties',1,'2023-06-20 13:14:58',1,'f2864a1efad30423a8d1253f66cea077.png'),(9,'bed50eb2-f680-48d6-b8a0-3d0ae27b53ff','Shirts',1,'2023-06-20 13:15:03',1,'74640e854d1f26d6a41481bc961c3c49.jpg'),(10,'56d931b8-acfa-494f-8124-d1b79bc60d1e','Bermuda',1,'2023-06-26 08:58:07',1,'01c37a172438ed773b5692c40030a86b.png');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stockref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `cost_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `selling_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stockref_idx` (`stockref`),
  KEY `fk_product_users_idx` (`created_by`),
  KEY `fk_product_category` (`category_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'269f7e3b-6460-4bfc-9feb-fae7e7bb8db0','ZZSXS','ASDAD','ZXC XC BXCB X','99','88','7c03478f0eca88c4220411eb784b4af1.jpg',1,'2024-02-23 01:48:55',0,1),(2,'1b623059-2f07-4a1f-9eca-d7545f6d814e','VS123X09ZZ','VESTEZZ','ZZ','1','10000','',1,'2024-02-23 01:48:55',1,10),(3,'bb0d0cfd-41ce-4a3d-8580-48b61fd69f8e','BM003','BERMUDA','SIMPLE BERMUDA','0','1299','',1,'2024-02-23 01:48:55',1,1),(9,'72a903c5-c2ac-46f9-aaad-c8167f8936cf','SKADL','NSAD BNSADN B','SADDSAD','0','24999','',1,'2024-02-23 01:48:55',1,1),(10,'830ae4f7-c0a2-40d3-9120-7560b2ae317e','HASSKA','SAJSAJH','SAJHJHKSA','0','1799','5f6782fd9d0d1169859fb420d1fd99fb.jpg',1,'2024-02-23 01:48:55',0,1),(11,'b5b8694f-5f56-4a13-88ca-1920addc4dae','TIE','TIE','HELLO','100','1800','',1,'2024-02-23 01:48:55',1,1),(12,'7fff9306-b8c2-486c-9dc4-4e7b2418c2da','B14','BERMUDA','SADSAD','1','1','93e09ccbc1a7dccaa9b08acd5735e43d.png',1,'2024-02-23 01:48:55',0,1),(13,'375b39c4-4fde-41a3-844a-07bbf42785b0','VZXBZXVB','TESTING','ASDHASJKDS','1000','3450','',2,'0000-00-00 00:00:00',1,8);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(70) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_level` enum('Normal','Admin','Root') DEFAULT 'Normal',
  `status` int NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,0-deleted',
  `last_login` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `created_by` int NOT NULL,
  `created` datetime DEFAULT NULL,
  `job_title` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `force_update` int NOT NULL DEFAULT '0',
  `department_id` int DEFAULT NULL,
  `is_sales` int NOT NULL DEFAULT '0',
  `is_delivery` int NOT NULL DEFAULT '0',
  `is_storekeeper` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_dept` (`department_id`),
  KEY `fk_user_user` (`created_by`),
  CONSTRAINT `fk_user_dept` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `fk_user_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'5d9754bf-7572-4402-ab0b-d2c7680fc280','root','81dc9bdb52d04dc20036dbd8313ed055','Root',1,'2024-02-22 22:29:57','127.0.0.1','Root User','DSC_0358_resized251.JPG',1,'2022-11-15 22:02:51','SysAdmin','reeaz@ramoly.info',0,1,0,0,0),(2,'5a105035-70f2-4460-8a67-8e18d69835ec','reeaz','81dc9bdb52d04dc20036dbd8313ed055','Admin',1,'2024-02-23 01:38:42','127.0.0.1','Reeaz','20231230_073701-600x600px.jpg',1,'2023-06-16 00:22:15','Testa','reeaz@netsiteweaver.com',0,1,0,0,0);
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

-- Dump completed on 2024-02-23  2:11:31
