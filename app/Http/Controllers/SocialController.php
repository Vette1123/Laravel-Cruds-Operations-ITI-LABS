<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $gitHubInfo = Socialite::driver($provider)->user();
        $user = $this->getUser($gitHubInfo, $provider);
        auth()->login($user);
        return redirect()->to('/posts');
    }

    public function getUser($gitHubInfo, $provider)
    {
        $user = User::where('github_id', $gitHubInfo->id)->first() ? User::where('github_id', $gitHubInfo->id)->first() : User::where('email', $gitHubInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $gitHubInfo->name,
                'email' => $gitHubInfo->email,
                // 'github_id' => $gitHubInfo->id,
                'password' => '12345678',
                'github_token' => $gitHubInfo->token,
            ]);
        }
        return $user;
    }
}
