<?php

namespace Requests;

class CreateUserRequest

{

    private static array $errors = [];

    public static function validate(array $data): array
    {
        if (empty($data['first_name'])) {
            self::$errors['first_name'] = 'First name is required';
        }

        if (empty($data['last_name'])) {
            self::$errors['last_name'] = 'Last name is required';
        }

        if (empty($data['email'])) {
            self::$errors['email'] = 'Email is required';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            self::$errors['email'] = 'Email is invalid';
        }

        if (empty($data['phone'])) {
            self::$errors['phone'] = 'Phone is required';
        }

        if (empty($data['password'])) {
            self::$errors['password'] = 'password is required';
        } else if (strlen($data['password']) < 8) {
            self::$errors['password'] = 'password must be at least 8 characters';
        }

        if (empty($data['is_admin'])) {
            self::$errors['is_admin'] = 'is_admin is required';
        } else if ($data['is_admin'] != 'u' && $data['is_admin'] != 'a' )
        {
            self::$errors['is_admin'] = 'is_admin must be 0 or 1'; 
        }

        return self::$errors;
    }
}