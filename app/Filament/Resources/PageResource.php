<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
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
class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static function getNavigationGroup(): ?string
    {
        return __('words.pages');
    }
    protected static ?int $navigationSort = 11;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static function getNavigationBadge(): ?string
    {
        return null;

    }
    protected static function getNavigationLabel() : string 
    {
        return __('words.pages');
    }
    protected static function getTitle() : string 
    {
        return __('words.pages');
    }    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('pagesdetails')->columnSpan('full')->label(__('words.pages'))
                ->tabs(
                    [
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\FileUpload::make('image_en'),
                                Forms\Components\TextInput::make('title_en')
                                ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                                    if (! $get('is_slugen_changed_manually') && filled($state)) {
                                        $set('slug_en', Str::slug($state).'-en');
                                        $set('slug_ar', Str::slug($state).'-ar');
                                    }
                                })
                                ->reactive()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('content_en')
                                ->required()
                                ->maxLength(65535)->columnSpan('full'),
                            Forms\Components\TextInput::make('slug_en')
                                ->required()
                                ->afterStateUpdated(function (Closure $set) {
                                    $set('is_slug_changed_manually', true);
                                })
                                ->maxLength(255),
                                
                                
                            Forms\Components\Hidden::make('is_slug_changed_manually')
                                ->default(false)
                                ->dehydrated(false),
                                            
                            ]),     
                            Forms\Components\Tabs\Tab::make('العربيّة')
                            ->schema([
                                Forms\Components\FileUpload::make('image_ar'),
                                Forms\Components\TextInput::make('title_ar')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\RichEditor::make('content_ar')
                                ->required()
                                ->maxLength(65535)->columnSpan('full'),
                            Forms\Components\TextInput::make('slug_ar')
                                ->required()
                                ->afterStateUpdated(function (Closure $set) {
                                    $set('is_slug_changed_manually', true);
                                })    
                                ->maxLength(255),

                                            
                            ]),
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentlang = App::getLocale();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('words.id'))->sortable(),
                Tables\Columns\ImageColumn::make('image_'.$currentlang)->label(__('words.image')),
                Tables\Columns\TextColumn::make('title_'.$currentlang)->searchable()->label(__('words.name')),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }    
}
