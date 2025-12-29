<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in.
     */
    public function callback(): RedirectResponse
    {
        $driver = Socialite::driver('google');
        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $googleUser = $driver->stateless()->user();

        $email = $googleUser->getEmail();
        if (! $email) {
            return redirect()->route('login')->withErrors(['email' => 'Google account did not provide an email address.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
                'email' => $email,
                'password' => Str::random(24),
            ]);
            $user->email_verified_at = now();
            $user->save();
        } else {
            if (! $user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
            }
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
