<?php

namespace App\Http\Controllers;

use App\Actions\UpdateOrderStatusAction;
use App\Actions\UpdateUserProfileAction;
use App\Http\Requests\UpdateCustomerProfileRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'products' => Product::query()->latest()->get(),
            'orders' => Order::query()->with('items')->latest()->take(10)->get(),
            'metrics' => [
                ['label' => 'Orders', 'value' => number_format(Order::query()->count())],
                ['label' => 'Products', 'value' => number_format(Product::query()->count())],
                ['label' => 'Low stock', 'value' => number_format(Product::query()->where('stock', '<', 6)->count())],
                ['label' => 'Awaiting pickup', 'value' => number_format(Order::query()->whereIn('status', ['pending', 'ready_for_pickup'])->count())],
            ],
            'topProducts' => OrderItem::query()
                ->selectRaw('product_id, SUM(quantity) as quantity_sold')
                ->whereNotNull('product_id')
                ->whereHas('order', fn ($query) => $query->whereNot('status', 'cancelled'))
                ->groupBy('product_id')
                ->orderByDesc('quantity_sold')
                ->with('product')
                ->take(3)
                ->get(),
        ]);
    }

    public function updateOrderStatus(
        UpdateOrderStatusRequest $request,
        Order $order,
        UpdateOrderStatusAction $updateOrderStatus,
    ): RedirectResponse {
        $updateOrderStatus->handle($order, $request->validated('status'));

        return back()->with('admin_status', 'Order status updated.');
    }

    public function usersIndex(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->orderBy('name')->paginate(20),
        ]);
    }

    public function editUser(User $user): View
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function updateUser(
        UpdateCustomerProfileRequest $request,
        User $user,
        UpdateUserProfileAction $updateUserProfile,
    ): RedirectResponse {
        $attributes = $request->validated();
        $avatar = $request->file('avatar');

        unset($attributes['avatar']);

        $updateUserProfile->handle($user, $attributes, $avatar);

        return redirect()
            ->route('admin.users.edit', $user)
            ->with('admin_status', 'User profile updated.');
    }

    public function toggleCustomerRestriction(User $user): RedirectResponse
    {
        abort_if($user->is_admin, 403);

        $user->is_banned = ! $user->is_banned;
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('admin_status', $user->is_banned ? 'Customer account restricted.' : 'Customer account restored.');
    }

    public function destroyCustomer(User $user): RedirectResponse
    {
        abort_if($user->is_admin, 403);

        $avatarPath = $user->avatar_path;

        if (! $user->delete()) {
            return back()->withErrors(['user' => 'The customer account could not be removed.']);
        }

        if ($avatarPath !== null && ! Storage::disk('public')->delete($avatarPath)) {
            Log::warning('Unable to delete a removed customer profile image.', [
                'user_id' => $user->id,
                'path' => $avatarPath,
            ]);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('admin_status', 'Customer account removed. Existing order history was preserved.');
    }
}
