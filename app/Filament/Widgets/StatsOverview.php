<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();
        $query = Submission::query();
        $totalServices = \App\Models\Service::count();
        $accessibleServicesCount = $totalServices;

        if (! $user->hasRole('super admin')) {
            // NEW APPROACH: Iterate Resources to find accessible Services
            // This is more robust than guessing permission names.
            $accessibleServiceSlugs = collect(\Filament\Facades\Filament::getResources())
                ->filter(function ($resource) {
                    // Only check resources that report they can be accessed
                    return $resource::canAccess();
                })
                ->map(function ($resource) {
                    // Get the URL slug of the resource
                    return $resource::getSlug();
                })
                ->filter(function ($slug) {
                    // Only include resources that look like submissions (e.g., 'cuti-submissions')
                    return \Illuminate\Support\Str::endsWith($slug, '-submissions');
                })
                ->map(function ($slug) {
                    // Extract the service slug (e.g., 'cuti')
                    return \Illuminate\Support\Str::replaceLast('-submissions', '', $slug);
                });

            // Find valid services matching these slugs
            $accessibleServices = \App\Models\Service::whereIn('slug', $accessibleServiceSlugs)->get();
            
            $query->whereIn('service_id', $accessibleServices->pluck('id'));
            $accessibleServicesCount = $accessibleServices->count();
        }

        return [
            Stat::make('Total Permohonan', $query->count())
                ->description('Semua permohonan masuk')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('primary'),
            
            Stat::make('Menunggu', $query->clone()->where('status', 'pending')->count())
                ->description('Permohonan menunggu proses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Selesai', $query->clone()->where('status', 'approved')->count())
                ->description('Permohonan selesai diproses')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Layanan Tersedia', $accessibleServicesCount)
                ->description('Layanan yang dapat diakses')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('info'),
        ];
    }
}
