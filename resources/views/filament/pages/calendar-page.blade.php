<x-filament-panels::page>
    @if ($calendarType === 'midwife')
        @livewire('midwife-calendar-component')
    @endif

    @if ($calendarType === 'clinic')
        @livewire('clinic-calendar-component')
    @endif
</x-filament-panels::page>
