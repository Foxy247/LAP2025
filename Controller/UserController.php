<?php

namespace Controller;



use Model\User;
use Requests\UpdateUserRequest;

use Requests\CreateUserRequest;
use Middleware\IsAdmin;

class UserController
{

    public static function index(): array
    {
        IsAdmin::handle();
        $user = new User();
        return $user->index();
    }

    public static function create($data): array|bool
    {

        IsAdmin::handle();

        $errors = CreateUserRequest::validate($data);

        if (count($errors) > 0) {
            return $errors;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $data['is_admin'] = $data['is_admin'] == 'a' ? 1 : 0;

        $userModel = new User();
        $userModel->store($data);
        return true;
    }

    public static function update($id,$data) : array|bool
    {
        $errors = UpdateUserRequest::validate($data);

        if(count($errors) > 0) {
            return $errors;
        }

        $data['is_admin'] = $data['is_admin'] == 'a' ? 1 : 0;
        $data['is_active'] = $data['is_active'] == 'a' ? 1 : 0;

        $userModel = new User(); 
        $userModel->update_admin($id, $data);

        return true;
    }

    public static function delete($id) : void
    {
        $userModel = new User();
        $userModel->destroy($id);
    }

    public static function show($id) : array|bool
    {
        $userModel = new User();
        $user = $userModel->show($id);
        if(!$user){
            return false;
        }
        return $user; 

    }

    
}