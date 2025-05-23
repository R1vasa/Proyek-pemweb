@props(['post'])


@if($post)
    {{-- Single post display for profile --}}
    <div class="bg-white border-1 mx-auto max-w-[650px] w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0">
        <div class="flex justify-between">
            <div class="flex flex-row">
                <div>
                    <img src="{{ asset('storage/' . $post->user->profile ?? 'img/profile.png') }}" 
                         alt="Profile" 
                         class="max-w-[40px] max-h-[40px]">
                </div>
                <div class="px-4">
                    <h3 class="font-bold">{{ $post->user->username }}</h3>
                    <p class="text-sm text-justify">{{ $post->content }}</p>
                </div>
            </div>
            <p class="text-xl cursor-pointer">•••</p>
        </div>
        {{-- Rest of your single post display code --}}
    </div>
@else
    {{-- Display all posts --}}
    @foreach($posts as $post)
        <div class="bg-white border-1 mx-auto max-w-[650px] w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <img src="{{ asset('storage/' . $post->user->profile ?? 'img/profile.png') }}" 
                             alt="Profile" 
                             class="max-w-[40px] max-h-[40px]">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">{{ $post->user->username }}</h3>
                        <p class="text-sm text-justify">{{ $post->content }}</p>
                    </div>
                </div>
                <p class="text-xl cursor-pointer">•••</p>
            </div>
            {{-- Rest of your post display code --}}
        </div>
    @endforeach
@endif