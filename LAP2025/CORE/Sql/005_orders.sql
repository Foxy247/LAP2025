CREATE TABLE orders
(
    id      INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT,
    date    DATE,
    status  tinyint(1),
    FOREIGN KEY (user_id) REFERENCES users (id)
);