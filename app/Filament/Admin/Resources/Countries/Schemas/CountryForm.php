<?php

namespace App\Filament\Admin\Resources\Countries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }
}
