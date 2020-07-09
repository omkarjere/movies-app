<div class="mt-8">
  <a href="{{ route('movies.show', $movie['id']) }}">
    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="parasite"
      class="hover:opacity-75 transition ease-in-out duration-150">
  </a>
  <div class="mt-2">
    <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
    <div class="flex items-center text-gray-400 text-sm">
      <svg class="fill-current w-4 text-orange-500" viewBox="0 0 24 24">
        <path class="heroicon-ui"
          d="M6.1 21.98a1 1 0 01-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 01.56-1.71l6.05-.88 2.7-5.48a1 1 0 011.8 0l2.7 5.48 6.06.88a1 1 0 01.55 1.7l-4.38 4.27 1.04 6.03a1 1 0 01-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 01.93 0l4.08 2.15-.78-4.55a1 1 0 01.29-.88l3.3-3.22-4.56-.67a1 1 0 01-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 01-.75.54l-4.57.67 3.3 3.22a1 1 0 01.3.88l-.79 4.55 4.09-2.15z" />
      </svg>
      <span class="ml-1">{{ $movie['vote_average'] * 10}}%</span>
      <span class="mx-2">|</span>
      <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
    </div>
    <div class="text-gray-400 text-sm">
      @foreach($movie['genre_ids'] as $genre_id)
        {{ $genres[$genre_id] }}@if(!$loop->last), @endif
      @endforeach
    </div>
  </div>
</div>

