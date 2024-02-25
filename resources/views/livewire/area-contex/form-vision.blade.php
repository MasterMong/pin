<div>
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit" class="btn btn-secondary text-dark">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
