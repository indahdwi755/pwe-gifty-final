<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('order_id')
                ->relationship('order', 'id') // Bisa diganti dengan field lain seperti order.user.name jika perlu
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('payment_method')
                ->required()
                ->maxLength(255),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('order.id')->label('Order ID'),
            Tables\Columns\TextColumn::make('payment_method')->label('Payment Method'),
            Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
        ])
        ->emptyStateHeading('No transaction records')
        ->emptyStateDescription('All completed purchases and payments will be listed in this section.')
        ->emptyStateIcon('heroicon-o-face-frown')

        ->filters([
            // Tambahkan filter jika diperlukan
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
