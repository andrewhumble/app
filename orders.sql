CREATE TABLE orders (firstName varchar(15) NOT NULL,
                       lastName VARCHAR(30) NOT NULL ,
                       username VARCHAR(30) NOT NULL , 
                       order_id VARCHAR(30) NOT NULL, 
                       confirmation_id VARCHAR(320) NOT NULL , 
                       day_ordered VARCHAR(100) NOT NULL,
                       street VARCHAR(200),
                       city VARCHAR(200),
                       state VARCHAR(2),
                       zip VARCHAR(10),
                       ISBN VARCHAR(13),
                       price FLOAT,
                       quantity INT,
                       promotion FLOAT,
                    
                       PRIMARY KEY (order_id, username, ISBN));