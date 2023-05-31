<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.gsettings');
    }
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 100;//ترتيب الظهور بالقائمة
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.settings');
    }
    protected static function getTitle() : string 
    {
        return __('words.settings');
    }     
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->label(__('words.settingc'))
                    ->maxLength(255),
                    Forms\Components\TextInput::make('value')
                    ->required()
                    ->label(__('words.settingv'))
                    ->maxLength(65535),
                    Forms\Components\Textarea::make('notes')
                    ->columnSpan('full')
                    ->rows(2)
                    ->label(__('words.notes'))
                    ->maxLength(65535),                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                ->searchable()
                ->label(__('words.settingc'))
                ->sortable(),
                Tables\Columns\TextColumn::make('value')
                ->label(__('words.settingv')) 
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                ->label(__('words.notes')) 
                ->searchable()
                ->sortable(),            ])
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }    
}
