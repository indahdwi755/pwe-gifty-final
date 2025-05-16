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
                            ->required(),

                        // Main grid for fields
                        Forms\Components\Grid::make(5)
                            ->schema([

                                // Name
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->placeholder('Name')
                                    ->required(),

                                // Category relation
                                Forms\Components\Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->required(),

                                // Description
                                Forms\Components\TextInput::make('description')
                                    ->label('Description')
                                    ->placeholder('Description')
                                    ->required(),

                                // Stock
                                Forms\Components\TextInput::make('stock')
                                    ->label('Stock')
                                    ->placeholder('Stock')
                                    ->required(),

                                // Price
                                Forms\Components\TextInput::make('price')
                                    ->label('Price')
                                    ->placeholder('Price')
                                    ->required(),

                                Toggle::make('is_promo')
                                    ->label('Promo')
                                    ->default(false),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('description')->limit(25),
                Tables\Columns\TextColumn::make('stock'),
                Tables\Columns\TextColumn::make('price'),

                // Promo indicator
                Tables\Columns\BooleanColumn::make('is_promo')
                    ->label('Promo')
                    ->sortable(),
            ])
            ->emptyStateHeading('No products listed')
            ->emptyStateDescription('Let’s add some amazing gifts.')
            ->emptyStateIcon('heroicon-o-face-frown')

            ->filters([
                // Optionally add filter for promo status
                Tables\Filters\TernaryFilter::make('is_promo')
                    ->label('Promo Status'),
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
