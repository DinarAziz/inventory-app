<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

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
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required()
                ->label('Kategori'),

            Forms\Components\Select::make('supplier_id')
                ->relationship('supplier', 'name')
                ->required()
                ->label('Supplier'),

            Forms\Components\TextInput::make('stock')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('condition')
                ->options([
                    'baik' => 'Baik',
                    'rusak' => 'Rusak',
                ])
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->imagePreviewHeight('150')
                ->directory('item-images')
                ->maxSize(1024)
                ->label('Foto Barang'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
                Tables\Columns\TextColumn::make('supplier.name')->label('Supplier'),
                Tables\Columns\TextColumn::make('stock')->label('Stok'),
                Tables\Columns\TextColumn::make('condition')->label('Kondisi'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
