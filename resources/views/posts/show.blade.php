@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image}}" alt="Imagen del post {{ $post->title }}" />
            <div class="p-3">
                <p>0 Likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500 capitalize">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>
        </div>
        <div class="p-5 md:w-1/2">
            <div class="p-5 mb-5 bg-white shadow">
                @auth
                    <p class="mb-4 text-xl font-bold text-center">Agregar un Nuevo Comentario</p>
                    @if (session('message'))
                        <div class="p-2 mb-6 font-bold text-center text-white uppercase bg-green-500 rounded-lg">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('comments.store', ['user' => $post->user->username, 'post'=>$post]) }}" method="POST">
                        @csrf
                        <label for="comment" class="block mb-2 font-bold text-gray-500 uppercase">
                            Añade un Comentario
                        </label>
                        <textarea
                            id="comment"
                            name="comment"
                            placeholder="Descripción de la publicación..."
                            rows="4"
                            cols="50"
                            class="w-full p-3 border rounded-lg @error('comment') border-red-500 @enderror"
                        >{{ old('comment') }}</textarea>

                        @error('comment')
                            <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                                {{ $message }}
                            </p>
                        @enderror

                        <input
                            type="submit"
                            value="Crear Publicación"
                            class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700"
                        />
                    </form>
                @endauth

                <div class="mt-10 mb-5 overflow-y-scroll bg-white shadow max-h-96">
                    @if ($post->comments->count())
                        @foreach ( $post->comments as $comment )
                            <div class="p-5 border-b border-gray-300">
                                <a href="{{ route('posts.index', $comment->user->username) }}" class="font-bold">{{ $comment->user->username }}</a>
                                <p>{{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aun</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
