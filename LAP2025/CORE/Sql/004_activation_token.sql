CREATE TABLE activation_token
(
    id      INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT UNIQUE,
    token   VARCHAR(510),
    FOREIGN KEY (user_id) REFERENCES users (id)
);