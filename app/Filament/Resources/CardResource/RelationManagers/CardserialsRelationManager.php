<?php

namespace App\Filament\Resources\CardResource\RelationManagers;

use App\Models\Cardvariant;
use App\Models\Cardserial;
use App\Models\Log;
use App\Models\Card;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;

class CardserialsRelationManager extends RelationManager
{
    protected static string $relationship = 'cardserials';

    protected static ?string $recordTitleAttribute = 'cardvariant_id';

    public static function form(Form $form): Form
    {
        $currentlang = App::getLocale();
        return $form
            ->schema([
                Forms\Components\Select::make('cardvariant_id')->label(__('words.cardvariant'))->options(Cardvariant::all()->pluck('name_'.$currentlang,'id'))->searchable()->columnSpan(12),            
                Forms\Components\TextInput::make('serial')
                ->required()->columnSpan(12)
                ->unique(),

            ]);
    }

    public static function table(Table $table): Table
    {
        $currentlang = App::getLocale();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('words.id'))->sortable(),
                Tables\Columns\TextColumn::make('serial')->label(__('words.serial'))
                    ->searchable(),
                    Tables\Columns\IconColumn::make('used')
                    ->boolean()->label(__('words.used')),        
                ])
            ->filters([
                Tables\Filters\SelectFilter::make('used')->options(
                    [
                        '1' => __('words.used'),
                        '0' => __('words.notused'),
                    ]
                ),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('addmultiserials')->label(__('words.addmultiserials'))
                ->action(function(Collection $records,array $data):void{
                            

                    $serials= explode("\n",$data['serials']);
                    foreach($serials as $serial){
                     $cardserial = new   Cardserial;
                       $cardserial->cardvariant_id = $data['cardvariant_id'];
                       $cardserial->serial = $serial;
                       $cardserial->save();
                    }       
                        //save log
                        $logii = new Log;
                        $logii->user_id = auth()->user()->id;
                        $username = auth()->user()->name;
                        $logii->activity = "تم إضافة أكواد بطاقات من ".$username." وعدد الأكواد المضافة هو ".count($serials);
                        $variantname = Cardvariant::find($data['cardvariant_id'])->name_ar;
                        $card_id = Cardvariant::find($data['cardvariant_id'])->card_id;
                        $cardname = Card::find($card_id)->name_ar;

                        $logii->note = "الأكواد المضافة للفئة ".$variantname." رقم ".$data['cardvariant_id']." للبطاقة ".$cardname." رقم ".$card_id;
                        $logii->save();
                }
                )->form(
                    [
                        Forms\Components\Select::make('cardvariant_id')->label(__('words.cardvariant'))->options(Cardvariant::all()->pluck('name_'.$currentlang,'id'))->searchable()->columnSpan(12),            
                        Textarea::make('serials')->rows(6)->label(__('words.addmulti')),
                    ]
                )
                //Tables\Actions\CreateAction::make('addmultiserials')->label(__('words.addmultiserials')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                
            ]);
    }    
}
