<?php

namespace App\Filament\Admin\Resources\Hotels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class HotelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->label('City')
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Radio::make('stars')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ])
                    ->default(3)
                    ->inline(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }
}
