<?php

namespace Tests\Feature;

use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SkincareEcomTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_skincare_categories_and_products(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Hair Care');
        $response->assertSee('Body Wash & Lotion');
        $response->assertSee('Facial Care & Serums');
        $response->assertSee('LIVA Balancing Shampoo');
        $response->assertSee('LIVA Nourishing Conditioner');
        $response->assertSee('LIVA Botanical Daily Edit');
        $response->assertDontSee('Fresh Meat');
        $response->assertDontSee('Vegetables');
    }

    public function test_shop_page_displays_skincare_departments_and_supports_filtering(): void
    {
        $response = $this->get(route('shop.index'));

        $response->assertStatus(200);
        $response->assertSee('All Botanical Products');
        $response->assertSee('Hair Care & Scalp');
        $response->assertDontSee('Fresh Meat');
        $response->assertDontSee('Fruit & Nut Gifts');

        // Test Category filter
        $haircareResponse = $this->get(route('shop.index', ['category' => 'haircare']));
        $haircareResponse->assertStatus(200);
        $haircareResponse->assertSee('LIVA Balancing Shampoo');

        // Test Search filter
        $searchResponse = $this->get(route('shop.index', ['search' => 'shampoo']));
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('LIVA Balancing Shampoo');
    }

    public function test_product_detail_page_loads_with_correct_product(): void
    {
        $product = ProductService::getAllProducts()[0]; // LIVA Balancing Shampoo (id: 1)

        $response = $this->get(route('shop.show', $product['id']));

        $response->assertStatus(200);
        $response->assertSee($product['name']);
        $response->assertSee('$32.00');
        $response->assertSee('ADD TO BAG');
        $response->assertSee('How to Use');
        $response->assertSee($product['size']);
        $response->assertSee('Related Botanical Products');
    }

    public function test_can_add_to_cart_and_view_cart(): void
    {
        // Add product 1 to cart
        $response = $this->post(route('cart.add'), [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        $response->assertRedirect();
        $this->assertEquals(2, CartService::getCount());

        // View Cart
        $cartResponse = $this->get(route('cart.index'));
        $cartResponse->assertStatus(200);
        $cartResponse->assertSee('LIVA Balancing Shampoo');
        $cartResponse->assertSee('$64.00'); // 2 * $32.00
    }

    public function test_cart_add_endpoint_returns_json_without_redirect(): void
    {
        $response = $this->postJson(route('cart.add'), [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'cart_count' => 2,
                'cart_subtotal' => 64,
            ])
            ->assertJsonPath('item.name', 'LIVA Balancing Shampoo');
    }

    public function test_cart_quantity_update_and_removal(): void
    {
        // Add items
        CartService::add(1, 1);
        CartService::add(2, 1);
        $this->assertEquals(2, CartService::getCount());

        // Update quantity of product 1 to 3
        $this->post(route('cart.update'), [
            'quantities' => [
                1 => 3,
                2 => 1,
            ],
        ]);
        $this->assertEquals(4, CartService::getCount());

        // Remove product 2
        $this->delete(route('cart.remove', 2));
        $this->assertEquals(3, CartService::getCount());
    }

    public function test_checkout_process_creates_order_and_clears_cart(): void
    {
        // Add item to cart
        CartService::add(1, 2);

        // Checkout view
        $checkoutResponse = $this->get(route('checkout.index'));
        $checkoutResponse->assertStatus(200);
        $checkoutResponse->assertSee('LIVA Balancing Shampoo');

        // Submit order
        $orderData = [
            'first_name' => 'Sophia',
            'last_name' => 'Miller',
            'email' => 'sophia@example.com',
            'phone' => '+85512345678',
            'address' => '123 Botanical Avenue',
            'city' => 'Phnom Penh',
            'country' => 'Cambodia',
            'payment_method' => 'aba',
        ];

        $processResponse = $this->post(route('checkout.process'), $orderData);
        $processResponse->assertRedirect(route('checkout.success'));

        // Verify cart is cleared
        $this->assertEquals(0, CartService::getCount());

        // Verify success page
        $successResponse = $this->get(route('checkout.success'));
        $successResponse->assertStatus(200);
        $successResponse->assertSee('Thank You For Your Order!');
        $successResponse->assertSee('Sophia Miller');
        $successResponse->assertSee('ABA Mobile');
    }

    public function test_canadia_payment_displays_its_qr_code(): void
    {
        CartService::add(1, 1);

        $checkoutResponse = $this->get(route('checkout.index'));
        $checkoutResponse->assertOk();
        $checkoutResponse->assertSee('Canadia Bank KHQR');
        $checkoutResponse->assertSee('id="aba-qr-panel"', false);
        $checkoutResponse->assertSee('id="canadia-qr-panel"', false);
        $checkoutResponse->assertSee('id="acleda-qr-panel"', false);
        $checkoutResponse->assertSee('id="wing-qr-panel"', false);

        $processResponse = $this->post(route('checkout.process'), [
            'first_name' => 'Sophia',
            'last_name' => 'Miller',
            'email' => 'sophia@example.com',
            'phone' => '+85512345678',
            'address' => '123 Botanical Avenue',
            'city' => 'Phnom Penh',
            'country' => 'Cambodia',
            'payment_method' => 'canadia',
        ]);
        $processResponse->assertRedirect(route('checkout.success'));
        $this->assertSame('canadia', session('last_order.payment_method'));
        $this->assertSame(0, CartService::getCount());

        $successResponse = $this->get(route('checkout.success'));
        $successResponse->assertOk();
        $successResponse->assertSee('Canadia Mobile');
        $successResponse->assertSee('img/payments/canadia-khqr.png');
        $successResponse->assertDontSee('img/payments/aba-khqr.png');
    }

    #[DataProvider('paymentsUsingCanadiaKhqr')]
    public function test_acleda_and_wing_payments_display_the_shared_khqr_code(string $paymentMethod, string $bankName): void
    {
        CartService::add(1, 1);

        $processResponse = $this->post(route('checkout.process'), [
            'first_name' => 'Sophia',
            'last_name' => 'Miller',
            'email' => 'sophia@example.com',
            'phone' => '+85512345678',
            'address' => '123 Botanical Avenue',
            'city' => 'Phnom Penh',
            'country' => 'Cambodia',
            'payment_method' => $paymentMethod,
        ]);
        $processResponse->assertRedirect(route('checkout.success'));

        $successResponse = $this->get(route('checkout.success'));
        $successResponse->assertOk();
        $successResponse->assertSee($bankName);
        $successResponse->assertSee('img/payments/canadia-khqr.png');
    }

    public static function paymentsUsingCanadiaKhqr(): array
    {
        return [
            'ACLEDA' => ['acleda', 'ACLEDA Mobile'],
            'Wing' => ['wing', 'Wing Bank App'],
        ];
    }

    public function test_customer_registration_login_and_logout(): void
    {
        // Register
        $registerResponse = $this->post(route('register.submit'), [
            'name' => 'Emily Rose',
            'email' => 'emily@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $registerResponse->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'emily@example.com']);

        // Logout
        $logoutResponse = $this->post(route('logout'));
        $logoutResponse->assertRedirect(route('home'));
        $this->assertGuest();

        // Login
        $loginResponse = $this->post(route('login.submit'), [
            'email' => 'emily@example.com',
            'password' => 'secret123',
        ]);

        $loginResponse->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }
}
