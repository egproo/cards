<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use App\Filament\Resources\LogResource\RelationManagers;
use App\Models\Log;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogResource extends Resource
{
    protected static ?string $model = Log::class;
    protected static ?string $navigationGroup = 'main';
    protected static function getNavigationGroup(): ?string
    {
        return __('words.foradmins');
    }
    protected static ?int $navigationSort = 400;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.logs');
    }
    protected static ?int $sort = 100; 
    protected static function getTitle() : string 
    {
        return __('words.logs');
    }     
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')->label("المستخدم"),
                Tables\Columns\TextColumn::make('activity')->label("النشاط"),

            ])
            ->filters([
                //
            ])
            ->actions([
               // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLogs::route('/'),
           // 'create' => Pages\CreateLog::route('/create'),
           // 'edit' => Pages\EditLog::route('/{record}/edit'),
        ];
    }    
}
