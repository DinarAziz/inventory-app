<?php

namespace App\Filament\Widgets;

use App\Models\Loan;
use Filament\Widgets\ChartWidget;

class LoanChart extends ChartWidget
{
    protected static ?string $heading = '📊 Peminjaman per Bulan';

    protected function getData(): array
    {
        $data = Loan::selectRaw('MONTH(borrow_date) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->pluck('month')->map(fn ($m) => date('F', mktime(0, 0, 0, $m, 1)))->toArray();
        $values = $data->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Peminjaman',
                    'data' => $values,
                    'backgroundColor' => '#6366F1',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
