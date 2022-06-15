/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likereview` (
  `likeReviewId` int NOT NULL AUTO_INCREMENT,
  `reviewsId` int NOT NULL,
  `usersId` int NOT NULL,
  PRIMARY KEY (`likeReviewId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `likereview` (`likeReviewId`, `reviewsId`, `usersId`) VALUES (15,10,0),(17,10,1),(18,11,1),(19,12,1),(20,18,1);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `productsId` int NOT NULL AUTO_INCREMENT,
  `productsName` varchar(255) NOT NULL,
  `productsPrice` int DEFAULT NULL,
  `productAddedByUserId` int NOT NULL,
  `productsDescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `productsImage` varchar(200) DEFAULT NULL,
  `productsQuantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`productsId`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `products` (`productsId`, `productsName`, `productsPrice`, `productAddedByUserId`, `productsDescription`, `productsImage`, `productsQuantity`) VALUES (36,'NYSTIAA DUMBBELLS  -  VINYL 2 X 3 KG  -  ROOD',35,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set rode Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 3 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a3ad736bfb75.90956410.png',0),(37,'NYSTIAA DUMBBELLS - VINYL 2 X 1,5 KG - GEEL',19,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set gele Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 1,5 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a607db265564.31502858.png',0),(38,'NYSTIAA DUMBBELLS - VINYL 2 X 2 KG - GROEN',25,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set groene Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 2 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a6085bc8db39.15371125.png',0),(39,'NYSTIAA DUMBBELLS - VINYL 2 X 1,0 KG - PAARS',13,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set paarse Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 1 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a6086f6d7da2.74119125.png',0),(40,'NYSTIAA DUMBBELLS - VINYL 2 X 4 KG - BLAUW',45,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set blauwe Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 4 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a6088f4f5eb0.28346914.png',0),(41,'NYSTIAA DUMBBELLS - VINYL 2 X 5 KG - ZWART',55,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set zwarte Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 5 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a608a2d0b9f5.09929967.png',0),(42,'NYSTIAA DUMBBELLS - VINYL 2 X 0,5 KG - ROZE',8,11,'Een work-out hoeft helemaal niet saai te zijn. Je maakt jouw training heel eenvoudig gezelliger met deze vrolijke set roze Dumbbells van het merk Tunturi. Muziekje aan en aan de slag! Dit is een set van 2 dumbbells met elk een gewicht van 0,5 kg. Ideaal voor allerlei oefeningen voor het versterken van bijvoorbeeld je arm- en beenspieren, je buikspieren of de spieren in je schouders en borst. Dankzij de rubberen toplaag liggen de dumbbells prettig en stevig in de hand. Het rubber zorgt bovendien voor minder geluid tijdens de work-out en beschermt tevens het metaal.','62a608b6ec57e8.21991952.png',0);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `reviewsId` int NOT NULL AUTO_INCREMENT,
  `reviewsName` varchar(255) NOT NULL,
  `productsId` int NOT NULL,
  `reviewsImage` varchar(200) DEFAULT NULL,
  `usersId` int NOT NULL,
  `reviewsContent` varchar(128) NOT NULL,
  `stars` int NOT NULL,
  `reviewsDate` datetime DEFAULT NULL,
  PRIMARY KEY (`reviewsId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `reviews` (`reviewsId`, `reviewsName`, `productsId`, `reviewsImage`, `usersId`, `reviewsContent`, `stars`, `reviewsDate`) VALUES (19,'hoi',28,NULL,1,'test',4,'2022-06-10 00:00:00'),(20,'asfasd',28,NULL,1,'sadfsad',1,'2022-06-10 00:00:00'),(21,'aa',28,NULL,1,'aaa',1,'2022-06-10 00:00:00'),(22,'aa',28,NULL,1,'aa',1,'2022-06-10 00:00:00'),(23,'Geweldig product!',36,NULL,11,'Heb nu echt goed kunnen trainen! Dank jullie wel NYSTIAA',1,'2022-06-15 00:00:00');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopping_cart` (
  `cartId` int NOT NULL AUTO_INCREMENT,
  `usersId` int NOT NULL,
  `productsId` int NOT NULL,
  `productQ` int DEFAULT NULL,
  `cartOrder` bit(1) DEFAULT NULL,
  PRIMARY KEY (`cartId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `shopping_cart` (`cartId`, `usersId`, `productsId`, `productQ`, `cartOrder`) VALUES (1,1,30,10,_binary '\0'),(8,12,34,1,NULL),(9,12,31,10,NULL),(10,1,31,1,NULL),(12,11,42,1,NULL);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `usersId` int NOT NULL AUTO_INCREMENT,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `isManager` bit(1) DEFAULT b'0',
  `usersImage` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`usersId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `isManager`, `usersImage`) VALUES (1,'Stef f','stef.delnoye@gmail.com','stefdelnoye050d','$2y$10$fcX7kh5Gfl03VgTfNrGCJerFFiDjhNOep9ywoFJUO6sDels7u.tDq',_binary '','627a7ffe917fc8.86242960.jpg'),(2,'jan delnoye','jan.delnoye@gmail.com','jandell','$2y$10$BbwLMn0sf3rBm.Mfbtz2Kea.JkxInVhAUVZP4kFPWciLfP4QjDFBC',_binary '',NULL),(3,'piet','piet.delnoye@gmail.com','piet','$2y$10$RP3VFZ18HvXPx9M2DfLCtenTrdbPgeYDdzVzPBVK2LIA0HEJ0qxFG',_binary '',NULL),(5,'willem','willem@gmail.com','willem','$2y$10$gpXKb7J2vWTa7c71kdnCDuttQzk8pjHEsXV1B72VpLLMhDu6XRCFa',_binary '',NULL),(6,'JHONd','john2@gmail.com','john','$2y$10$GiCXhlbRrjGlK8lSN67avu7T.6qbiY2MHZjjz2ruBAGDY47BV5Bri',_binary '','62751df7170702.92458393.png'),(7,'bas en adrieaa','bas@gmail.com','bas','$2y$10$rD3EzDMxAa78fhz7v0hda./6d.h3x79RU2O6HpVUmjPYq61psUWvW',_binary '\0','62762b5a03d3c0.32902483.jpg'),(8,'bart','bart@gmail.com','bart','$2y$10$FwQLyHFVxX6plMhl/UIg.eaV6mBCzjiuiynDBK0viLYrynfYyyWhe',_binary '\0',''),(9,'asdfa','sdafaf@gmail.com','safsda','$2y$10$l6CD0aC30tMm/Fd4W4391u.0pvEyYXz7Ppx8PGl9jy8K.t1Z0nPn.',_binary '\0',NULL),(10,'e','eee@gmail.com','e','$2y$10$66y7G2x9jS4G.0apXDglWe07Niiej/4i94yepRkq3IzjstctOQ/tG',_binary '\0','62762dfa854c63.73596829.jpg'),(11,'Christiaan Vlas','christiaan@vlas.nl','Christiaan','$2y$10$HziZw.RzPXTsRQ.Mz0GZqObQdIQFQShfxw7ZiniRFCvd1JZw/oi0y',_binary '','62a82cea7acc80.12121165.png'),(12,'Nynke','huppelpup@hallo.com','Nynke','$2y$10$RaPpCuKl1kVzSitRSQ7EuONMv/QpQ2bJOo/B2uGB6GYh0EDmnIXnG',_binary '\0',NULL);
