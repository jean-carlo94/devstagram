@extends('layouts.app')

@section('title')
    Crear Publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="px-10 md:w-1/2">
            <form
                id="dropzone"
                action="{{ route('image.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded dropzone h-96"
            >
                @csrf
            </form>
            @error('image')
            <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                {{ $message }}
            </p>
        @enderror
        </div>
        <div class="p-10 bg-white border rounded-lg shadow-xl md:w-1/2">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="title" class="block mb-2 font-bold text-gray-500 uppercase">
                        Titulo
                    </label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        placeholder="Titulo de la publicación"
                        class="w-full p-3 border rounded-lg @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}"
                    />

                    @error('title')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="block mb-2 font-bold text-gray-500 uppercase">
                        Descripción
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Descripción de la publicación..."
                        rows="4"
                        cols="50"
                        class="w-full p-3 border rounded-lg @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input
                        id="image"
                        name="image"
                        type="hidden"
                        value="{{ old('image') }}"
                    />
                </div>

                <input
                    type="submit"
                    value="Crear Publicación"
                    class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700"
                />
            </form>
        </div>
    </div>
@endsection
