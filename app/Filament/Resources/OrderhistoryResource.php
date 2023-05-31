<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderhistoryResource\Pages;
use App\Filament\Resources\OrderhistoryResource\RelationManagers;
use App\Models\Orderhistory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderhistoryResource extends Resource
{
    protected static ?string $model = Orderhistory::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.ordersinvoices');
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.ordershistory');
    }
    protected static function getTitle() : string 
    {
        return __('words.ordershistory');
    }            
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_id')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('statusby')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('statusby'),
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
            'index' => Pages\ListOrderhistories::route('/'),
            'create' => Pages\CreateOrderhistory::route('/create'),
            'edit' => Pages\EditOrderhistory::route('/{record}/edit'),
        ];
    }    
}
