<?php

namespace App\Services;

class CartService
{
    /**
     * Session key for cart.
     */
    public const SESSION_KEY = 'liva_cart';

    /**
     * Get the cart items from session.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function getCart(): array
    {
        return session()->get(self::SESSION_KEY, []);
    }

    /**
     * Add product to cart.
     *
     * @return array<string, mixed>|null
     */
    public static function add(int|string $productId, int $quantity = 1): ?array
    {
        $product = ProductService::find($productId);

        if (! $product) {
            return null;
        }

        $cart = self::getCart();
        $key = (string) $product['id'];

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += max(1, $quantity);
        } else {
            $cart[$key] = [
                'id' => $product['id'],
                'slug' => $product['slug'],
                'name' => $product['name'],
                'category_name' => $product['category_name'],
                'price' => (float) $product['price'],
                'image' => $product['image'],
                'quantity' => max(1, $quantity),
            ];
        }

        session()->put(self::SESSION_KEY, $cart);

        return $cart[$key];
    }

    /**
     * Update product quantity in cart.
     */
    public static function update(int|string $productId, int $quantity): void
    {
        $cart = self::getCart();
        $key = (string) $productId;

        if (isset($cart[$key])) {
            if ($quantity <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['quantity'] = $quantity;
            }

            session()->put(self::SESSION_KEY, $cart);
        }
    }

    /**
     * Remove product from cart.
     */
    public static function remove(int|string $productId): void
    {
        $cart = self::getCart();
        $key = (string) $productId;

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put(self::SESSION_KEY, $cart);
        }
    }

    /**
     * Clear all items in cart.
     */
    public static function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Get total quantity of items in cart.
     */
    public static function getCount(): int
    {
        $cart = self::getCart();
        $count = 0;

        foreach ($cart as $item) {
            $count += (int) ($item['quantity'] ?? 1);
        }

        return $count;
    }

    /**
     * Get subtotal of cart.
     */
    public static function getSubtotal(): float
    {
        $cart = self::getCart();
        $subtotal = 0.0;

        foreach ($cart as $item) {
            $subtotal += ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 1));
        }

        return round($subtotal, 2);
    }

    /**
     * Get shipping fee.
     * Free shipping over $50, otherwise $5.00 ($0 if cart empty).
     */
    public static function getShipping(): float
    {
        $subtotal = self::getSubtotal();

        if ($subtotal <= 0) {
            return 0.0;
        }

        return $subtotal >= 50.0 ? 0.0 : 5.0;
    }

    /**
     * Get total (subtotal + shipping).
     */
    public static function getTotal(): float
    {
        return round(self::getSubtotal() + self::getShipping(), 2);
    }
}
