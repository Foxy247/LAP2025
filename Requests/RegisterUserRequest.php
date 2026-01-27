<?php

namespace Requests;

class RegisterUserRequest

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

        return self::$errors;
    }
}