<?php

namespace Requests;

class CreateProductRequest

{

    private static array $errors = [];

    public static function validate(array $data, $file = null): array
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


        if(in_array($file['ex'], ['jpg', 'jpeg', 'png'])) {
            self::$errors['image'] = 'File should be an Image';
        } else if ($file['size'] && $file['size'] > 1000000) {
            self::$errors['image'] = 'Image is too large';
        }

        if (empty($data['is_active'])) {
            self::$errors['is_active'] = 'Availability is required';
        } else if ($data['is_active'] != 'i' && $data['is_active'] != 'a' )
        {
            self::$errors['is_active'] = 'Availability must be set'; 
        }
        

        return self::$errors;
    }
}