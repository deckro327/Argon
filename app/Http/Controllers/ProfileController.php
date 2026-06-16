<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                if (str_starts_with($user->profile_image, 'img/')) {
                    File::delete(public_path($user->profile_image));
                } else {
                    Storage::disk('public')->delete($user->profile_image);
                }
            }

            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $fileName = $user->id . '-' . time() . '.' . $extension;
            $directory = public_path('img/profile_images');

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $file->move($directory, $fileName);
            $user->profile_image = 'img/profile_images/' . $fileName;
        }
        
        $user->save();
        return Redirect::route('profile.edit')->with('updated', 'Perfil actualizado correctamente.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        /** @var User $user */
        $user = $request->user();

        Auth::logout();

        DB::table('users')->where('id', $user->id)->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
