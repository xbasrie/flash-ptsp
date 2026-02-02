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
        } elseif ($user->hasRole('admin zawa')) {
            $query->whereHas('service', fn($q) => $q->where('slug', 'like', 'zawa-%'));
        } elseif ($user->hasRole('admin kepegawaian')) {
            $query->whereHas('service', fn($q) => $q->where(function ($query) {
                $query->where('slug', 'not like', 'bimas-%')
                      ->where('slug', 'not like', 'kub-%')
                      ->where('slug', 'not like', 'zawa-%');
            }));
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
