<?php

namespace App\Providers;

use App\Models\Partner;
use App\Models\Program;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        // Share all programs with the frontend layout (used by the navbar dropdown)
        View::composer('frontend.layouts.base', function ($view): void {
            $view->with('navPrograms', Program::query()
                ->select('id', 'title', 'slug')
                ->latest()
                ->get());
        });

        // Share the partner directory with the detail-page partner card
        View::composer('frontend.inc.partnersCard', function ($view): void {
            $view->with('partners', Partner::query()
                ->select('id', 'name', 'website_url')
                ->latest()
                ->get());
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
