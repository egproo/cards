<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardserialResource\Pages;
use App\Filament\Resources\CardserialResource\RelationManagers;
use App\Models\Cardserial;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CardserialResource extends Resource
{
    protected static ?string $model = Cardserial::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationGroup(): ?string
    {
        return __('words.cards');
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.cardsserials');
    }
    protected static function getTitle() : string 
    {
        return __('words.cardsserials');
    }    
    protected static function getNavigationBadge(): ?string
    {
        return null;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cardvariant_id'),
                Forms\Components\TextInput::make('serial')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Toggle::make('used')
                    ->required(),
                Forms\Components\TextInput::make('invoicecard_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cardvariant_id'),
                Tables\Columns\TextColumn::make('serial'),
                Tables\Columns\IconColumn::make('used')
                    ->boolean(),
                Tables\Columns\TextColumn::make('invoicecard_id'),
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
            'index' => Pages\ListCardserials::route('/'),
            'create' => Pages\CreateCardserial::route('/create'),
            'edit' => Pages\EditCardserial::route('/{record}/edit'),
        ];
    }    
}
