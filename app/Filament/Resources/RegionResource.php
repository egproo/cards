<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use App\Models\Currency;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.gsettings');
    }
    protected static ?string $recordTitleAttribute = 'name';
    protected static function getNavigationLabel() : string 
    {
        return __('words.regions');
    }
    protected static function getTitle() : string 
    {
        return __('words.regions');
    } 
    protected static ?string $navigationIcon = 'heroicon-o-location-marker';
    protected static ?int $navigationSort = 2;//ترتيب الظهور بالقائمة
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)->schema([
                    Forms\Components\Select::make('currency_id')->label(__('words.dcurrency'))->options(Currency::all()->pluck('name','id'))->searchable()->columnSpan(6),            
                    Forms\Components\TextInput::make('name')->label(__('words.name'))
                    ->required()
                    ->maxLength(255)->columnSpan(6),
                Forms\Components\TextInput::make('isocode')->label(__('words.2iso'))
                    ->required()
                    ->length(2)->columnSpan(6),
                Forms\Components\FileUpload::make('image')->columnSpan(6)->label(__('words.image')),
               ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('words.id'))->sortable(),
                Tables\Columns\TextColumn::make('currency.name')->label(__('words.dcurrency')),                
                Tables\Columns\ImageColumn::make('image')->label(__('words.image')),
                Tables\Columns\TextColumn::make('name')->label(__('words.name'))->searchable(),
                Tables\Columns\TextColumn::make('isocode')->label(__('words.2iso')),
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
    public static function getRedirect(): string
    {
        return route('filament.resource.regions.index');
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegions::route('/'),
            //'create' => Pages\CreateRegion::route('/create'),
            //'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }    
}
