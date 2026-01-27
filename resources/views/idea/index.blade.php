<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-card x-data @click="$dispatch('open-modal', 'create-idea')" is="button" type="button" class="mt-10 cursor-pointer w-full h-32 text-left">
                <p>What's the idea?</p>
            </x-card>
        </header>

        <div>
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>
            @foreach (App\IdeaStatus::cases() as $status )
            <a href="/ideas?status={{ $status->value }}" class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                {{ $status->label() }}
                <span class="text-xs pl-3">{{ $statusCounts->get($status->value, 0) }}</span>
            </a>
            @endforeach
        </div>

        <div class="mt-10 text-muted-foreground">
            <ul class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                <li>
                    <x-card href="{{ route('idea.show', $idea) }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status}}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>
                        <div class=" mt-5 line-clamp-3">{{ $idea->description }}
                        </div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                </li>
                @empty
                <x-card>
                    <p>No ideas at this time</p>
                </x-card>
                @endforelse
            </ul>
        </div>

    </div>

    <x-modal name="create-idea" title="New Idea">
        <form x-data="{status: 'pending'}" method="POST" action="{{ route('idea.store') }}">
            @csrf
            <div class="flex flex-col gap-6">
                <x-form.field label="Title" name="title" placeholder="Enter an idea for your title" autofocus />

                <div class="space-y-2">
                    <label for="status" class="label">Status</label>
                    <div class="flex gap-x-3">
                        @foreach (App\IdeaStatus::cases() as $status )
                        <button type="button" @click="status = @js($status->value)" class="btn flex-1 h-10 my-2" :class="{'btn-outlined': status !== @js($status->value)}">{{ $status->label() }}</button>

                        @endforeach

                        <x-form.error name="status" />
                        <input type="hidden" name="status" :value="status" class="input" />
                    </div>
                </div>

                <x-form.field label=" Description" name="description" type="textarea" placeholder="Describe your idea..." />
            </div>

            <div class="flex justify-end gap-x-5">
                <button @click="$dispatch('close-modal')" type="button">Cancel</button>
                <button type="submit" class="btn">Create</button>
            </div>
        </form>
    </x-modal>

    </div>

    </div>
    </div>
</x-layout>
