CREATE TABLE `book` (
  `username` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `ISBN` varchar(13) NOT NULL,
  `stock` int(7) DEFAULT NULL,
  `imgPath` varchar(250) DEFAULT NULL,
  `description` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`ISBN`),
  KEY ` username` (`username`),
  CONSTRAINT `user_link` FOREIGN KEY (`username`) REFERENCES `userInfo` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cart` (
  `username` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `quantity` int(11) NOT NULL,
  `imgPath` varchar(250) NOT NULL,
  `stock` int(7) DEFAULT NULL,
  PRIMARY KEY (`username`,`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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

CREATE TABLE `promotions` (
  `id` float NOT NULL,
  `discount` float NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `report` (
  `title` varchar(200) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `sold` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `userInfo` (
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(320) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  `strAddress` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `userType` varchar(1) NOT NULL,
  `promotion` int(11) DEFAULT NULL,
  `verification` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;