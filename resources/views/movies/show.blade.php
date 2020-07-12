@extends('layouts.main')

@section('content')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="no-flex">
            <img src="{{ $movie['poster_path'] }}" class="w-64 md:w-96"
                alt="parasite">
        </div>
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{ $movie['title'] }}
                ({{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }})</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
                <svg class="fill-current w-4 text-orange-500" viewBox="0 0 24 24">
                    <path class="heroicon-ui"
                        d="M6.1 21.98a1 1 0 01-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 01.56-1.71l6.05-.88 2.7-5.48a1 1 0 011.8 0l2.7 5.48 6.06.88a1 1 0 01.55 1.7l-4.38 4.27 1.04 6.03a1 1 0 01-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 01.93 0l4.08 2.15-.78-4.55a1 1 0 01.29-.88l3.3-3.22-4.56-.67a1 1 0 01-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 01-.75.54l-4.57.67 3.3 3.22a1 1 0 01.3.88l-.79 4.55 4.09-2.15z" />
                </svg>
                <span class="ml-1">{{ $movie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                    {{ $movie['release_date'] }}
                <span class="mx-2">|</span>
                {{ $movie['genres'] }}
            </div>
            <p class="text-gray-400 mt-10">{{ $movie['overview'] }}</p>
            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Cast</h4>
                <div class="flex mt-4">
                    @foreach ($movie['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div x-data="{ isOpen : false}">
            @if(count($movie['videos']['results']) > 0)
            <div class="mt-12">
                <button @click="isOpen = true"
                    class="bg-orange-500 flex inline-flex items-center text-black rounded hover:bg-orange-600 transition ease-in-out duration-150 font-semibold px-5 py-4">
                    <svg class="w-8 fill-current" viewBox="0 0 24 24">
                        <path class="heroicon-ui"
                            d="M16 8.38l4.55-2.27A1 1 0 0122 7v10a1 1 0 01-1.45.9L16 15.61V17a2 2 0 01-2 2H4a2 2 0 01-2-2V7c0-1.1.9-2 2-2h10a2 2 0 012 2v1.38zm0 2.24v2.76l4 2V8.62l-4 2zM14 17V7H4v10h10z" />
                    </svg>
                    <span class="ml-2">Play Trailer</span>
                </button>
            </div>
            @endif

            <div style="background-color: rgba(0,0,0,0.5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show.transition.opacity="isOpen">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                <iframe width="560" height="315"
                                    class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                                    style="border: 0;" allow="autoplay; encrypted-media" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of modal -->
        </div>
        <!-- end of modal wrapper -->
    </div>
</div>
</div>
<!-- end movie info -->
<!-- movie cast -->
<div class="movie-cast">
    <div class="container mx-auto px-4 py-4">
        <h2 class="text-4xl font-semibold">
            Cast
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($movie['cast'] as $cast)
                <div class="mt-8">
                    <a href="{{ route('actors.show', $cast['id']) }}">
                        <img src="https://image.tmdb.org/t/p/w500{{ $cast['profile_path'] }}" alt="parasite"
                            class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        {{ $cast['name'] }}
                    </div>
                    <div class="text-sm">
                        {{ $cast['character'] }}
                    </div>
                </div>
            @endforeach
    </div>
</div>
</div>
<!-- end movie cast -->
<!-- movie images -->
<div class="movie-images" x-data="{ isOpen : false, image : ''}">
    <div class="container mx-auto px-4 py-4">
        <h2 class="text-4xl font-semibold">
            Images
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-2">
            @foreach ($movie['images'] as $image)
                <a href="#"
                    @click.prevent="
                        isOpen = true
                        image = 'https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}'"
                >
                    <img src="https://image.tmdb.org/t/p/w500{{ $image['file_path'] }}" alt="image1">
                </a>
            @endforeach
        </div>
    </div>
    <div style="background-color: rgba(0,0,0,0.5);"
        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
        x-show.="isOpen">
        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
            <div class="bg-gray-900 rounded">
                <div class="flex justify-end pr-4 pt-2">
                    <button @click="isOpen = false" @keydown.escape.window="isOpen=false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                </div>
                <div class="modal-body px-8 py-8">
                    <img :src="image" alt="image_large">
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal -->
</div>
@endsection
