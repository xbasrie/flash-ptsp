<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionCompositionChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Permohonan per Layanan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $user = Auth::user();
        $query = Submission::query();

        if (! $user->hasRole('super admin')) {
            // Robust filtering logic: Iterate Resources to find accessible Services
            $accessibleServiceSlugs = collect(\Filament\Facades\Filament::getResources())
                ->filter(function ($resource) {
                    return $resource::canAccess();
                })
                ->map(function ($resource) {
                    return $resource::getSlug();
                })
                ->filter(function ($slug) {
                    return \Illuminate\Support\Str::endsWith($slug, '-submissions');
                })
                ->map(function ($slug) {
                    return \Illuminate\Support\Str::replaceLast('-submissions', '', $slug);
                });

            $accessibleServices = \App\Models\Service::whereIn('slug', $accessibleServiceSlugs)->get();
            
            $query->whereIn('service_id', $accessibleServices->pluck('id'));
        }

        // Group by service and count
        $data = $query->with('service')
            ->select('service_id', DB::raw('count(*) as total'))
            ->groupBy('service_id')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Permohonan',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => [
                        '#3b82f6', // blue-500
                        '#ef4444', // red-500
                        '#10b981', // emerald-500
                        '#f59e0b', // amber-500
                        '#8b5cf6', // violet-500
                        '#ec4899', // pink-500
                        '#6366f1', // indigo-500
                        '#14b8a6', // teal-500
                        '#f97316', // orange-500
                        '#84cc16', // lime-500
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $data->pluck('service.name'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
