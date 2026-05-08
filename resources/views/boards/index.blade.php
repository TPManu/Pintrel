<x-app-layout>
    <div class="p-6 m-10 font-black text-4xl flex justify-between">
        <h1>Your saved ideas</h1>

        <livewire:boards.create />
    </div>

    <div class="p-6">
        @foreach ($boards as $board)
            <livewire:boards.card :board="$board" :key="$board->id" />
        @endforeach
    </div>
</x-app-layout>
