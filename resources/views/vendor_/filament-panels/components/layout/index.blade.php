@php
use Filament\Support\Enums\MaxWidth;

$navigation = filament()->getNavigation();
@endphp

<x-filament-panels::layout.base :livewire="$livewire">

    <div class="wrapper">
        <x-filament-panels::sidebar :navigation="$navigation" />
    </div>

</x-filament-panels::layout.base>