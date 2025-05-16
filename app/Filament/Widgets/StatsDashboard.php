<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Product;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countorder = Order::count();
        $countstockproduct = Product::where('stock', '<', 5)->count();
        $counttotalrevenue = 'Rp ' . number_format(Order::sum('total_price'), 0, ',', '.');
        return [
            Stat::make('Number Of Orders', $countorder . ' Orders'),
            Stat::make('Low Stock Products', $countstockproduct . ' Product'),
            Stat::make('Total Revenue', $counttotalrevenue),
        ];
    }
}
