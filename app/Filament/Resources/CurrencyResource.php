<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrencyResource\Pages;
use App\Filament\Resources\CurrencyResource\RelationManagers;
use App\Models\Currency;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.gsettings');
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.currencies');
    }
    protected static function getTitle() : string 
    {
        return __('words.currencies');
    }  
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    public static function getRedirect(): string
    {
        return route('filament.resource.currencies.index');
    }
      
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 1;//ترتيب الظهور بالقائمة
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()->columnSpan(5)
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()->columnSpan(2)
                    ->length(3)->unique(ignoreRecord:true),
                    Forms\Components\TextInput::make('symbol')
                    ->required()->columnSpan(2)
                    ->length(3)->unique(ignoreRecord:true),                    
                    Forms\Components\TextInput::make('value')
                    ->required()->columnSpan(3),                   


                Forms\Components\Toggle::make('default')
                    ->required()->columnSpan(6),
                
                Forms\Components\Toggle::make('status')
                    ->required()->columnSpan(6),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('words.id')),
                Tables\Columns\TextColumn::make('name')->label(__('words.name'))->searchable(),
                Tables\Columns\TextColumn::make('code')->label(__('words.currcode')),
                Tables\Columns\TextColumn::make('symbol')->label(__('words.symbol')),
                Tables\Columns\IconColumn::make('default')
                    ->boolean()->label(__('words.default')),
                Tables\Columns\TextColumn::make('value')->label(__('words.currvalue')),
                Tables\Columns\IconColumn::make('status')->label(__('words.status'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label(__('words.created_at'))
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label(__('words.updated_at'))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCurrencies::route('/'),
            //'create' => Pages\CreateCurrency::route('/create'),
            //'edit' => Pages\EditCurrency::route('/{record}/edit'),
            // pop-up create or edit instead of page
        ];
    }    
}
