<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Currency;
use App\Models\Region;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.users');
    }

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationLabel() : string 
    {
        return __('words.users');
    }
    protected static function getTitle() : string 
    {
        return __('words.users');
    }
    protected static ?int $sort = 1; 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(8)
                ->schema([
                Forms\Components\Select::make('currency_id')->label(__('words.usercurrency'))->options(Currency::all()->pluck('name','id'))->searchable()->columnSpan(4),            
                Forms\Components\Select::make('region_id')->label(__('words.usercountry'))->options(Region::all()->pluck('name','id'))->searchable()->columnSpan(4),            
                Forms\Components\TextInput::make('uuid')->uuid()->hidden()->columnSpan(4),               //Forms\Components\::make('uuid')->required()->label('words.uuid')->maxLength(36),
                Forms\Components\TextInput::make('name')->required()->columnSpan(4),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255)->columnSpan(4),
                Forms\Components\TextInput::make('phone')->tel()->required()->maxLength(255)->columnSpan(4),
                Forms\Components\FileUpload::make('avatar')->columnSpan(3)->label(__('words.image'))->columnSpan(4),
                Forms\Components\TextInput::make('password')->disableAutocomplete()
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->maxLength(255)->columnSpan(4),
            ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('currency.name')->label(__('words.usercurrency')),                
                Tables\Columns\TextColumn::make('region.name')->label(__('words.usercountry')),                
                Tables\Columns\TextColumn::make('uuid'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('avatar'),
                Tables\Columns\TextColumn::make('lastlogin')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('ip'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }    
}
