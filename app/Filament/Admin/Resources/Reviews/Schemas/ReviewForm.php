<?php

namespace App\Filament\Admin\Resources\Reviews\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class ReviewForm
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

                Forms\Components\Radio::make('rating')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ])
                    ->default(5)
                    ->inline(),

                Forms\Components\Textarea::make('comment')
                    ->label('Comment')
                    ->rows(4)
                    ->maxLength(1000)
                    ->placeholder('Write a comment...')
            ]);
    }
}
