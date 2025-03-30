<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('')
            ->login()
            ->colors([
                // 'danger' => Color::Rose,
                // 'gray' => Color::Gray,
                // 'info' => Color::Blue,
                // 'primary' => Color::Indigo,
                // 'success' => Color::Emerald,
                // 'warning' => Color::Orange,
                'primary' => '#FE4F2D',
                'success' => '#015551',
                'warning' => '#EAD196',
                'danger' => '#7D0A0A',
                'info' => '#57B4BA',

                'gray' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->maxContentWidth('full')
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('17rem')
            ->font('Tahoma')

            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Produk')
                    ->icon('heroicon-o-squares-2x2'),
                NavigationGroup::make()
                    ->label('Transaksi')
                    ->icon('heroicon-o-shopping-cart'),
                NavigationGroup::make()
                    ->label('Master Data')
                    ->icon('heroicon-o-building-office-2')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Setting')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
        ;
    }
}
