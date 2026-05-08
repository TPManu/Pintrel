<?php

use function Livewire\Volt\{state};

state(['board']);

?>

<div class="rounded-xl border p-4 mb-4 shadow-sm w-56">
    <h2 class="text-xl font-bold">
        {{ $board->name }}
    </h2>

    @if ($board->description)
        <p class="text-gray-600">
            {{ $board->description }}
        </p>
    @endif

    <p class="text-sm text-gray-400">
        Visibility: {{ $board->visibility }}
    </p>
</div>