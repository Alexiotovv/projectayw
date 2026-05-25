<?php

namespace App\Providers;

use App\Models\ServicePlan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

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
        View::composer('bases.public_home', function ($view) {
            $publicServiceTypes = ServicePlan::query()
                ->where('is_active', true)
                ->whereNotNull('type')
                ->distinct()
                ->orderBy('type')
                ->pluck('type')
                ->filter()
                ->map(function ($type) {
                    $type = Str::of($type)->lower()->value();

                    return [
                        'slug' => $type,
                        'label' => Str::headline(str_replace('-', ' ', $type)),
                    ];
                })
                ->values()
                ->all();

            $view->with('publicServiceTypes', $publicServiceTypes);
        });
    }
}
