<?php

namespace Model;

use PDO;

class Product extends DB
{

    public function index(): array
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show(int $id): array|bool
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function store(array $data): void
    {
        $sql = "
            INSERT INTO products (
                name,
                description,
                stock,
                price,
                image,
                is_active
            )            VALUES (
                :name,
                :description,
                :stock,
                :price,
                :image,
                :is_active
            );
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':is_active', $data['is_active']);

        $stmt->execute();
    }

    public function update(int $id, array $data): array
    {
        $sql = "UPDATE products SET name = :name, description = :description, stock = :stock, price = :price, is_active = :is_active WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id); 
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':is_active', $data['is_active']);


        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function destroy(int $id): void
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}