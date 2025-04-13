<?php

namespace App\Livewire\Profile;

use App\Enum\LeagueStatus;
use App\Models\League;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileImageForm extends Component implements HasForms
{
    use WithFileUploads, InteractsWithForms;

    public ?array $formFields;

    public function render()
    {
        return view('livewire.profile.update-profile-image-form');
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function update()
    {


        $logo = $this->form->getState()['logo'];

        // Add the logo to the clubs media
        Auth::user()->addMedia(storage_path('app/public/'. $logo))
            ->toMediaCollection('image');

        $this->form->fill();

        $this->dispatch('toast', 'Profile image updated successfully');

        $this->render();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo')->required(),
            ])->statePath('formFields');
    }
}
