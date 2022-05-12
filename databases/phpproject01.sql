/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likereview` (
  `likeReviewId` int NOT NULL AUTO_INCREMENT,
  `reviewsId` int NOT NULL,
  `usersId` int NOT NULL,
  PRIMARY KEY (`likeReviewId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `likereview` (`likeReviewId`, `reviewsId`, `usersId`) VALUES (1,11,1);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `productsId` int NOT NULL AUTO_INCREMENT,
  `productsName` varchar(255) NOT NULL,
  `productsPrice` int DEFAULT NULL,
  `productAddedByUserId` int NOT NULL,
  `productsDescription` varchar(128) DEFAULT NULL,
  `productsImage` varchar(200) DEFAULT NULL,
  `productsQuantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`productsId`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `products` (`productsId`, `productsName`, `productsPrice`, `productAddedByUserId`, `productsDescription`, `productsImage`, `productsQuantity`) VALUES (28,'fiets ',48,0,'this','627a7db90d6ae0.67934811.jpg',4),(29,'ddd',999,1,'dddd',NULL,85),(30,'aaaaname',4,3,'aaaadesc','6277a13ec36337.38159121.jpg',0),(31,'pear',44,3,'bulp d','62766e58d161b7.02800633.jpg',0),(32,'testn',45,1,'testd',NULL,0),(33,'neww',80,1,'new product in webshop','627a68cc2ac2a3.98136266.jpg',0),(34,'sdsdfsdfasdf',5,1,'fsadfasdf',NULL,0);
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
  PRIMARY KEY (`reviewsId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `reviews` (`reviewsId`, `reviewsName`, `productsId`, `reviewsImage`, `usersId`, `reviewsContent`, `stars`) VALUES (10,'test',28,NULL,1,'test review',3),(11,'blue',28,'627a805a463716.05976711.jpg',1,'nice car',3);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopping_cart` (
  `cartId` int NOT NULL AUTO_INCREMENT,
  `usersId` int NOT NULL,
  `productsId` int NOT NULL,
  `productQ` int DEFAULT NULL,
  `cartOrder` bit(1) DEFAULT NULL,
  PRIMARY KEY (`cartId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `shopping_cart` (`cartId`, `usersId`, `productsId`, `productQ`, `cartOrder`) VALUES (1,1,30,2,_binary '\0'),(3,1,29,3,_binary '\0');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `isManager`, `usersImage`) VALUES (1,'Stef ','stef.delnoye@gmail.com','stefdelnoye050d','$2y$10$fcX7kh5Gfl03VgTfNrGCJerFFiDjhNOep9ywoFJUO6sDels7u.tDq',_binary '','627a7ffe917fc8.86242960.jpg'),(2,'jan delnoye','jan.delnoye@gmail.com','jandell','$2y$10$BbwLMn0sf3rBm.Mfbtz2Kea.JkxInVhAUVZP4kFPWciLfP4QjDFBC',_binary '\0',NULL),(3,'piet','piet.delnoye@gmail.com','piet','$2y$10$RP3VFZ18HvXPx9M2DfLCtenTrdbPgeYDdzVzPBVK2LIA0HEJ0qxFG',_binary '',NULL),(5,'willem','willem@gmail.com','willem','$2y$10$gpXKb7J2vWTa7c71kdnCDuttQzk8pjHEsXV1B72VpLLMhDu6XRCFa',_binary '',NULL),(6,'JHONd','john2@gmail.com','john','$2y$10$GiCXhlbRrjGlK8lSN67avu7T.6qbiY2MHZjjz2ruBAGDY47BV5Bri',_binary '','62751df7170702.92458393.png'),(7,'bas en adrieaa','bas@gmail.com','bas','$2y$10$rD3EzDMxAa78fhz7v0hda./6d.h3x79RU2O6HpVUmjPYq61psUWvW',_binary '\0','62762b5a03d3c0.32902483.jpg'),(8,'bart','bart@gmail.com','bart','$2y$10$FwQLyHFVxX6plMhl/UIg.eaV6mBCzjiuiynDBK0viLYrynfYyyWhe',_binary '\0',''),(9,'asdfa','sdafaf@gmail.com','safsda','$2y$10$l6CD0aC30tMm/Fd4W4391u.0pvEyYXz7Ppx8PGl9jy8K.t1Z0nPn.',_binary '\0',NULL),(10,'e','eee@gmail.com','e','$2y$10$66y7G2x9jS4G.0apXDglWe07Niiej/4i94yepRkq3IzjstctOQ/tG',_binary '\0','62762dfa854c63.73596829.jpg');
