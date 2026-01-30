<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SubmissionsChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Permohonan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $user = Auth::user();
        $query = Submission::query();

        if ($user->hasRole('admin bimas')) {
            $query->whereHas('service', fn($q) => $q->where('slug', 'like', 'bimas-%'));
        } elseif ($user->hasRole('admin kub')) {
            $query->whereHas('service', fn($q) => $q->where('slug', 'like', 'kub-%'));
        } elseif ($user->hasRole('admin kepegawaian')) {
            $query->whereHas('service', fn($q) => $q->whereNotIn('slug', ['kub-pendirian', 'kub-rohaniawan', 'kub-tanah', 'bimas-masjid', 'bimas-musholla', 'bimas-majelis-taklim', 'bimas-nikah']));
        }

        $data = Trend::model(Submission::class)
            ->query($query)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Permohonan Masuk',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
