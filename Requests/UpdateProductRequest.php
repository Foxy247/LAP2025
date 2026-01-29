<?php

namespace Requests;

class UpdateProductRequest

{

    private static array $errors = [];

    public static function validate(array $data): array
    {
        if (empty($data['name'])) {
            self::$errors['name'] = 'Product name is required';
        }

        if (empty($data['description'])) {
            self::$errors['description'] = 'Description is required';
        }

        if (empty($data['stock']) && $data['stock'] !== '0') {
            self::$errors['stock'] = 'Stock is required';
        } else if (!is_numeric($data['stock'])) {
            self::$errors['stock'] = 'Stock must be a number';
        }

        if (empty($data['price'])) {
            self::$errors['price'] = 'Price is required';
        } else if (!is_numeric($data['price'])) {
            self::$errors['price'] = 'Price must be a number';
        } else if ($data['price'] <= 0) {
            self::$errors['price'] = 'Price must be greater than 0';
        }
        
        if (empty($data['is_active'])) {
            self::$errors['is_active'] = 'is_active is required';
        } else if ($data['is_active'] != 'i' && $data['is_active'] != 'a' )
        {
            self::$errors['is_active'] = 'is_active must be 0 or 1'; 
        }

        return self::$errors;
    }
}