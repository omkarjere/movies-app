<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    private function fakePopluarMovies() {
        return Http::response([
            'results' => [
                [
                    "popularity" => 280.415,
                    "vote_count" => 1850,
                    "video" => false,
                    "poster_path" => "/s1cVTQEZYn4nSjZLnFbzLP0j8y2.jpg",
                    "id" => 8619,
                    "adult" => false,
                    "backdrop_path" => "/m11Mej9vbQqcXWgYrgPboCJ9NUh.jpg",
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "genre_ids" => [12,18,10752],
                    "title" => "Fake Movie",
                    "vote_average" => 7,
                    "overview" => "Fake movie description",
                    "release_date" => "2003-11-14"
                ]
            ]
        ], 200);
    }

    private function fakeNowPlayingMovies() {
        return Http::response([
            'results' => [
                [

                    "popularity" => 406.677,
                    "vote_count" => 2607,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "genre_ids" => [
                        12,
                        18,
                        9648,
                        878,
                        53,
                    ],
                    "title" => "Now Playing Fake Movie",
                    "vote_average" => 6,
                    "overview" => "Now playing fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }

    private function fakeGenres() {
        return Http::response([
            'genres' => [
                [
                  "id" => 28,
                  "name" => "Action"
                ],
                [
                  "id" => 12,
                  "name" => "Adventure"
                ],
                [
                  "id" => 16,
                  "name" => "Animation"
                ],
                [
                  "id" => 35,
                  "name" => "Comedy"
                ],
                [
                  "id" => 80,
                  "name" => "Crime"
                ],
                [
                  "id" => 99,
                  "name" => "Documentary"
                ],
                [
                  "id" => 18,
                  "name" => "Drama"
                ],
                [
                  "id" => 10751,
                  "name" => "Family"
                ],
                [
                  "id" => 14,
                  "name" => "Fantasy"
                ],
                [
                  "id" => 36,
                  "name" => "History"
                ],
                [
                  "id" => 27,
                  "name" => "Horror"
                ],
                [
                  "id" => 10402,
                  "name" => "Music"
                ],
                [
                  "id" => 9648,
                  "name" => "Mystery"
                ],
                [
                  "id" => 10749,
                  "name" => "Romance"
                ],
                [
                  "id" => 878,
                  "name" => "Science Fiction"
                ],
                [
                  "id" => 10770,
                  "name" => "TV Movie"
                ],
                [
                  "id" => 53,
                  "name" => "Thriller"
                ],
                [
                  "id" => 10752,
                  "name" => "War"
                ],
                [
                  "id" => 37,
                  "name" => "Western"
                ],
            ]
        ], 200);
    }

    /** @test */
    public function theMainPageShowsCorrectInfo() {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopluarMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Adventure, Drama, War');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }
}
