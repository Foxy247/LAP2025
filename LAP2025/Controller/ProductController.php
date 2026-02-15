<?php

namespace Controller;



use Model\Product;
use Requests\UpdateProductRequest;

use Requests\CreateProductRequest;
use Middleware\IsAdmin;

class ProductController
{

    public static function index(): array
    {
        IsAdmin::handle();
        $product = new Product();
        return $product->index();
    }

    public static function create($data, $files): array|bool
    {

        IsAdmin::handle();

        $errors = CreateProductRequest::validate($data);

        if (count($errors) > 0) {
            return $errors;
        } 


        $data['is_active'] = $data['is_active'] == 'a' ? 1 : 0;

        $productModel = new Product();
        $productModel->store($data);
        return true;
    }

    public static function update($id,$data) : array|bool
    {
        IsAdmin::handle();

        $errors = UpdateProductRequest::validate($data);

        if(count($errors) > 0) {
            return $errors;
        }

        $data['is_active'] = $data['is_active'] == 'a' ? 1 : 0;

        $productModel = new Product(); 
        $productModel->update($id, $data);

        return true;
    }

    public static function delete($id) : void
    {
        $productModel = new Product();
        $productModel->destroy($id);
    }

    public static function show($id) : array|bool
    {
        $productModel = new Product();
        $product = $productModel->show($id);
        if(!$product){
            return false;
        }
        return $product; 

    }

    
}