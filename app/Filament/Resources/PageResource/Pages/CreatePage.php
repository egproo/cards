<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;
use App\Models\Log;
class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
    protected function getRedirectUrl(): string
    {
        return route('filament.resources.pages.index');
    }
    public function create(bool $another = false): void
    {
        $this->authorizeAccess();

        try {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeCreate($data);

            $this->callHook('beforeCreate');

            $this->record = $this->handleRecordCreation($data);
            $recordinfo = json_decode($this->record);
            $recordid = $recordinfo->id;
            $info = $recordinfo->title_ar;
            $logii = new Log;
            $logii->user_id = auth()->user()->id;
            $username = auth()->user()->name;
            $logii->activity = " اضافة الصفحة رقم :  ".$recordid." (".$info." )";
            $logii->note = "";
            $logii->username = $username;
            $logii->save();
            $this->form->model($this->record)->saveRelationships();
           // dd($this->form);
            $this->callHook('afterCreate');
        } catch (Halt $exception) {
            return;
        }

        $this->getCreatedNotification()?->send();

        if ($another) {
            // Ensure that the form record is anonymized so that relationships aren't loaded.
            $this->form->model($this->record::class);
            $this->record = null;

            $this->fillForm();

            return;
        }

        $this->redirect($this->getRedirectUrl());
    }    
}
