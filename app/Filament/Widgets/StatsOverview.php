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

        if ($user->hasRole('admin bimas')) {
            $query->whereHas('service', fn($q) => $q->where('slug', 'like', 'bimas-%'));
        } elseif ($user->hasRole('admin kub')) {
            $query->whereHas('service', fn($q) => $q->where('slug', 'like', 'kub-%'));
        } elseif ($user->hasRole('admin zawa')) {
            $query->whereHas('service', fn($q) => $q->where('slug', 'like', 'zawa-%'));
        } elseif ($user->hasRole('admin kepegawaian')) {
            $query->whereHas('service', fn($q) => $q->where(function ($query) {
                $query->where('slug', 'not like', 'bimas-%')
                      ->where('slug', 'not like', 'kub-%')
                      ->where('slug', 'not like', 'zawa-%');
            }));
        }
        // Super Admin sees everything by default (no filter added)

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
        ];
    }
}
