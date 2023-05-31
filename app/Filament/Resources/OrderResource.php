<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?int $navigationSort = 8;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationGroup(): ?string
    {
        return __('words.ordersinvoices');
    }
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.orders');
    }
    protected static function getTitle() : string 
    {
        return __('words.orders');
    }     
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id'),
                Forms\Components\TextInput::make('promocode_id'),
                Forms\Components\TextInput::make('total')
                    ->required(),
                Forms\Components\TextInput::make('note')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currentstatus')
                    ->maxLength(255),
                Forms\Components\TextInput::make('editd_at')
                    ->required(),
                Forms\Components\TextInput::make('edit_by')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('promocode_id'),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('note'),
                Tables\Columns\TextColumn::make('currentstatus'),
                Tables\Columns\TextColumn::make('editd_at'),
                Tables\Columns\TextColumn::make('edit_by'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
