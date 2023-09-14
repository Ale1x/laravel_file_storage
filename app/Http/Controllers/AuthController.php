<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['repo', 'write:repo_hook'])->redirect();
    }

    public function handleProviderCallback() {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'password' => Hash::make(Str::random(24)),
        ]);

        Auth::login($user);

        return redirect('/upload');
    }
}
