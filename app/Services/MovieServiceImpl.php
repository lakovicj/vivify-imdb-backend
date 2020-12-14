<?php

namespace App\Services;

use App\Movie;

class MovieServiceImpl implements MovieService
{
    public function getAllMovies()
    {
        return Movie::with('genre')->get();
    }

    public function getAllMoviesPaginated($page, $perPage = 10)
    {
        $paginatedMovies = Movie::with('genre')->paginate($perPage, ['*'], 'page', $page);
        $retArray = array(
            'movies' => $paginatedMovies->items(),
            'currentPage' => $paginatedMovies->currentPage(),
            'perPage' => $paginatedMovies->perPage(),
            'totalMovies' => $paginatedMovies->total()
        );
        return $retArray;
    }

    public function getById($id)
    {
        return Movie::with('genre')->find($id);
    }
}
