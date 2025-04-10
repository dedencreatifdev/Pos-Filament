@props([
'active' => false,
'activeChildItems' => false,
'activeIcon' => null,
'badge' => null,
'badgeColor' => null,
'badgeTooltip' => null,
'childItems' => [],
'first' => false,
'grouped' => false,
'icon' => null,
'last' => false,
'shouldOpenUrlInNewTab' => false,
'sidebarCollapsible' => true,
'subGrouped' => false,
'url',
])

@php
$sidebarCollapsible = $sidebarCollapsible && filament()->isSidebarCollapsibleOnDesktop();
@endphp

<li class="nav-item">
    <a {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }} @class([ 'nav-link' , 'active'=> $active
        ])>
        <i class="far fa-circle nav-icon"></i>
        <p>{{ $slot }}</p>
    </a>
</li>