<x-layout>
    <div class="py-8 max-w-4xl mx-auto">
        <div class="flex justify-between">
            <a href={{ route('idea.index') }}>
                <- Back to Ideas </a>

                    <div class="flex items-center gap-x-3">
                        <button class="btn btn-outlined">Edit Idea</button>
                        <form method="POST" action={{ route('idea.destroy', $idea) }}>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outlined text-red-500">Delete</button>
                        </form>
                    </div>
        </div>

        <div class="mt-8 space-y-6">
            <h1 class="font-bold text-4xl">{{ $idea->title }}</h1>

            <div class="mt-2 flex gap-x-3 items-center">
                <x-idea.status-label :status="$idea->status->value">{{ $idea->status->label() }}</x-idea.status-label>
                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>
            <x-card class="mt-6">
                <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
            </x-card>

            @if ($idea->links->count())
            <div class="mt-3">
                <h3 class="font-bold text-xl mt-6">Links</h3>

                <div class="space-y-3 mt-3">
                    @foreach($idea->links as $link)
                    <x-card :href="$link" class="text-primary font-medium flex gap-x-3 item-center">{{ $link }}</x-card>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
</x-layout>
