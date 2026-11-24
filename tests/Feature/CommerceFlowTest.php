<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    $this->get(route('admin.dashboard'))
        ->assertSuccessful()
        ->assertSee($product->image_url, false);

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

test('admins can see and update user profiles without changing customer roles', function () {
    Storage::fake('public');
    $customer = User::factory()->create([
        'name' => 'Original Customer',
        'email' => 'original-customer@example.com',
        'address' => 'Old customer address',
    ]);
    $admin = User::factory()->admin()->create();
    $anotherCustomer = User::factory()->create();

    $this->actingAs($anotherCustomer)
        ->get(route('admin.users.index'))
        ->assertForbidden();

    $this->patch(route('admin.users.update', $customer), [
        'name' => 'Unauthorized Change',
        'email' => 'unauthorized@example.com',
        'address' => 'Unauthorized address',
    ])->assertForbidden();

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertSuccessful()
        ->assertSee($customer->email)
        ->assertSee($customer->address)
        ->assertSee(route('admin.users.edit', $customer))
        ->assertSee(route('admin.users.restriction', $customer))
        ->assertDontSee(route('admin.users.restriction', $admin));

    $this->get(route('admin.users.edit', $customer))
        ->assertSuccessful()
        ->assertSee($customer->address);

    $this->patch(route('admin.users.update', $customer), [
        'name' => 'Updated Customer',
        'email' => 'updated-customer@example.com',
        'address' => 'New customer address',
        'is_admin' => true,
        'avatar' => UploadedFile::fake()->image('managed-profile.png'),
    ])
        ->assertRedirect(route('admin.users.edit', $customer))
        ->assertSessionHas('admin_status', 'User profile updated.');

    $updatedCustomer = $customer->fresh();

    expect($updatedCustomer->name)->toBe('Updated Customer')
        ->and($updatedCustomer->email)->toBe('updated-customer@example.com')
        ->and($updatedCustomer->address)->toBe('New customer address')
        ->and($updatedCustomer->is_admin)->toBeFalse()
        ->and($updatedCustomer->avatar_path)->not->toBeNull();

    Storage::disk('public')->assertExists($updatedCustomer->avatar_path);
});

test('admins can restrict and restore customer accounts', function () {
    $customer = User::factory()->create([
        'email' => 'restricted-customer@example.com',
        'password' => 'customer-password',
    ]);
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.restriction', $customer))
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('admin_status', 'Customer account restricted.');

    expect($customer->fresh()->is_banned)->toBeTrue();

    $this->actingAs($customer)
        ->get(route('profile'))
        ->assertRedirect(route('login'))
        ->assertGuest();

    $this->post(route('login.submit'), [
        'email' => 'restricted-customer@example.com',
        'password' => 'customer-password',
    ])->assertSessionHasErrors('email');
    $this->assertGuest();

    $this->actingAs($admin)
        ->patch(route('admin.users.restriction', $customer))
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('admin_status', 'Customer account restored.');

    expect($customer->fresh()->is_banned)->toBeFalse();

    $this->post(route('login.submit'), [
        'email' => 'restricted-customer@example.com',
        'password' => 'customer-password',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($customer);
});

test('admins can remove customers without deleting their order history', function () {
    Storage::fake('public');
    $avatarPath = 'avatars/customer-profile.png';
    Storage::disk('public')->put($avatarPath, 'profile image');
    $customer = User::factory()->create(['avatar_path' => $avatarPath]);
    $order = Order::factory()->for($customer)->create();
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $customer))
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('admin_status', 'Customer account removed. Existing order history was preserved.');

    $this->assertModelMissing($customer);
    Storage::disk('public')->assertMissing($avatarPath);

    expect($order->fresh()->user_id)->toBeNull();
});

test('admins cannot restrict or remove users with the same or higher role', function () {
    $admin = User::factory()->admin()->create();
    $anotherAdmin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.restriction', $anotherAdmin))
        ->assertForbidden();

    $this->delete(route('admin.users.destroy', $anotherAdmin))
        ->assertForbidden();

    $this->assertModelExists($anotherAdmin);
    expect($anotherAdmin->fresh()->is_admin)->toBeTrue()
        ->and($anotherAdmin->fresh()->is_banned)->toBeFalse();
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

test('admins can mark pending orders as taken', function () {
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
        ->get(route('admin.dashboard'))
        ->assertSuccessful()
        ->assertSee('Taken / Done');

    $this->patch(route('admin.orders.status', $order), ['status' => 'completed'])
        ->assertRedirect();

    expect($order->fresh()->status)->toBe('completed')
        ->and($order->fresh()->payment_status)->toBe('paid');
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

test('customers can update their name and email without changing admin access', function () {
    $customer = User::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com',
    ]);

    $this->actingAs($customer)
        ->patch(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'is_admin' => true,
            'phone' => '+628123456789',
        ])
        ->assertRedirect(route('profile'))
        ->assertSessionHas('status', 'Profil berhasil diperbarui.');

    expect($customer->fresh()->name)->toBe('Updated Name')
        ->and($customer->fresh()->email)->toBe('updated@example.com')
        ->and($customer->fresh()->is_admin)->toBeFalse();
});

test('customers cannot change their email to another customers email', function () {
    $customer = User::factory()->create(['email' => 'customer@example.com']);
    $anotherCustomer = User::factory()->create(['email' => 'taken@example.com']);

    $this->actingAs($customer)
        ->patch(route('profile.update'), [
            'name' => 'Changed Name',
            'email' => $anotherCustomer->email,
        ])
        ->assertSessionHasErrors('email');

    expect($customer->fresh()->name)->not->toBe('Changed Name')
        ->and($customer->fresh()->email)->toBe('customer@example.com');
});

test('customers can save an address in their account profile', function () {
    $customer = User::factory()->create();

    $this->actingAs($customer)
        ->patch(route('profile.update'), [
            'section' => 'address',
            'address' => 'Jalan Melati No. 10, Jakarta',
        ])
        ->assertRedirect(route('profile', ['section' => 'address']))
        ->assertSessionHas('status', 'Profil berhasil diperbarui.');

    expect($customer->fresh()->address)->toBe('Jalan Melati No. 10, Jakarta');
});

test('customers can see only their own saved address', function () {
    $customer = User::factory()->create(['address' => 'First customer private address']);
    $anotherCustomer = User::factory()->create(['address' => 'Second customer private address']);

    $this->actingAs($anotherCustomer)
        ->get(route('profile', ['section' => 'address']))
        ->assertSuccessful()
        ->assertSee($anotherCustomer->address)
        ->assertDontSee($customer->address);
});

test('customers can upload a profile image which is stored on the public disk', function () {
    Storage::fake('public');
    $customer = User::factory()->create();

    $this->actingAs($customer)
        ->patch(route('profile.update'), [
            'section' => 'profile',
            'name' => $customer->name,
            'email' => $customer->email,
            'avatar' => UploadedFile::fake()->image('profile.png'),
        ])
        ->assertRedirect(route('profile'))
        ->assertSessionHas('status', 'Profil berhasil diperbarui.');

    $avatarPath = $customer->fresh()->avatar_path;

    expect($avatarPath)->not->toBeNull();
    Storage::disk('public')->assertExists($avatarPath);
});

test('customer account sections show their appropriate empty or placeholder states', function () {
    $customer = User::factory()->create();
    $this->actingAs($customer);

    $this->get(route('profile', ['section' => 'vouchers']))
        ->assertSuccessful()
        ->assertSee('Anda belum memiliki voucher saat ini.');

    $this->get(route('profile', ['section' => 'security']))
        ->assertSuccessful()
        ->assertSee('Placeholder coming soon.');

    $this->get(route('profile', ['section' => 'notifications']))
        ->assertSuccessful()
        ->assertSee('Placeholder coming soon.');
});

test('account pages require confirmation before submitting sign out forms', function () {
    $customer = User::factory()->create();

    $this->actingAs($customer)
        ->get(route('profile'))
        ->assertSuccessful()
        ->assertSee('data-confirm-submit', false)
        ->assertSee('data-confirm-dialog', false)
        ->assertSee('Are you sure you want to sign out?', false)
        ->assertSee('Stay signed in')
        ->assertSee('Profile');
});
