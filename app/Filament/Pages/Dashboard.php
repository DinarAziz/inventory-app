<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\DashboardOverview;
use App\Filament\Widgets\LoanChart;

class Dashboard extends Page
{


    public function getHeaderWidgets(): array
{
    return [
        DashboardOverview::class,
        LoanChart::class
    ];
}
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';
}
