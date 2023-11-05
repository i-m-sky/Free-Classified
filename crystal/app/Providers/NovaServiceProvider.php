<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Illuminate\Support\Facades\Blade;

use Laravel\Nova\Dashboards\Main;
use App\Nova\State;
use App\Nova\City;
use App\Nova\Locality;
use App\Nova\Content;
use App\Nova\EmailTemplate;
use App\Nova\Category;
use App\Nova\Member;
use App\Nova\Post;
use App\Nova\Setting;
use App\Nova\StaySafe;
use App\Nova\User;
use App\Nova\ReportPost;
use App\Nova\ReportUser;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                // MenuSection::make('Customers', [
                //     MenuItem::resource(User::class),
                //     MenuItem::resource(License::class),
                // ])->icon('user')->collapsable(),
                MenuSection::resource(Post::class),
                MenuSection::resource(Member::class)->icon('user'),

                MenuSection::make('Report', [
                    MenuItem::resource(ReportPost::class),
                    MenuItem::resource(ReportUser::class),

                ])->icon('map')->collapsable(),


                MenuSection::resource(Category::class),
                MenuSection::resource(Content::class),
                MenuSection::resource(EmailTemplate::class),
                MenuSection::resource(StaySafe::class),


                MenuSection::make('Locations', [
                    MenuItem::resource(State::class),
                    MenuItem::resource(City::class),
                    MenuItem::resource(Locality::class),
                ])->icon('map')->collapsable(),
                MenuSection::resource(User::class)->icon('user'),
                MenuSection::resource(Setting::class)->icon('setting'),
            ];
        });

        Nova::footer(function ($request) {
            return Blade::render('
            <p  class="text-center">
            &copy 2023 Khoj Bro
                </p>
        ');
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
