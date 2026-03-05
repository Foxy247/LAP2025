<?php

namespace Requests;

class AddToCartRequest 
{
    private static array $errors = [];

    public static function validate(array $data): array 
    {
        if (empty($data['product_id']) || !is_numeric($data['product_id'])) {
            self::$errors['product_id'] = 'invalid product id';
        }

        if (empty($data['amount']) || !is_numeric($data['amount'])) {
            self::$errors['amount'] = 'Please enter in the correct quantity.';
        } elseif ((int)$data['amount'] < 1) {
            self::$errors['amount'] = 'The quantity must be at least 1.';
        }

        return self::$errors;
    }
}