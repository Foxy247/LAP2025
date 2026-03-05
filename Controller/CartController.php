<?php

namespace Controller;

use Model\Product;
use Requests\AddToCartRequest;

class CartController
{
    public static function addProduct(array $data): array|bool
    {
        $errors = AddToCartRequest::validate($data);
        if (count($errors) > 0) {
            return $errors;
        }

        $productModel = new Product();
        $product = $productModel->show((int)$data['product_id']);

        // Gibt es das Produkt? 
        if (!$product) {
            return ['product_id' => 'Product not found.'];
        }

        // Ist das Produkt verfügbar? 
        if (!$product['is_active']) {
        return ['product_id' => 'Product is not available.'];
        }

        // Ist die Menge gültig? 
        $amount = (int) $data['amount'];
        if ($amount > $product['stock']) {
            return ['amount' => 'invalid amount'];
        }

        $_SESSION['cart'][] = [
            'product_id' => $product['id'],
            'amount' => $amount,
        ];

        return true;

    }
}

