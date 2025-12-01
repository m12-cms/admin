<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\Pages\CreateUser;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                ->dehydrateStateUsing(function ($state): ?string {
                    // only hash when a non-empty string value was provided
                    if (! is_string($state) || $state === '') {
                        return null;
                    }

                    // bcrypt expects a string
                    return bcrypt($state);
                })
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn ($livewire) => $livewire instanceof CreateUser),
        ]);
    }
}
