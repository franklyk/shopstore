@props(['statusId', 'statuses', 'name' => 'status_id'])

@php

    $activeStatus = $statuses->firstWhere('slug', 'active');
    $inactiveStatus = $statuses->firstWhere('slug', 'inactive');

    $isActive = (int) $statusId === (int) $activeStatus?->id;

@endphp

<div class="status-button-wrapper">

    <button type="button" class="status-button {{ $isActive ? 'active' : '' }}" data-active-id="{{ $activeStatus?->id }}"
        data-inactive-id="{{ $inactiveStatus?->id }}" data-input="{{ $name }}">

        <span class="status-button-track">
            <span class="status-button-thumb"></span>
        </span>

        <span class="status-button-label">
            {{ $isActive ? $activeStatus->name : $inactiveStatus->name }}
        </span>

    </button>

    <input type="hidden" name="{{ $name }}" value="{{ $statusId }}">

</div>
