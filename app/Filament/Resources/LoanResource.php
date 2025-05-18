<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Models\Loan;
use App\Models\User;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->label('Peminjam')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Forms\Components\Select::make('item_id')
                ->label('Barang')
                ->relationship('item', 'name')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('borrow_date')
                ->label('Tanggal Pinjam')
                ->default(now())
                ->required(),

            Forms\Components\DatePicker::make('due_date')
                ->label('Tenggat Waktu')
                ->required(),

            Forms\Components\TextInput::make('quantity')
                ->label('Jumlah')
                ->numeric()
                ->required()
                ->minValue(1)
                ->maxValue(fn (Forms\Get $get) =>
                    \App\Models\Item::find($get('item_id'))?->stock ?? null
                ),

            Forms\Components\DatePicker::make('return_date')
                ->label('Tanggal Kembali')
                ->nullable(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Menunggu Persetujuan',
                    'approved' => 'Disetujui',
                    'returned' => 'Dikembalikan',
                    'rejected' => 'Ditolak',
                    'overdue' => 'Terlambat',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')->label('Peminjam'),
            Tables\Columns\TextColumn::make('item.name')->label('Barang'),
            Tables\Columns\TextColumn::make('borrow_date')->label('Pinjam'),
            Tables\Columns\TextColumn::make('due_date')->label('Tenggat'),
            Tables\Columns\TextColumn::make('return_date')->label('Kembali'),
            Tables\Columns\TextColumn::make('quantity')->label('Jumlah'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'primary' => 'pending',
                    'success' => 'approved',
                    'gray' => 'returned',
                    'danger' => 'rejected',
                    'warning' => 'overdue',
                ])
                ->label('Status'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Menunggu Persetujuan',
                    'approved' => 'Disetujui',
                    'returned' => 'Dikembalikan',
                    'rejected' => 'Ditolak',
                    'overdue' => 'Terlambat',
                ]),
        ])
        ->actions([
    Tables\Actions\EditAction::make(),
    Tables\Actions\Action::make('approve')
        ->label('Setujui')
        ->visible(fn ($record) => $record->status === 'pending')
        ->requiresConfirmation()
        ->action(function ($record) {
            $record->status = 'approved';
            $record->save();
        }),

    Tables\Actions\Action::make('reject')
        ->label('Tolak')
        ->color('danger')
        ->visible(fn ($record) => $record->status === 'pending')
        ->requiresConfirmation()
        ->action(function ($record) {
            $record->status = 'rejected';
            $record->save();
        }),
        Tables\Actions\Action::make('return')
    ->label('Kembalikan')
    ->visible(fn ($record) => $record->status === 'approved')
    ->requiresConfirmation()
    ->color('success')
    ->action(function ($record) {
        $record->status = 'returned';
        $record->return_date = now();
        $record->save();
    }),

])

        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
{
    return \App\Models\Loan::where('status', 'pending')->count();
}


}
