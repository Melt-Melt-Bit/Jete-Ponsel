<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('a guest can place a pickup order using the live product price and stock', function () {
    $product = Product::factory()->create([
        'brand' => 'Samsung',
        'name' => 'Galaxy A17 5G',
        'price' => 5_299_000,
        'stock' => 5,
    ]);

    $this->post(route('cart.store', $product), ['quantity' => 2])
        ->assertRedirect(route('cart.index'));

    $product->update(['price' => 5_499_000]);

    $this->get(route('cart.index'))
        ->assertSuccessful()
        ->assertSee('Samsung')
        ->assertSee('Galaxy A17 5G')
        ->assertSee('Rp5.499.000');

    $this->get(route('checkout.create'))
        ->assertSuccessful()
        ->assertSee('Online payment');

    $this->post(route('checkout.store'), [
        'customer_name' => 'Nadia Putri',
        'customer_email' => 'nadia@example.com',
        'customer_phone' => '+628123456789',
        'payment_method' => 'online',
    ])->assertSessionHasErrors('payment_method');

    $this->assertDatabaseCount('orders', 0);

    $this->post(route('checkout.store'), [
        'customer_name' => 'Nadia Putri',
        'customer_email' => 'nadia@example.com',
        'customer_phone' => '+628123456789',
        'payment_method' => 'pay_at_pickup',
    ])->assertSessionHasNoErrors();

    $order = Order::query()->with('items')->sole();

    expect($order->user_id)->toBeNull()
        ->and($order->subtotal)->toBe(10_998_000)
        ->and($order->payment_status)->toBe('unpaid')
        ->and($order->items)->toHaveCount(1)
        ->and($order->items->sole()->product_name)->toBe('Samsung Galaxy A17 5G')
        ->and($order->items->sole()->quantity)->toBe(2)
        ->and($product->fresh()->stock)->toBe(3);

    expect($this->app['session.store']->has('cart.products'))->toBeFalse();
    $this->get(route('orders.confirmation', $order->order_number))
        ->assertSuccessful()
        ->assertSee($order->order_number)
        ->assertSee('Pay at the store');
});

test('authenticated customers can see only their own orders', function () {
    $customer = User::factory()->create();
    $otherCustomer = User::factory()->create();
    $order = Order::factory()->for($customer)->create();
    $otherOrder = Order::factory()->for($otherCustomer)->create();

    $this->actingAs($customer)
        ->get(route('account.orders.index'))
        ->assertSuccessful()
        ->assertSee($order->order_number)
        ->assertDontSee($otherOrder->order_number);

    $this->get(route('account.orders.show', $order))->assertSuccessful();
    $this->get(route('account.orders.show', $otherOrder))->assertForbidden();
});

test('only admins can manage products', function () {
    $product = Product::factory()->create();
    $admin = User::factory()->admin()->create();
    $attributes = [
        'sku' => 'NEW-SKU-001',
        'brand' => 'Apple',
        'name' => 'iPhone 17',
        'category' => 'phone',
        'description' => 'Updated product details.',
        'price' => 16_999_000,
        'stock' => 4,
        'badge' => 'Popular',
        'image_path' => 'resources/images/phones/Iphone 17.png',
    ];

    $this->put(route('admin.products.update', $product), $attributes)
        ->assertRedirect(route('login'));

    $this->actingAs(User::factory()->create())
        ->get(route('admin.dashboard'))
        ->assertForbidden();

    $this->actingAs($admin)
        ->post(route('admin.products.store'), [...$attributes, 'sku' => 'CREATED-SKU-001'])
        ->assertRedirect();

    $createdProduct = Product::query()->where('sku', 'CREATED-SKU-001')->sole();
    $this->assertModelExists($createdProduct);

    $this->actingAs($admin)
        ->put(route('admin.products.update', $product), $attributes)
        ->assertRedirect();

    expect($product->fresh()->sku)->toBe('NEW-SKU-001')
        ->and($product->fresh()->price)->toBe(16_999_000);

    $this->patch(route('admin.products.visibility', $product))
        ->assertRedirect();

    expect($product->fresh()->is_active)->toBeFalse();
    $this->get(route('products.show', $product))->assertNotFound();

    $this->delete(route('admin.products.destroy', $product))
        ->assertRedirect();

    $this->assertModelMissing($product);
    $this->assertModelExists($createdProduct);
});

test('completed pickup orders are marked paid', function () {
    $product = Product::factory()->create(['stock' => 3]);
    $admin = User::factory()->admin()->create();

    $this->post(route('cart.store', $product), ['quantity' => 1]);
    $this->post(route('checkout.store'), [
        'customer_name' => 'Dimas Pratama',
        'customer_email' => 'dimas@example.com',
        'customer_phone' => '+628123456789',
        'payment_method' => 'pay_at_pickup',
    ]);

    $order = Order::query()->sole();

    $this->actingAs($admin)
        ->patch(route('admin.orders.status', $order), ['status' => 'ready_for_pickup'])
        ->assertRedirect();
    $this->patch(route('admin.orders.status', $order), ['status' => 'completed'])
        ->assertRedirect();

    expect($order->fresh()->payment_status)->toBe('paid');
});

test('customers can sign in with their account', function () {
    $user = User::factory()->create([
        'email' => 'customer@example.com',
        'password' => 'customer-password',
    ]);

    $this->post(route('login.submit'), [
        'email' => 'customer@example.com',
        'password' => 'customer-password',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($user);
});

test('admins can advance and cancel orders with inventory restored on cancellation', function () {
    $product = Product::factory()->create(['stock' => 3]);
    $admin = User::factory()->admin()->create();

    $this->post(route('cart.store', $product), ['quantity' => 2]);
    $this->post(route('checkout.store'), [
        'customer_name' => 'Dimas Pratama',
        'customer_email' => 'dimas@example.com',
        'customer_phone' => '+628123456789',
        'payment_method' => 'pay_at_pickup',
    ]);

    $order = Order::query()->sole();
    expect($product->fresh()->stock)->toBe(1);

    $this->actingAs($admin)
        ->patch(route('admin.orders.status', $order), ['status' => 'cancelled'])
        ->assertRedirect();

    expect($order->fresh()->status)->toBe('cancelled')
        ->and($product->fresh()->stock)->toBe(3);

    $this->patch(route('admin.orders.status', $order), ['status' => 'ready_for_pickup'])
        ->assertSessionHasErrors('status');
});

test('registration creates a customer account and never grants admin access', function () {
    $this->post(route('register.submit'), [
        'name' => 'Salsa Amalia',
        'email' => 'salsa@example.com',
        'password' => 'correct-horse-battery',
        'password_confirmation' => 'correct-horse-battery',
        'is_admin' => true,
    ])->assertRedirect(route('home'));

    $user = User::query()->sole();

    expect($user->is_admin)->toBeFalse()
        ->and(Hash::check('correct-horse-battery', $user->password))->toBeTrue();

    $this->assertAuthenticatedAs($user);
});
