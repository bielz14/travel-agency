<?php

namespace App\Filament\Admin\Resources\Tours\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class TourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->rows(4)
                    ->nullable(),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('$')
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->required(),

                Forms\Components\Checkbox::make('active')
                    ->label('Active')
                    ->default(true),

                Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('hotel_id')
                    ->relationship('hotel', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('tours')
                    ->nullable()
            ]);
    }
}
