CREATE TABLE users
(
    id         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name  VARCHAR(255),
    email      VARCHAR(255),
    phone      VARCHAR(255),
    password   VARCHAR(510),
    is_active  tinyint(1),
    is_admin   tinyint(1)
);