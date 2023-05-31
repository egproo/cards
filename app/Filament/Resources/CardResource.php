<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Filament\Resources\CardResource\RelationManagers;
use App\Models\Card;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;
use Illuminate\support\Str;
use Illuminate\support\Facades\App;
use App\Models\Category;
use App\Models\Region;
use Filament\Resources\RelationManagers\RelationManager;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;
    protected static ?int $navigationSort = 4;
    protected static ?int $sort = 2; 
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $recordTitleAttribute = 'name';
    protected static function getNavigationGroup(): ?string
    {
        return __('words.cards');
    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.cards');
    }
    protected static function getTitle() : string 
    {
        return __('words.cards');
    }   
    protected static function getNavigationBadge(): ?string
    {
        return null;
    }
    public static function form(Form $form): Form
    {
        $currentlang = App::getLocale();
        return $form
        ->schema([
            Forms\Components\Grid::make(12)->schema([
                Forms\Components\Select::make('region_id')->label(__('words.region'))->options(Region::all()->pluck('name','id'))->searchable()->columnSpan(6),
                Forms\Components\Select::make('category_id')->label(__('words.category'))->options(Category::all()->pluck('name_'.$currentlang,'id'))->searchable()->columnSpan(6),            
            ]),
            Forms\Components\Tabs::make('carddetails')->columnSpan('full')->label(__('words.carddetails'))
            ->tabs(
                [
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\TextInput::make('name_en')
                            ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                                if (! $get('is_slugen_changed_manually') && filled($state)) {
                                    $set('slug_en', Str::slug($state).'-en');
                                    $set('slug_ar', Str::slug($state).'-ar');
                                }
                            })
                            ->reactive()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('fulldesc_en')
                            ->required()
                            ->maxLength(65535)->columnSpan('full'),
                        Forms\Components\TextInput::make('desc_en')->columnSpan('full')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug_en')
                            ->required()
                            ->afterStateUpdated(function (Closure $set) {
                                $set('is_slug_changed_manually', true);
                            })
                            ->maxLength(255),
                            
                            
                        Forms\Components\Hidden::make('is_slug_changed_manually')
                            ->default(false)
                            ->dehydrated(false), 
                        Forms\Components\FileUpload::make('image_en'),
                                        
                        ]),     
                        Forms\Components\Tabs\Tab::make('العربيّة')
                        ->schema([

                            Forms\Components\TextInput::make('name_ar')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('fulldesc_ar')
                            ->required()
                            ->maxLength(65535)->columnSpan('full'),
                        Forms\Components\TextInput::make('desc_ar')->columnSpan('full')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug_ar')
                            ->required()
                            ->afterStateUpdated(function (Closure $set) {
                                $set('is_slug_changed_manually', true);
                            })    
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image_ar'),
                                        
                        ]),
                ]
                    ),

        

  
                Forms\Components\Repeater::make('cardvariants')->label(__('words.cardsvariants'))
                ->relationship()
                ->schema([
                    Forms\Components\Grid::make(12)->schema([
                    Forms\Components\TextInput::make('name_ar')->columnSpan(6)
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('name_en')->columnSpan(6)
                    ->required()
                    ->maxLength(255),
                    Forms\Components\FileUpload::make('image_ar')->columnSpan(6),
                    Forms\Components\FileUpload::make('image_en')->columnSpan(6),
                    ]),
                    Forms\Components\Grid::make(12)->schema([
                        Forms\Components\TextInput::make('price')->columnSpan(4)
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('price2')->columnSpan(4)
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('price3')->columnSpan(4)
                        ->required()
                        ->maxLength(255),
                    ]), 

                ])->columnSpan('full'), 

 
                                
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentlang = App::getLocale();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('words.id'))->sortable(),
                Tables\Columns\ImageColumn::make('image_'.$currentlang)->label(__('words.image')),
                Tables\Columns\TextColumn::make('name_'.$currentlang)->searchable()->label(__('words.name')),
                Tables\Columns\TextColumn::make('created_at')->label(__('words.created_at'))
                    ->dateTime()->sortable(),
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
            RelationManagers\CardserialsRelationManager::class,
           
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }    
}
