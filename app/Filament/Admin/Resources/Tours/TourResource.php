<?php

namespace App\Filament\Admin\Resources\Tours;

use App\Filament\Admin\Resources\Tours\Pages\CreateTour;
use App\Filament\Admin\Resources\Tours\Pages\EditTour;
use App\Filament\Admin\Resources\Tours\Pages\ListTours;
use App\Filament\Admin\Resources\Tours\Schemas\TourForm;
use App\Filament\Admin\Resources\Tours\Tables\ToursTable;
use App\Models\Tour;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TourForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ToursTable::configure($table);
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
            'index' => ListTours::route('/'),
            'create' => CreateTour::route('/create'),
            'edit' => EditTour::route('/{record}/edit'),
        ];
    }
}
