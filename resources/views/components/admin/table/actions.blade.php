@props([
    'item',
    'view' => null,
    'edit' => null,
    'delete' => null,
    'permission' => null,
])

@if($view && (!$permission || auth()->user()?->can("view {$permission}")))
    <x-buttons.button
        href="{{ $view }}"
        color="info"
        icon="eye"
    />
@endif

@if($edit && (!$permission || auth()->user()?->can("edit {$permission}")))
    <x-buttons.button
        href="{{ $edit }}"
        color="warning"
        icon="edit"
    />
@endif

@if($delete && (!$permission || auth()->user()?->can("delete {$permission}")))
    <x-buttons.button
        type="button"
        color="danger"
        icon="trash"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $item->id }}"
    />
@endif