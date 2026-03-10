<?php

namespace App\Filament\Admin\Resources\Hotels;

use App\Filament\Admin\Resources\Hotels\Pages\CreateHotel;
use App\Filament\Admin\Resources\Hotels\Pages\EditHotel;
use App\Filament\Admin\Resources\Hotels\Pages\ListHotels;
use App\Filament\Admin\Resources\Hotels\Schemas\HotelForm;
use App\Filament\Admin\Resources\Hotels\Tables\HotelsTable;
use App\Models\Hotel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HotelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HotelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHotels::route('/'),
            'create' => CreateHotel::route('/create'),
            'edit' => EditHotel::route('/{record}/edit'),
        ];
    }
}
