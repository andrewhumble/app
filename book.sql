CREATE TABLE book (username varchar(30) NOT NULL,
                       title varchar(100) NOT NULL,
                       author VARCHAR(30) NOT NULL ,
                       genre VARCHAR(30) NOT NULL , 
                       price VARCHAR(30) NOT NULL, 
                       isbn VARCHAR(320) NOT NULL , 
                       inventory    INT(120),
                       image        longblob NOT NULL,
                       created datetime NOT NULL DEFAULT current_timestamp(),
                    
                       PRIMARY KEY (isbn)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;