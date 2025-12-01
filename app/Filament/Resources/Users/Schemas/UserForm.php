<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Users\Pages\CreateUser;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            // Basic info
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            // Password (only required on create; optional on edit)
            TextInput::make('password')
                ->label('Password')
                ->password()
                ->minLength(8)
                ->maxLength(255)
                ->dehydrateStateUsing(function ($state) {
                    // only hash when a value was provided
                    return filled($state) ? bcrypt($state) : null;
                })
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn ($livewire) => $livewire instanceof CreateUser),
        ]);
    }
}
