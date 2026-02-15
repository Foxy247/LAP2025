CREATE TABLE products
(
    id          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name        VARCHAR(255) NOT NUll,
    description TEXT ,
    stock       INT NOT NUll,
    price       DECIMAL(8, 2) NOT NUll, 
    image       VARCHAR(510) ,
    is_active   tinyint(1) NOT NUll
);