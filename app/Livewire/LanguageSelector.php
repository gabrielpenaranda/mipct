<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LanguageSelector extends Component
{
    public string $language;

    public function mount()
    {
        $this->language = Session::get('locale', config('app.locale'));
    }

    public function updatedLanguage($value)
    {
        Session::put('locale', $value);

        $this->redirect(request()->header('Referer') ?? '/', navigate: false);
    }

    public function render()
    {
        return view('livewire.language-selector');
    }
}
