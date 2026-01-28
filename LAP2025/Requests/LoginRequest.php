<?php

namespace Requests;


class LoginRequest
{
    private static array $errors = [];


    public static function validate(array $data): array
    {
        if (empty($data['email'])) {
            self::$errors['email'] = 'Email is required';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            self::$errors['email'] = 'Email is invalid';
        }

        if (empty($data['password'])) {
            self::$errors['password'] = 'password is required';
        }


        return self::$errors;
    }
}