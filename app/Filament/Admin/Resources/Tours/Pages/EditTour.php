<?php

namespace App\Filament\Admin\Resources\Tours\Pages;

use App\Filament\Admin\Resources\Tours\TourResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTour extends EditRecord
{
    protected static string $resource = TourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
