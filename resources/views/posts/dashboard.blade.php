@extends('layouts.app')

@section('title')
    Perfil: {{ $user->username }}
@endsection

@section('content')

    <div class="flex justify-center">
        <div class="flex flex-col items-center w-8/12 md:flex-row lg:w-6/12">
            <div class="w-8/12 px-5 lg:w-6/12">
                <img class="rounded-full" src="{{ asset( $user->image ? 'profiles/' . $user->image : 'img/usuario.svg') }}" />
            </div>
            <div class="flex flex-col items-center px-5 py-10 md:w-8/12 lg:w-6/12 md:justify-center md:py-10 md:items-start">
                <div class="flex items-center gap-2">
                    <p class="text-2xl text-gay-700">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a
                                href="{{ route('profile.index') }}"
                                class="cursor-pointer text-gay-500 hover:text-gray-600"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{ $user->followersMe->count() }}
                    <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followersMe->count())</span>
                </p>

                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{ $user->followingTo->count() }}
                    <span class="font-normal">Siguiendo</span>
                </p>

                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth()
                    @if ($user->id !== auth()->user()->id)

                        @if ($user->following( auth()->user() ))
                            <form
                                action="{{ route('users.unfollow', $user) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                <input
                                    type="submit"
                                    class="px-3 py-1 text-xs font-bold text-white uppercase bg-red-600 rounded-lg cursor-pointer"
                                    value="Dejar de seguir"
                                />
                            </form>
                        @else
                            <form
                                action="{{ route('users.follow', $user) }}"
                                method="POST"
                            >
                                @csrf
                                <input
                                    type="submit"
                                    class="px-3 py-1 text-xs font-bold text-white uppercase bg-blue-600 rounded-lg cursor-pointer"
                                    value="Seguir"
                                />
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section>
        <h2 class="my-10 text-4xl font-black text-center">Publicaciones</h2>
        <x--list-post :posts="$posts" />
    </section>

@endsection
