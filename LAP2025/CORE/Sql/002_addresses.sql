CREATE TABLE addresses
(
    id           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id      INT,
    address      VARCHAR(255),
    zip          CHAR(4),
    house_number INT,
    city         VARCHAR(255),
    type         tinyint(1),
    FOREIGN KEY (user_id) REFERENCES users (id)
);