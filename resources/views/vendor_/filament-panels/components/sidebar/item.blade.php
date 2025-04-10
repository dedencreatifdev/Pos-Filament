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
        <i class="nav-icon fas fa-th"></i>
        <p>
            Widgets
            <span class="right badge badge-danger">New</span>
        </p>
    </a>
</li>