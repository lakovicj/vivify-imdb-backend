<?php

namespace App\Services;

use App\Movie;
use Illuminate\Support\Facades\DB;

class MovieServiceImpl implements MovieService
{
    public function getAllMovies()
    {
        return Movie::with('genre')
                    ->with('reactions')
                    ->get();
    }

    public function getAllMoviesPaginated($page, $perPage = 10)
    {
        $paginatedMovies = Movie::with('genre')
                            ->with('reactions')
                            ->paginate($perPage, ['*'], 'page', $page);
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
        return Movie::with('genre')
                    ->with('reactions')
                    ->find($id);
    }

    public function searchMovies($param, $page, $perPage)
    {
        $paginatedResults = Movie::with('genre')
                                ->with('reactions')
                                ->where('title', $param)
                                ->paginate($perPage, ['*'], 'page', $page);
        $retArray = array(
            'movies' => $paginatedResults->items(),
            'currentPage' => $paginatedResults->currentPage(),
            'perPage' => $paginatedResults->perPage(),
            'totalMovies' => $paginatedResults->total()
        );
        return $retArray;
    }

    public function filterMovies($genreFilter, $page, $perPage)
    {
        $paginatedResults = Movie::with('genre')
                                ->with('reactions')
                                ->where('genre_id', $genreFilter)
                                ->paginate($perPage, ['*'], 'page', $page);
        $retArray = array(
            'movies' => $paginatedResults->items(),
            'currentPage' => $paginatedResults->currentPage(),
            'perPage' => $paginatedResults->perPage(),
            'totalMovies' => $paginatedResults->total()
        );
        return $retArray;
    }

    public function incrementViewCount($movieId)
    {
        $movie = Movie::find($movieId);
        $movie->view_count++;
        $movie->save();
        return $movie;
    }

    public function getPopularMovies($num = 10)
    {
        $reactions = DB::table('reactions')
                        ->select('movie_id', DB::raw('count(id) as likes'))
                        ->where('type', '=', 'like')
                        ->groupBy('movie_id');

        $popularMovies = DB::table('movies')
                    ->joinSub($reactions, 'most_likes', function($join) {
                        $join->on('movies.id', '=', 'most_likes.movie_id');
                    })
                    ->orderByDesc('likes')
                    ->take($num)
                    ->get();

        return $popularMovies;
    }

    public function searchMovies($param, $page, $perPage)
    {
        $paginatedResults = Movie::with('genre')->where('title', $param)->paginate($perPage, ['*'], 'page', $page);
        $retArray = array(
            'movies' => $paginatedResults->items(),
            'currentPage' => $paginatedResults->currentPage(),
            'perPage' => $paginatedResults->perPage(),
            'totalMovies' => $paginatedResults->total()
        );
        return $retArray;
    }
}
