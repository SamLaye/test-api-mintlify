<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('code_reg')
                    ->required()
                    ->maxLength(4),
                Forms\Components\TextInput::make('superficie_km2')
                    ->numeric(),
                Forms\Components\TextInput::make('population_masculine')
                    ->numeric(),
                Forms\Components\TextInput::make('population_feminine')
                    ->numeric(),
                Forms\Components\TextInput::make('population')
                    ->numeric(),
                Forms\Components\TextInput::make('taux_scolarisation_globale')
                    ->numeric(),
                Forms\Components\TextInput::make('incidence_pauvrete')
                    ->numeric(),
                Forms\Components\TextInput::make('taux_alphabetisation_general')
                    ->numeric(),
                Forms\Components\TextInput::make('taux_enregistrement_etat_civil')
                    ->numeric(),
                Forms\Components\TextInput::make('densite')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code_reg')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('superficie_km2')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('population_masculine')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('population_feminine')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('population')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('taux_scolarisation_globale')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('incidence_pauvrete')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('taux_alphabetisation_general')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('taux_enregistrement_etat_civil')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('densite')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}
