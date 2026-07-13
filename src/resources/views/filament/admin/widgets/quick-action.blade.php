<x-filament-widgets::widget>
    <x-filament::section
        heading="Quick Action"
        description="Akses cepat untuk menambahkan data utama SIAKAD."
        icon="heroicon-m-bolt"
        icon-color="primary"
    >
        <x-filament::grid
            :default="1"
            :md="2"
            class="gap-3"
        >
            @foreach ($this->getQuickActions() as $action)
                <x-filament::grid.column>
                    {{ $action }}
                </x-filament::grid.column>
            @endforeach
        </x-filament::grid>

        <x-filament-actions::modals />
    </x-filament::section>
</x-filament-widgets::widget>
