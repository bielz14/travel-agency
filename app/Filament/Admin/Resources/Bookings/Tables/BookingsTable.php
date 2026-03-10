<?php

namespace App\Filament\Admin\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tour.title')
                    ->label('Tour')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('guests')
                    ->label('Guests')
                    ->boolean(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User'),

                Tables\Filters\Filter::make('email')
                    ->form([
                        Forms\Components\TextInput::make('email')
                            ->label('Email'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        $query->when($data['email'], function ($query, $email) {
                            $query->whereHas('user', fn ($q) => $q->where('email', 'like', "%{$email}%"));
                        });
                    }),

                Tables\Filters\Filter::make('phone')
                    ->form([
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        $query->when($data['phone'], function ($query, $phone) {
                            $query->whereHas('user', fn ($q) => $q->where('phone', 'like', "%{$phone}%"));
                        });
                    }),

                Tables\Filters\SelectFilter::make('tour_id')
                    ->relationship('tour', 'title')
                    ->label('Tour'),

                Tables\Filters\TernaryFilter::make('guests')
                    ->label('Guests'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
