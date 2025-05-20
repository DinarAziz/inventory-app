<?php

return [
     'panels' => [
        App\Providers\Filament\AdminPanelProvider::class,
     ],

    // Brand
    'brand_name' => '📦 Inventory App SMKN 4',
    'logo' => null,
    'favicon' => null,

    // Mode Tampilan
    'dark_mode' => true,

    // Tema Warna
    'theme' => [
        'colors' => [
            'primary' => '#4f46e5', // Indigo
            'danger'  => '#ef4444', // Merah
            'success' => '#10b981', // Hijau
            'warning' => '#f59e0b', // Kuning
        ],
    ],

    // Layout Panel
    'layout' => [
        'sidebar' => [
            'is_collapsible_on_desktop' => true,
            'width' => '250px',
        ],
        'max_content_width' => 'full',
    ],

    // Notifikasi
    'notifications' => [
        'enabled' => false,
    ],

    // Broadcasting (Real-time, opsional)
    'broadcasting' => [
        // Contoh jika ingin pakai Laravel Echo
        // 'echo' => [...],
    ],

    // Upload & Storage
    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    // Jalur Aset (opsional jika pakai custom theme)
    'assets_path' => null,

    // Cache Komponen
    'cache_path' => base_path('bootstrap/cache/filament'),

    // Loading Delay Livewire (UX)
    'livewire_loading_delay' => 'none',

    // Prefix route untuk sistem internal Filament
    'system_route_prefix' => 'filament',
];
