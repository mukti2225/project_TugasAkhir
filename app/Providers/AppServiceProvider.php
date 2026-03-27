<?php

namespace App\Providers;

use App\Models\Artikel;
use App\Models\Gallery;
use App\Models\HeroSlider;
use App\Models\KategoriArtikel;
use App\Models\Pengumuman;
use App\Models\Ptn;
use App\Models\Statistik;
use App\Models\User;
use App\Policies\ArtikelPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\HeroSliderPolicy;
use App\Policies\KategoriArtikelPolicy;
use App\Policies\PengumumanPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PtnPolicy;
use App\Policies\RolePolicy;
use App\Policies\StatistikPolicy;
use App\Policies\UserPolicy;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Artikel::class, ArtikelPolicy::class);
        Gate::policy(KategoriArtikel::class, KategoriArtikelPolicy::class);
        Gate::policy(Ptn::class, PtnPolicy::class);
        Gate::policy(HeroSlider::class, HeroSliderPolicy::class);
        Gate::policy(Gallery::class, GalleryPolicy::class);
        Gate::policy(Statistik::class, StatistikPolicy::class);
        Gate::policy(Pengumuman::class, PengumumanPolicy::class);
    }
}
