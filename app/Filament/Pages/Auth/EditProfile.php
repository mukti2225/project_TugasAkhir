<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar')
                ->label('Foto Profil')
                ->avatar()
                ->image()
                ->disk('public')
                ->directory('avatars')
                ->visibility('public')
                ->imageEditor()
                ->circleCropper()
                ->maxSize(1024)
                ->alignCenter(),

            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
        ])
        ->columns(1);
    }
}
