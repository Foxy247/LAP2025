CREATE TABLE order_products
(
    id         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    product_id INT,
    order_id   INT,
    quantity   INT,
    price      DECIMAL(8, 2),
    FOREIGN KEY (product_id) REFERENCES products (id),
    FOREIGN KEY (order_id) REFERENCES orders (id)
);