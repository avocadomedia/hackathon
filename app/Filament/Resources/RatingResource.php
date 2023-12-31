<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Livewire\CreateRating;
use App\Models\Rating;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                ])->schema(CreateRating::getRatingFormFields()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->hidden(),
                Tables\Columns\TextColumn::make('latitude')
                    ->hidden(),
                Tables\Columns\TextColumn::make('zip')
                    ->label('Postal code'),
                Tables\Columns\TextColumn::make('house_number')
                    ->label('House number'),
                Tables\Columns\TextColumn::make('score')
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
