<?php

namespace App\Http\Controllers;

use App\Actions\UpdateUserProfileAction;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountOrderController extends Controller
{
    public function profile(): View
    {
        $availableSections = ['profile', 'orders', 'address', 'vouchers', 'security', 'notifications'];
        $section = request()->query('section');
        $section = in_array($section, $availableSections, true) ? $section : 'profile';

        return view('profile', [
            'section' => $section,
            'orders' => $section === 'orders'
                ? auth()->user()->orders()->with('items')->latest()->paginate(10)
                : collect(),
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request, UpdateUserProfileAction $updateUserProfile): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        $section = $validated['section'] ?? 'profile';
        $avatar = $request->file('avatar');

        unset($validated['avatar'], $validated['section']);

        $updateUserProfile->handle($user, $validated, $avatar);

        return redirect()
            ->route('profile', $section === 'profile' ? [] : ['section' => $section])
            ->with('status', 'Profil berhasil diperbarui.');
    }

    public function index(): View
    {
        return redirect()->route('profile', ['section' => 'orders']);
    }

    public function show(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('orders.show', ['order' => $order->load('items')]);
    }
}
