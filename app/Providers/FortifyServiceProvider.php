<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Models\Content;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $selectCotent = ['description', 'h1_title', 'meta_title', 'meta_description', 'meta_keyword', 'meta_card'];

        Fortify::loginView(function () use ($selectCotent) {
            $row = Content::select($selectCotent)->where('slug', 'login')->where('status', 'active')->first();
            if (empty($row)) {
                return redirect()->to('/');
            }
            $data['row'] = $row;
            return view('auth.login', $data);
        });

        Fortify::registerView(function () use ($selectCotent) {
            $row = Content::select($selectCotent)->where('slug', 'register')->where('status', 'active')->first();
            if (empty($row)) {
                return redirect()->to('/');
            }
            $data['row'] = $row;
            return view('auth.register', $data);
        });

        Fortify::requestPasswordResetLinkView(function () use ($selectCotent) {
            $row = Content::select($selectCotent)->where('slug', 'forgot-password')->where('status', 'active')->first();
            if (empty($row)) {
                return redirect()->to('/');
            }
            $data['row'] = $row;
            return view('auth.forgot-password', $data);
        });

        Fortify::resetPasswordView(function ($request)  use ($selectCotent) {
            $row = Content::select($selectCotent)->where('slug', 'reset-password')->where('status', 'active')->first();
            if (empty($row)) {
                return redirect()->to('/');
            }
            $data['row'] = $row;
            $data['request'] = $request;
            return view('auth.reset-password', $data);
        });


        Fortify::verifyEmailView(function ($request)  use ($selectCotent) {
            $row = Content::select($selectCotent)->where('slug', 'home')->where('status', 'active')->first();
            if (empty($row)) {
                return redirect()->to('/');
            }
            $data['row'] = $row;
            $data['request'] = $request;
            return view('auth.verify-email', $data);
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if (
                $user &&
                Hash::check($request->password, $user->password) && $user->status == 'active'
                && $user->user_type == 2
            ) {
                return $user;
            }
        });
    }
}
