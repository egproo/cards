<?php

namespace App\Filament\Resources\LogResource\Pages;

use App\Filament\Resources\LogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;
use App\Models\Log;
class CreateLog extends CreateRecord
{
    protected static string $resource = LogResource::class;
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
            $logii = new Log;
            $logii->user_id = auth()->user()->id;
            $username = auth()->user()->name;
            $logii->activity = " اضافة سجل نشاط رقم :  ".$recordid;
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
