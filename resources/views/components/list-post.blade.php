<div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}" />
                </a>
            </div>
        @empty
            <p class="text-sm font-bold text-center text-gray-600 uppercase">No hay Post</p>
        @endforelse

    </div>
    <div class="my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
