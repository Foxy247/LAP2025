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

        $_SESSION['cart'][$product['id']] = $amount;

        return true;
    }

    public static function showCartProduct()
    {
        if (empty($_SESSION['cart'])) {
            return [];
        }

        $products = [];

        // Hole alle IDs aus der Session 
        $ids = array_keys($_SESSION['cart']);


        $productModel = new Product();
        $dbProducts = $productModel->getByIds($ids);

        // Quantity aus der Session zu den Produkten aus der DB hinzufügen 
        foreach ($dbProducts as &$product) { //& Damit mit dem Original und nicht der Kopie gearbeitet wird 
            $product['quantity'] = $_SESSION['cart'][$product['id']] ?? 0;
        }
        unset($product); //product entfernen, damit das letzte Element nicht versehentlich später geändert werden kann. 


        return $dbProducts;
    }

    
}
