<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                    {{ $greeting }}, {{ $userName }} 👋
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Guru • SIAKAD SMK
                </p>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-900 px-4 py-2 rounded-xl border border-gray-150 dark:border-gray-800">
                <x-heroicon-o-calendar class="w-5 h-5 text-gray-400" />
                <span>{{ $date }}</span>
                <span class="text-gray-300 dark:text-gray-700">|</span>
                <x-heroicon-o-clock class="w-5 h-5 text-gray-400" />
                <span class="font-semibold">{{ $time }}</span>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
