<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null; // matikan auto refresh

    protected function getCards(): array
    {
        return [
            Card::make('📦 Total Barang', Item::count()),
            Card::make('🗂️ Kategori', Category::count()),
            Card::make('📋 Peminjaman', Loan::count()),
            Card::make('👤 Pengguna', User::count()),
        ];
    }
}
