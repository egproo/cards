<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?int $navigationSort = 6;
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
        return __('words.invoices');
    }
    protected static function getTitle() : string 
    {
        return __('words.invoices');
    }     
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_id')
                    ->required(),
                Forms\Components\TextInput::make('total')
                    ->required(),
                Forms\Components\TextInput::make('invoicenote')
                    ->maxLength(255),
                Forms\Components\Toggle::make('payed')
                    ->required(),
                Forms\Components\TextInput::make('payed_at')
                    ->required(),
                Forms\Components\TextInput::make('payed_by')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id'),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('invoicenote'),
                Tables\Columns\IconColumn::make('payed')
                    ->boolean(),
                Tables\Columns\TextColumn::make('payed_at'),
                Tables\Columns\TextColumn::make('payed_by'),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }    
}
