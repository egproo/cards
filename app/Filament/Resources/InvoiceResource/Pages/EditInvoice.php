<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Log;
use Filament\Support\Exceptions\Halt;
class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function save(bool $shouldRedirect = true): void
    {
        $this->authorizeAccess();

        try {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeSave($data);

            $this->callHook('beforeSave');

            $this->handleRecordUpdate($this->getRecord(), $data);
            //save log
            $recordid = json_decode($this->getRecord())->id;
            $logii = new Log;
            $logii->user_id = auth()->user()->id;
            $username = auth()->user()->name;
            $logii->activity = " تعديل الفاتورة رقم :  ".$recordid." (".$data['name_ar']." )";
            $logii->note = "";
            $logii->username = $username;
            $logii->save();  
            $this->callHook('afterSave');
        } catch (Halt $exception) {
            return;
        }

        $this->getSavedNotification()?->send();

        if ($shouldRedirect && ($redirectUrl = $this->getRedirectUrl())) {
            $this->redirect($redirectUrl);
        }
    }        
}
