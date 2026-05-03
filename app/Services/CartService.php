<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    protected const SESSION_KEY = 'cart';

    public function getCart(): array
    {
        return session(self::SESSION_KEY, []);
    }

    public function getTotalItems(): int
    {
        return array_sum(array_column($this->getCart(), 'quantity'));
    }

    public function getGrandTotal(): int
    {
        return array_sum(array_column($this->getCart(), 'subtotal'));
    }

    public function addItem(int $productId, int $quantity = 1): void
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        if (isset($cart[$productId])) {
            $newQty = $cart[$productId]['quantity'] + $quantity;
            $cart[$productId]['quantity'] = min($newQty, $product->stock);
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name'       => $product->name,
                'price'      => $product->price,
                'image_url'  => $product->image_url,
                'quantity'   => min($quantity, $product->stock),
                'subtotal'   => $product->price * min($quantity, $product->stock),
            ];
        }

        session([self::SESSION_KEY => $cart]);
    }

    public function updateItem(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->removeItem($productId);
            return;
        }

        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return;
        }

        $product = Product::find($productId);
        $qty = $product ? min($quantity, $product->stock) : $quantity;

        $cart[$productId]['quantity'] = $qty;
        $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $qty;

        session([self::SESSION_KEY => $cart]);
    }

    public function removeItem(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        session([self::SESSION_KEY => $cart]);
    }

    public function clearCart(): void
    {
        session()->forget(self::SESSION_KEY);
    }
}
