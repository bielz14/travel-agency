<?php

namespace App\Filament\Admin\Resources\Bookings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->required(),

                Forms\Components\Select::make('tour_id')
                    ->relationship('tour', 'title')
                    ->label('Tour')
                    ->required(),

                Forms\Components\Checkbox::make('guests')
                    ->label('Guests')
                    ->default(true),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required()
            ]);
    }
}
