<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoicecardResource\Pages;
use App\Filament\Resources\InvoicecardResource\RelationManagers;
use App\Models\Invoicecard;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoicecardResource extends Resource
{
    protected static ?string $model = Invoicecard::class;
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationGroup(): ?string
    {
        return __('words.ordersinvoices');
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.invoicescards');
    }
    protected static function getTitle() : string 
    {
        return __('words.invoicescards');
    }   
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('invoice_id'),
                Forms\Components\TextInput::make('card_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cardvariant_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qty')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\TextInput::make('total')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_id'),
                Tables\Columns\TextColumn::make('card_id'),
                Tables\Columns\TextColumn::make('cardvariant_id'),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('total'),
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
            'index' => Pages\ListInvoicecards::route('/'),
            'create' => Pages\CreateInvoicecard::route('/create'),
            'edit' => Pages\EditInvoicecard::route('/{record}/edit'),
        ];
    }    
}
