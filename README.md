## The Entry Point

To begin navigating and using LittyLit, a user should enter the website through the welcome.html page. Excluding the administrator login page, user login page, and registration page, all pages require a user to be logged in prior to accessing page content. A user is redirected to welcome.html in the event that an attepted visit to a page determines the user to not be logged in. This file can be accessed by searching localhost:8080/LittyLit/app/welcome.html. Because our code uses PHP and MySQL via XAMPP, XAMPP should be downloaded for website functionality.

## Starting LittyLit
### Downloading XAMPP
As LittyLit is built using HTML, CSS (+ Bootstrap), JavaScript, MySQL, and PHP, XAMPP should be used to run LittyLit. Begin by ensuring that a working version of XAMPP is downloaded and functional on your machine.

### Managing XAMPP Servers
Once downloading XAMPP, start XAMPP and ensure that the status light of XAMPP turns green. Following the sucessful start of XAMPP, navigate to the 'Services' tab, and start all available stack services. These services should include MySQL, ProFTPD, and Apache. Next, navigate to the 'Networks' tab and enable your localhost network. Finally, navigate to the 'Volumes' tab, click 'Mount,' and then click 'Explore.' This will display several folders on your computer, including one called htdocs. This is the folder where you will need to copy our LittyLit folder into.

## Permissions for Uploading Images
To handle adding books as a vendor to the database, ensure that your file permissions are properly set from the Images folder. In order to do this, navigate to your Images folder and run the following command:

`chmod 777 .`

### Databases in PHPMyAdmin
You’ll need to set up LittyLit's databases prior to running the application. The code below creates and prefills the six Littly databases needed for functionality with information such as LittyLit's user information, all available books for purchase, and much more. Begin by navigating to you localhost’s PHPMyAdmin, and find your SQL execution prompt.
Enter the following command to create empty versions of the six databases.


```sql
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
```

```sql
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
```

```sql
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
```

```sql
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
```

```sql
CREATE TABLE `promotions` (
  `id` float NOT NULL,
  `discount` float NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

```sql
CREATE TABLE `report` (
  `title` varchar(200) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `sold` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

The following SQL queries insert pre-made information into the queries. These entries can be used for testing purposes.

```sql
INSERT INTO `userInfo` (`firstName`, `lastName`, `username`, `password`, `email`, `birthday`, `strAddress`, `city`, `state`, `zip`, `userType`, `promotion`, `verification`) VALUES ('Andrew', 'Humble', 'andrewhumble', '123456', 'andrew@me.com', '2/28/01', '100 Maple Street', 'Athens', 'GA', '30601', '1', '0', '1');
```

```sql
INSERT INTO `userInfo` (`firstName`, `lastName`, `username`, `password`, `email`, `birthday`, `strAddress`, `city`, `state`, `zip`, `userType`, `promotion`, `verification`) VALUES ('Nisha', 'Rajendran', 'nisha', 'nisha123', 'nisha@gmail.com', '2000-01-01', '2222 Athens Ave', 'Athens', 'GA', '30604', '3', '0', '1');
```

```sql
INSERT INTO `userInfo` (`firstName`, `lastName`, `username`, `password`, `email`, `birthday`, `strAddress`, `city`, `state`, `zip`, `userType`, `promotion`, `verification`) VALUES ('Manmeet', 'Gill', 'meet', 'meet123', 'meet@gmail.com', '2000-09-22', '100 Maple Street', 'Athens', 'GA', '30548', '2', '0', '0');
```

```sql
INSERT INTO `book` (`username`, `title`, `author`, `price`, `genre`, `ISBN`, `stock`, `imgPath`, `description`) VALUES ('meet', 'Harry Potter', 'J.K. Rowling', '10', 'Fiction', '111111', '56', './images/HarryPotter.png', 'An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.');
```

```sql
INSERT INTO `book` (`username`, `title`, `author`, `price`, `genre`, `ISBN`, `stock`, `imgPath`, `description`) VALUES ('meet', 'The Great Gatsby', 'F. Scott Fitzgerald', '5', 'fiction', '122222', '9', './images/Gatsby.png', 'A writer and wall street trader, Nick, finds himself drawn to the past and lifestyle of his millionaire neighbor, Jay Gatsby.');
```

```sql
INSERT INTO `book` (`username`, `title`, `author`, `price`, `genre`, `ISBN`, `stock`, `imgPath`, `description`) VALUES ('meet', 'Lord of the Rings', 'J.R. Tolkein', '20', 'Fantasy', '732632', '3', './images/LordRing1.png', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.');
```

```sql
INSERT INTO `promotions` (`id`, `discount`, `name`) VALUES ('10101', '0.5', 'HALFOFF');
```


***********

## Libraries/Frameworks Used
LittyLit is built using HTML5, CSS3, MySQL, and PHP. The only framework used is Bootstrap, on top of CSS3, which provides a set of classes specially designed for responsive, mobile-first design.

## Code
No starter code was used for this project. All source code, files, and images are open-source and available at this project’s [GitHub Repository](#).