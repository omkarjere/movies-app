@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-tv">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Popular Shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            <!-- Card -->
            @foreach($popularTv as $tvShow)
                <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>
    <!-- end popular tv -->

    <div class="top-rated-shows">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg mt-24 font-semibold">
            Top Rated Shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            <!-- Card -->
            @foreach($topRatedTv as $topShow)
                <x-tv-card :tvShow="$topShow" />
            @endforeach
        </div>
    </div>
    <!-- end top-rated-shows -->
</div>
@endsection
