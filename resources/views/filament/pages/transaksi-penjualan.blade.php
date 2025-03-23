<x-filament-panels::page>
    <div x-data="{ state: $wire.$entangle('name') }">
        <input x-model="state" />
    </div>
</x-filament-panels::page>
