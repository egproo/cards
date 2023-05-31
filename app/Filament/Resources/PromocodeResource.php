<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromocodeResource\Pages;
use App\Filament\Resources\PromocodeResource\RelationManagers;
use App\Models\Promocode;
use Filament\Forms;
use App\Models\Region;
use App\Models\Currency;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PromocodeResource extends Resource
{
    protected static ?string $model = Promocode::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.gsettings');
    }
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }  
    protected static function getNavigationLabel() : string 
    {
        return __('words.promocodes');
    }
    protected static function getTitle() : string 
    {
        return __('words.promocodes');
    } 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)->schema([
                Forms\Components\Select::make('currency_id')->label(__('words.currency'))->options(Currency::all()->pluck('name','id'))->searchable()->columnSpan(6),            
                Forms\Components\Select::make('region_id')->columnSpan(6)->label(__('words.region'))->options(Region::all()->pluck('name','id'))->searchable(),
                Forms\Components\TextInput::make('promocode')->label(__('words.promocode'))
                    ->maxLength(255)->columnSpan(6),
                Forms\Components\Select::make('promotype')->options(
                    [
                        'percent' => __('words.percent'),
                        'amount'  => __('words.amount'),
                    ]
                )->label(__('words.promotype'))
                
                ->columnSpan(6),
                Forms\Components\TextInput::make('promovalue')->label(__('words.promovalue'))
                    ->required()->columnSpan(6),
                Forms\Components\Toggle::make('active')->label(__('words.activestatus'))
                    ->required()->columnSpan(6),
                Forms\Components\DatePicker::make('validfrom')->label(__('words.validfrom'))
                    ->required()->columnSpan(6),
                Forms\Components\DatePicker::make('validto')->label(__('words.validto'))
                    ->required()->columnSpan(6),
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('currency_id'),
                Tables\Columns\TextColumn::make('region_id'),
                Tables\Columns\TextColumn::make('promocode'),
                Tables\Columns\TextColumn::make('promotype'),
                Tables\Columns\TextColumn::make('promovalue'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('validfrom'),
                Tables\Columns\TextColumn::make('validto'),
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
            'index' => Pages\ListPromocodes::route('/'),
            'create' => Pages\CreatePromocode::route('/create'),
            'edit' => Pages\EditPromocode::route('/{record}/edit'),
        ];
    }    
}
