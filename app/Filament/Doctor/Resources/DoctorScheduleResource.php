<?php

namespace App\Filament\Doctor\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DoctorSchedule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Doctor\Resources\DoctorScheduleResource\Pages;
use App\Filament\Doctor\Resources\DoctorScheduleResource\RelationManagers;

class DoctorScheduleResource extends Resource
{
    protected static ?string $model = DoctorSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    // Forms\Components\Select::make('doctor_id')
                    //     ->relationship(
                    //         name: 'doctor',
                    //         titleAttribute: 'doctor_id',
                    //         )
                    //     ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                    //     ->searchable()
                    //     ->preload()
                    //     ->required(),
                    Forms\Components\Select::make('available_day')
                        ->options([
                            1 => 'Sunday',
                            2 => 'Monday',
                            3 => 'Tuesday',
                            4 => 'Wednesday',
                            5 => 'Thursday',
                            6 => 'Friday',
                            7 => 'Saturday',
                        ])
                        ->required(),
                    Forms\Components\TimePicker::make('start_time'),
                    Forms\Components\TimePicker::make('end_time'),
                ])
                    ->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('doctor_id', auth()->user()->doctor->id))
            ->columns([
                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->label('Doctor Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_day')
                    ->formatStateUsing(fn($state) => match ($state) {
                        1 => 'Sunday',
                        2 => 'Monday',
                        3 => 'Tuesday',
                        4 => 'Wednesday',
                        5 => 'Thursday',
                        6 => 'Friday',
                        7 => 'Saturday',
                        default => 'Unknown',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDoctorSchedules::route('/'),
            'create' => Pages\CreateDoctorSchedule::route('/create'),
            'view' => Pages\ViewDoctorSchedule::route('/{record}'),
            'edit' => Pages\EditDoctorSchedule::route('/{record}/edit'),
        ];
    }
}
