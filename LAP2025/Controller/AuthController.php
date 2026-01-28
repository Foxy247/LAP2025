<?php

namespace Controller;


use Requests\RegisterUserRequest;
use Requests\LoginRequest;
use Model\User;

class AuthController
{
    //REGISTER
    public static function register($data): array|bool
    {
        $errors = RegisterUserRequest::validate($data);

        if (count($errors) > 0) {
            return $errors;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $userModel = new User();
        $userModel->store($data);
        return true;
    }

    // LOGIN
    public static function login($data): array|bool
    {
        $errors = LoginRequest::validate($data);

        if (count($errors) > 0) {
            return $errors;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($data['email']);
 
        if (!$user) {
            $errors['email'] = 'Email is not registered';
            return $errors;
        }

        if (!password_verify($data['password'], $user['password'])) {
            $errors['password'] = 'Password is incorrect';
            return $errors;
        }

        unset($user['password']);
        $_SESSION['user'] = $user;
        return true;
    }
    //LOGOUT
    public static function logout(): void
    {
        session_destroy();
    }

}