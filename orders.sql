CREATE TABLE `orders` (
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `confirmation_id` varchar(320) NOT NULL,
  `day_ordered` date NOT NULL,
  `street` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `ISBN` varchar(13) NOT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `promotion` float DEFAULT NULL,
  PRIMARY KEY (`order_id`,`username`,`ISBN`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;