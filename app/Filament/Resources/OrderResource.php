<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->required()
                    ->label('Nama Pemesan'),
    
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable()
                    ->label('Produk'),
    
                Forms\Components\TextInput::make('total_price')
                    ->numeric()
                    ->required()
                    ->label('Total Harga'),
    
                Forms\Components\Select::make('status')
                    ->options([
                        'processing' => 'Diproses',
                        'packing' => 'Packing',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Diterima'
                    ])
                    ->default('processing')
                    ->required()
                    ->label('Status'),
    
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->label('Alamat'),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'processing' => 'warning',
                        'packing' => 'warning',
                        'shipped' => 'info',
                        'delivered' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada pesanan')
            ->emptyStateDescription('Pesanan akan muncul di sini ketika pelanggan mulai membeli.')
            ->emptyStateIcon('heroicon-o-face-frown')

            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'processing' => 'Diproses',
                        'packing' => 'Packing',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Diterima'
                    ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
