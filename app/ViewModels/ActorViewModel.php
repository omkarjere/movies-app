<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel {
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits) {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor() {
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->getProfileOrPlaceholder(),
            ]);
    }

    public function social() {
        return collect($this->social)->merge([
            'facebook_id' => $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : null,
            'instagram_id' => $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null,
            'twitter_id' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null,
        ]);
    }

    public function knownForMovies() {
        $castMovies = collect($this->credits)->get('cast');
        return collect($castMovies)
                ->sortByDesc('popularity')
                ->take(5)
                ->map(function($movie) {
                    $title = 'Untitled';

                    if(isset($movie['title']))
                        $title = $movie['title'];
                    elseif(isset($movie['name']))
                        $title = $movie['name'];

                    return collect($movie)->merge([
                        'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path'] : 'https://via.placeholder.com/185x278',
                        'title' => $title,
                        'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
                    ])->only([
                        'id', 'title', 'poster_path', 'linkToPage'
                    ]);
                });

    }

    public function credits() {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)
                ->map(function($movie) {
                    $releaseDate = '';
                    $title = 'Untitled';

                    if(isset($movie['release_date']))
                        $releaseDate = $movie['release_date'];
                    elseif(isset($movie['first_air_date']))
                        $releaseDate = $movie['first_air_date'];

                    if(isset($movie['title']))
                        $title = $movie['title'];
                    elseif(isset($movie['name']))
                        $title = $movie['name'];

                    return collect($movie)->merge([
                        'release_date' => $releaseDate,
                        'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                        'title' => $title,
                        'character' => isset($movie['character']) ? $movie['character'] : '',
                    ])->only([
                        'release_date', 'release_year', 'title', 'character'
                    ]);
                })
                ->sortByDesc('release_date');
    }

    private function getProfileOrPlaceholder() {
        return $this->actor['profile_path'] ? 'https://image.tmdb.org/t/p/w300' . $this->actor['profile_path'] : 'https://ui-avatars.com/api/?size=235&name=' . $this->actor['name'];
    }
}

