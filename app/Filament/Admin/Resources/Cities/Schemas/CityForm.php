<?php

namespace App\Filament\Admin\Resources\Cities\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                    ->label('Country')
                    ->required(),

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
