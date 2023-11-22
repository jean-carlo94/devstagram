@extends('layouts.app')

@section('title')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="w-1/2 p-6 bg-white shadow md:">
            <form
                action="{{ route('profile.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="mt-10 md:mt-0"
            >
                @csrf
                <div class="mb-5">

                    <label for="image" class="block mb-2 font-bold text-gray-500 uppercase">
                        <div class="flex flex-col items-center justify-center gap-2">
                            <img id="showImg" class="w-1/3 rounded-full cursor-pointer hover:blur-sm" src="{{ asset( auth()->user()->image ? 'profiles/' . auth()->user()->image : 'img/usuario.svg') }}" />
                            Cambiar Imagen Perfil
                        </div>
                    </label>
                    <input
                        id="image"
                        name="image"
                        type="file"
                        class="hidden"
                        accept=".jgp, .jpeg, .png"
                    />
                </div>
                <div class="mb-5">
                    <label for="name" class="block mb-2 font-bold text-gray-500 uppercase">
                        Nombre
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Tu Nombre"
                        class="w-full p-3 border rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') ?? auth()->user()->name }}"
                    />

                    @error('name')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="block mb-2 font-bold text-gray-500 uppercase">
                        Username
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        class="w-full p-3 border rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('username') ?? auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 font-bold text-gray-500 uppercase">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Correo Electrónico"
                        class="w-full p-3 border rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') ?? auth()->user()->email }}"
                    />

                    @error('email')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                @if (session('message'))
                    <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                        {{ session('message')}}
                    </p>
                @endif

                <div class="mb-5">
                    <label for="password" class="block mb-2 font-bold text-gray-500 uppercase">
                        Contraseña Actual
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Contraseña Actual"
                        class="w-full p-3 border rounded-lg @error('password') border-red-500 @enderror"
                    />

                    @error('password')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password" class="block mb-2 font-bold text-gray-500 uppercase">
                        Nueva Contraseña
                    </label>
                    <input
                        id="new_password"
                        name="new_password"
                        type="password"
                        placeholder="Nueva Contraseña"
                        class="w-full p-3 border rounded-lg @error('new_password') border-red-500 @enderror"
                    />

                    @error('new_password')
                        <p class="p-2 my-2 text-sm font-bold text-center text-white bg-red-500 rounded-lg">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password_confirmation" class="block mb-2 font-bold text-gray-500 uppercase">
                        Confirmar Nuevo Contraseña
                    </label>
                    <input
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        type="password"
                        placeholder="Confirmar Contraseña"
                        class="w-full p-3 border rounded-lg @error('new_password') border-red-500 @enderror"
                    />
                </div>

                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700"
                />
            </form>
        </div>
    </div>
@endsection
