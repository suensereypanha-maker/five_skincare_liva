<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index(): View
    {
        $cart = CartService::getCart();
        $subtotal = CartService::getSubtotal();
        $shipping = CartService::getShipping();
        $total = CartService::getTotal();

        return view('pages.checkout', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    /**
     * Process order submission.
     */
    public function process(Request $request): View|RedirectResponse
    {
        $cart = CartService::getCart();

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your shopping bag is empty.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:30',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|string|in:aba,acleda,canadia,wing,cod',
        ]);

        $orderId = 'LIVA-'.strtoupper(substr(uniqid(), -6)).'-'.date('d');
        $subtotal = CartService::getSubtotal();
        $shipping = CartService::getShipping();
        $total = CartService::getTotal();

        $order = [
            'order_id' => $orderId,
            'customer' => $validated,
            'items' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'created_at' => now()->format('M d, Y h:i A'),
        ];

        // Store last order in session
        session()->put('last_order', $order);

        // Clear cart after checkout
        CartService::clear();

        return redirect()->route('checkout.success')->with('success', "Order #{$orderId} placed successfully!");
    }

    /**
     * Display order success confirmation page.
     */
    public function success(): View|RedirectResponse
    {
        $order = session()->get('last_order');

        if (! $order) {
            return redirect()->route('shop.index');
        }

        return view('pages.checkout-success', [
            'order' => $order,
        ]);
    }
}
