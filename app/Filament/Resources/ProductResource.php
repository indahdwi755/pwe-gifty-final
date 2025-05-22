<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;
use Closure;
use Filament\Notifications\Notification;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card wrapper
                Forms\Components\Card::make()
                    ->schema([
                        // Image upload
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->required()
                            ->directory('products'),

                        // Main grid for fields
                        Forms\Components\Grid::make(2)
                            ->schema([
                                // Left column
                                Forms\Components\Grid::make(1)
                                    ->schema([
                                        // Name
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama Produk')
                                            ->placeholder('Masukkan nama produk')
                                            ->required()
                                            ->maxLength(255),

                                        // Category relation
                                        Forms\Components\Select::make('category_id')
                                            ->label('Kategori')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),

                                        // Description
                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->placeholder('Masukkan deskripsi produk')
                                            ->required()
                                            ->maxLength(1000),
                                    ]),

                                // Right column
                                Forms\Components\Grid::make(1)
                                    ->schema([
                                        // Stock
                                        Forms\Components\TextInput::make('stock')
                                            ->label('Stok')
                                            ->numeric()
                                            ->default(0)
                                            ->required()
                                            ->minValue(0),

                                        // Regular Price
                                        Forms\Components\TextInput::make('price')
                                            ->label('Harga Normal')
                                            ->numeric()
                                            ->required()
                                            ->default(0)
                                            ->minValue(0),

                                        // Promo Toggle and Price
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Toggle::make('is_promo')
                                                    ->label('Aktifkan Promo')
                                                    ->default(false)
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set) {
                                                        if (!$state) {
                                                            $set('promo_price', null);
                                                        }
                                                    }),

                                                Forms\Components\TextInput::make('promo_price')
                                                    ->label('Harga Promo')
                                                    ->numeric()
                                                    ->default(0)
                                                    ->minValue(0)
                                                    ->visible(fn ($get) => $get('is_promo'))
                                                    ->required(fn ($get) => $get('is_promo'))
                                                    ->live()
                                                    ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                                        $normalPrice = $get('price');
                                                        if ($state >= $normalPrice) {
                                                            $set('promo_price', null);
                                                            Notification::make()
                                                                ->warning()
                                                                ->title('Harga Promo Tidak Valid')
                                                                ->body("Harga promo (Rp " . number_format($state, 0, ',', '.') . ") harus lebih kecil dari harga normal (Rp " . number_format($normalPrice, 0, ',', '.') . ")")
                                                                ->send();
                                                        }
                                                    })
                                                    ->helperText('Contoh: Jika harga normal Rp 150.000, maka harga promo harus di bawah Rp 150.000'),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->defaultImageUrl(asset('default-image.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(25)
                    ->tooltip(function ($record) {
                        return $record?->description;
                    }),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('promo_price')
                    ->money('IDR')
                    ->visible(fn ($record) => $record && $record->is_promo)
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_promo')
                    ->label('Promo')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No products listed')
            ->emptyStateDescription("Let's add some amazing gifts.")
            ->emptyStateIcon('heroicon-o-face-frown')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_promo')
                    ->label('Promo Status')
                    ->queries(
                        true: fn ($query) => $query->where('is_promo', true)->whereNotNull('promo_price'),
                        false: fn ($query) => $query->where('is_promo', false)->orWhereNull('promo_price'),
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
