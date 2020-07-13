<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ActorsTest extends TestCase {

    /** @test */
    public function theIndexPageShowsTheCorrectInfo() {
        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=1' => $this->fakePopularActors(),
        ]);

        $response = $this->get(route('actors.index'));
        $response->assertSuccessful();
        $response->assertSee('Popular Actors');
        $response->assertSee('Lisa Ann Walter');
        $response->assertSee('Bruce Almighty');
    }

    /** @test */
    public function theIndex2PageShowsTheCorrectInfo() {
        Http::fake([
            'https://api.themoviedb.org/3/person/popular?page=2' => $this->fakePopularActors2(),
        ]);

        $response = $this->get('/actors/page/2');
        $response->assertSuccessful();
        $response->assertSee('Popular Actors');
        $response->assertSee('Jack Black');
        $response->assertSee('Jumanji: The Next Level');
    }

    private function fakePopularActors() {
        return Http::response([
            'results' => [
                [
                    "popularity" => 57.381,
                    "known_for_department" => "Acting",
                    "gender" => 1,
                    "id" => 4494,
                    "profile_path" => "\/p3wxUblbPwRVzTp7jW1lXISKIob.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "release_date" => "2003-05-23",
                            "id" => 310,
                            "vote_count" => 7677,
                            "video" => false,
                            "media_type" => "movie",
                            "vote_average" => 6.7,
                            "title" => "Bruce Almighty",
                            "genre_ids" => [35,14],
                            "original_title" => "Bruce Almighty",
                            "original_language" => "en",
                            "adult" => false,
                            "backdrop_path" => "\/ofM56qg3KkLh5WIkTtJOuqCyJCG.jpg",
                            "overview" => "Bruce Nolan toils as a 'human interest' television reporter in Buffalo, N.Y., but despite his high ratings and the love of his beautiful girlfriend, Bruce remains unfulfilled. At the end of the worst day in his life, he angrily ridicules God—and the Almighty responds, endowing Bruce with all of His divine powers.",
                            "poster_path" => "\/3XJKBKh9Km89EoUEitVTSnrlAkZ.jpg"
                        ],
                        [
                            "release_date" => "2005-06-28",
                            "id" => 74,
                            "vote_count" => 5487,
                            "video" => false,
                            "media_type" => "movie",
                            "vote_average" => 6.4,
                            "title" => "War of the Worlds",
                            "genre_ids" => [12,878,53],
                            "original_title" => "War of the Worlds",
                            "original_language" => "en",
                            "adult" => false,
                            "backdrop_path" => "\/kJ5w8LEByIUCXus7mUADIs00cR8.jpg",
                            "overview" => "Ray Ferrier is a divorced dockworker and less-than-perfect father. Soon after his ex-wife and her new husband drop off his teenage son and young daughter for a rare weekend visit, a strange and powerful lightning storm touches down.",
                            "poster_path" => "\/6Biy7R9LfumYshur3YKhpj56MpB.jpg"
                        ],
                        [
                            "release_date" => "1998-07-28",
                            "id" => 9820,
                            "vote_count" => 2384,
                            "video" => false,
                            "media_type" => "movie",
                            "vote_average" => 7.1,
                            "title" => "The Parent Trap",
                            "genre_ids" => [35,10751],
                            "original_title" => "The Parent Trap",
                            "original_language" => "en",
                            "adult" => false,
                            "backdrop_path" => "\/mrYJ0ijgaxjHKAs0ybNYxyfP8l5.jpg",
                            "overview" => "Hallie Parker and Annie James are identical twins separated at a young age because of their parents' divorce. unknowingly to their parents, the girls are sent to the same summer camp where they meet, discover the truth about themselves, and then plot with each other to switch places. Hallie meets her mother, and Annie meets her father for the first time in years.",
                            "poster_path" => "\/a3XOGrrAjl1wwiumtACWBufg6AL.jpg"
                        ]
                    ],
                    "name" => "Lisa Ann Walter"
                ]
            ]
        ]);
    }
    private function fakePopularActors2() {
        return Http::response([
            'results' => [
                [
                    "popularity" => 57.381,
                    "known_for_department" => "Acting",
                    "gender" => 1,
                    "id" => 4494,
                    "profile_path" => "\/p3wxUblbPwRVzTp7jW1lXISKIob.jpg",
                    "adult" => false,
                    "known_for" => [
                        [
                            "release_date" => "2003-05-23",
                            "id" => 310,
                            "vote_count" => 7677,
                            "video" => false,
                            "media_type" => "movie",
                            "vote_average" => 6.7,
                            "title" => "Jumanji: The Next Level",
                            "genre_ids" => [35,14],
                            "original_title" => "Bruce Almighty",
                            "original_language" => "en",
                            "adult" => false,
                            "backdrop_path" => "\/ofM56qg3KkLh5WIkTtJOuqCyJCG.jpg",
                            "overview" => "Bruce Nolan toils as a 'human interest' television reporter in Buffalo, N.Y., but despite his high ratings and the love of his beautiful girlfriend, Bruce remains unfulfilled. At the end of the worst day in his life, he angrily ridicules God—and the Almighty responds, endowing Bruce with all of His divine powers.",
                            "poster_path" => "\/3XJKBKh9Km89EoUEitVTSnrlAkZ.jpg"
                        ],
                        [
                            "release_date" => "2005-06-28",
                            "id" => 74,
                            "vote_count" => 5487,
                            "video" => false,
                            "media_type" => "movie",
                            "vote_average" => 6.4,
                            "title" => "War of the Worlds",
                            "genre_ids" => [12,878,53],
                            "original_title" => "War of the Worlds",
                            "original_language" => "en",
                            "adult" => false,
                            "backdrop_path" => "\/kJ5w8LEByIUCXus7mUADIs00cR8.jpg",
                            "overview" => "Ray Ferrier is a divorced dockworker and less-than-perfect father. Soon after his ex-wife and her new husband drop off his teenage son and young daughter for a rare weekend visit, a strange and powerful lightning storm touches down.",
                            "poster_path" => "\/6Biy7R9LfumYshur3YKhpj56MpB.jpg"
                        ],
                        [
                            "release_date" => "1998-07-28",
                            "id" => 9820,
                            "vote_count" => 2384,
                            "video" => false,
                            "media_type" => "movie",
                            "vote_average" => 7.1,
                            "title" => "The Parent Trap",
                            "genre_ids" => [35,10751],
                            "original_title" => "The Parent Trap",
                            "original_language" => "en",
                            "adult" => false,
                            "backdrop_path" => "\/mrYJ0ijgaxjHKAs0ybNYxyfP8l5.jpg",
                            "overview" => "Hallie Parker and Annie James are identical twins separated at a young age because of their parents' divorce. unknowingly to their parents, the girls are sent to the same summer camp where they meet, discover the truth about themselves, and then plot with each other to switch places. Hallie meets her mother, and Annie meets her father for the first time in years.",
                            "poster_path" => "\/a3XOGrrAjl1wwiumtACWBufg6AL.jpg"
                        ]
                    ],
                    "name" => "Jack Black"
                ]
            ]
        ]);
    }
}
