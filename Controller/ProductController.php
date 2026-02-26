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

        $imageFile = $files['image'] ?? null;
        $errors = CreateProductRequest::validate($data, $imageFile);

        if (count($errors) > 0) {
            return $errors;
        } 


        $image = self::uploadImage($imageFile);

        $data['image'] = $image;

        $data['is_active'] = $data['is_active'] == 'a' ? 1 : 0;
        

        $productModel = new Product();

        $productModel->store($data);
        return true;
    }

    private static function uploadImage($imageFile)
    {
        if($imageFile == null) {
            return null;
        }
        $fileName = $imageFile['name'];
        $fileTmpName = $imageFile['tmp_name'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = dirname(__DIR__) . '/images/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            return $fileNameNew;


    }

    public static function update($id,$data, $files) : array|bool
    {
        IsAdmin::handle();

        $errors = UpdateProductRequest::validate($data);

        if(count($errors) > 0) {
            return $errors;
        }

        $data['is_active'] = $data['is_active'] == 'a' ? 1 : 0;

        $productModel = new Product();
        $existingProduct = $productModel->show($id);

        $imageFile = $files['image'] ?? null;

        if ($imageFile && $imageFile['error'] === 0) {
            $newImage = self::uploadImage($imageFile);

            if (!empty($existingProduct['image'])) {
                $oldImagePath = dirname(__DIR__) . '/images/' . $existingProduct['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $data['image'] = $newImage;
        }
 
        $productModel->update($id, $data);

        return true;
    }

    public static function delete($id) : void
    {
        $productModel = new Product();
        $product = $productModel->show($id);

        if ($product && !empty($product['image'])) {
            $imagePath = dirname(__DIR__) . '/images/' . $product['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $productModel->destroy($id);
    }


}