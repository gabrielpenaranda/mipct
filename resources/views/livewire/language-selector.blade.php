<div>
    <div class="w-full flex">
        <label hidden for="language">Language</label>
        <select wire:model.live="language" name="language" class="form-select">
            <option value="es">{{ __('messages.español') }}</option>
            <option value="fr">{{ __('messages.frances') }}</option>
            <option value="en">{{ __('messages.ingles') }}</option>
            <option value="pt">{{ __('messages.portugues') }}</option>
        </select>
    </div>
</div>
