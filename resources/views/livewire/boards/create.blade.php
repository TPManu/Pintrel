<?php

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state, rules, on};

state([
    'showModal' => false,
    'name' => '',
    'description' => '',
    'visibility' => 'public',
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string'],
    'visibility' => ['required', 'in:public,private'],
]);

on([
    'open-modal' => fn () => $this->showModal = true,

]);


$close = fn () => $this->showModal = false;

$save = function () {
    $validated = $this->validate();

    Board::create([
        ...$validated,
        'user_id' => Auth::id(),
    ]);

    $this->reset(['name', 'description']);
    $this->visibility = 'public';
    $this->showModal = false;

    // optional: refresh boards without redirect later
    $this->dispatch('board-created');
};

?>
<div>
        <button
            wire:click="$dispatch('open-modal')"
            class="bg-black text-white px-4 py-2 rounded-lg font-bold">
            Create board
        </button>

@if ($showModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 w-full max-w-xl">
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold">Create Board</h2>
                <button wire:click="close">×</button>
            </div>

            <form wire:submit="save" class="space-y-4">
                <input wire:model="name" placeholder="Name" class="border p-2 w-full" />
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror

                <textarea wire:model="description" class="border p-2 w-full"></textarea>

                <select wire:model="visibility" class="border p-2 w-full">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>

                <button class="bg-black text-white px-4 py-2 rounded">
                    Save
                </button>
            </form>
        </div>
    </div>
@endif
</div>