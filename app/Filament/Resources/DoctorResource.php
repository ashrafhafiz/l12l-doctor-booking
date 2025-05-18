<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Doctor;
use App\Models\Hospital;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DoctorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Filament\Resources\DoctorResource\RelationManagers;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Doctor Information')
                    ->description('Enter doctor information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name', fn(Builder $query) => $query->where('role', 'doctor'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required(),
                                Forms\Components\DateTimePicker::make('email_verified_at'),
                                Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->required(),
                                Forms\Components\Select::make('role')
                                    ->options([
                                        'patient' => 'Patient',
                                        'doctor' => 'Doctor',
                                        'admin' => 'Admin',
                                    ])
                                    ->required(),
                            ]),
                        Forms\Components\Select::make('speciality_id')
                            ->relationship('speciality', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('hospital_id')
                            ->relationship('hospital', 'name')
                            // ->options(function () {
                            //     return Hospital::all()->pluck('name', 'id');
                            // })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('address')
                                    ->required(),
                                Forms\Components\TextInput::make('phone')
                                    ->tel(),
                                Forms\Components\TextInput::make('email')
                                    ->email(),
                                Forms\Components\TextInput::make('website'),
                                Forms\Components\FileUpload::make('image')
                                    ->disk('public')
                                    ->directory('hospitals')
                                    ->preserveFilenames()
                                    ->visibility('public')
                                    ->image(),
                                Forms\Components\TextInput::make('description'),
                            ]),
                        Forms\Components\Textarea::make('bio')
                            ->columnSpanFull(),
                    ])->columnSpan(2),

                Forms\Components\Section::make('Doctor Profile Information')
                    ->description('Enter doctor profile information')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Profile Image')
                            ->disk('public')
                            ->directory('doctors')
                            ->preserveFilenames()
                            ->visibility('public')
                            ->image(),
                        Forms\Components\TextInput::make('experience'),
                        Forms\Components\Toggle::make('is_featured'),
                    ])
                    // ->extraAttributes(['class' => 'bg-amber-50'], true)
                    // ->extraAttributes(['style' => 'background-color: rgb(255 251 235);'], true)
                    ->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Profile Image')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(asset('images/default-doctor2.svg')),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Doctor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('experience')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('hospital.name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'view' => Pages\ViewDoctor::route('/{record}'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
