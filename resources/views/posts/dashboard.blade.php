@extends('layouts.app')

@section('title')
    Perfil: {{ $user->username }}
@endsection

@section('content')

    <div class="flex justify-center">
        <div class="flex flex-col items-center w-8/12 md:flex-row lg:w-6/12">
            <div class="w-8/12 px-5 lg:w-6/12">
                <img src="{{ asset('img/usuario.svg') }}" />
            </div>
            <div class="flex flex-col items-center px-5 py-10 md:w-8/12 lg:w-6/12 md:justify-center md:py-10 md:items-start">
                <p class="text-2xl text-gay-700">{{ $user->username }}</p>

                <p class="mb-3 text-sm font-bold text-gray-800">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>

                <p class="mb-3 text-sm font-bold text-gray-800">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>

                <p class="mb-3 text-sm font-bold text-gray-800">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>

    <section>
        <h2 class="my-10 text-4xl font-black text-center">Publicaciones</h2>
        @if ($posts->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['user' => $user, 'post' => $post]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}" />
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="my-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-sm font-bold text-center text-gray-600 uppercase">No hay posts</p>
        @endif
    </section>

@endsection
