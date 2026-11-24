<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class UpdateUserProfileAction
{
    /**
     * @param  array{name?: string, email?: string, address?: string|null}  $attributes
     */
    public function handle(User $user, array $attributes, ?UploadedFile $avatar = null): void
    {
        $previousAvatarPath = $user->avatar_path;

        if ($avatar !== null) {
            $avatarPath = $avatar->store('avatars', 'public');

            if ($avatarPath === false) {
                throw new RuntimeException('Unable to store the uploaded profile image.');
            }

            $attributes['avatar_path'] = $avatarPath;
        }

        $user->update($attributes);

        if ($avatar !== null && $previousAvatarPath !== null && ! Storage::disk('public')->delete($previousAvatarPath)) {
            Log::warning('Unable to delete a previous profile image.', [
                'user_id' => $user->id,
                'path' => $previousAvatarPath,
            ]);
        }
    }
}
