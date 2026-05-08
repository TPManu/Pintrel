<?php

use App\Models\Board;
use function Livewire\Volt\{state, rules};

state([
    'name'        => '',
    'description' => '',
    'visibility'  => 'public',
]);

rules([
    'name'        => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string', 'max:1000'],
    'visibility'  => ['required', 'in:public,private'],
]);

$createBoard = function () {
    $validated = $this->validate();

    auth()->user()->boards()->create($validated);

    return $this->redirectRoute('boards.index', navigate: true);
};

?>

<div>
    <form wire:submit="createBoard">
        <input wire:model="name" type="text" placeholder="Board name">

        <textarea wire:model="description" placeholder="Description"></textarea>

        <select wire:model="visibility">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>

        <button type="submit">Create board</button>
    </form>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
</div>
