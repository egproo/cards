<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardreviewResource\Pages;
use App\Filament\Resources\CardreviewResource\RelationManagers;
use App\Models\Cardreview;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CardreviewResource extends Resource
{
    protected static ?string $model = Cardreview::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationGroup(): ?string
    {
        return __('words.cards');
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.cardsreviews');
    }
    protected static function getTitle() : string 
    {
        return __('words.cardsreviews');
    }   
    protected static function getNavigationBadge(): ?string
    {
        return null;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_id'),
                Forms\Components\TextInput::make('user_id'),
                Forms\Components\TextInput::make('card_id'),
                Forms\Components\Toggle::make('rate')
                    ->required(),
                Forms\Components\TextInput::make('reviewtxt')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('card_id'),
                Tables\Columns\IconColumn::make('rate')
                    ->boolean(),
                Tables\Columns\TextColumn::make('reviewtxt'),
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
            'index' => Pages\ListCardreviews::route('/'),
            'create' => Pages\CreateCardreview::route('/create'),
            'edit' => Pages\EditCardreview::route('/{record}/edit'),
        ];
    }    
}
