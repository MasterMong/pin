<div>
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit" class="p-2 bg-primary-500 text-white rounded-lg mt-4 cursor-pointer">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
