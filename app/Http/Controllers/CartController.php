<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the shopping cart page.
     */
    public function index(): View
    {
        $cart = CartService::getCart();
        $subtotal = CartService::getSubtotal();
        $shipping = CartService::getShipping();
        $total = CartService::getTotal();
        $count = CartService::getCount();

        return view('pages.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'count' => $count,
        ]);
    }

    /**
     * Add an item to the shopping cart.
     */
    public function add(Request $request): RedirectResponse|JsonResponse
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        if (! $productId) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Product ID is required.'], 422);
            }

            return redirect()->back()->with('error', 'Product not found.');
        }

        $item = CartService::add($productId, $quantity);

        if (! $item) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
            }

            return redirect()->back()->with('error', 'Product not found.');
        }

        $message = "Added {$item['name']} to your bag!";

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => CartService::getCount(),
                'cart_subtotal' => CartService::getSubtotal(),
                'item' => $item,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Update items in the cart.
     */
    public function update(Request $request): RedirectResponse
    {
        $quantities = $request->input('quantities', []);

        if (is_array($quantities)) {
            foreach ($quantities as $productId => $qty) {
                CartService::update($productId, (int) $qty);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Your bag has been updated.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        CartService::remove($id);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from bag.',
                'cart_count' => CartService::getCount(),
                'cart_subtotal' => CartService::getSubtotal(),
                'total' => CartService::getTotal(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from your bag.');
    }

    /**
     * Clear all items from the cart.
     */
    public function clear(): RedirectResponse
    {
        CartService::clear();

        return redirect()->route('cart.index')->with('success', 'Your bag has been cleared.');
    }
}
