<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Movie;
use App\Services\MovieService;

class MovieController extends Controller
{

    protected $movieService;

    public function __construct(MovieService $ms)
    {
        $this->movieService = $ms;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has(['page', 'perPage']))
        {
            $page = (int)$request->input('page');
            $perPage = (int)$request->input('perPage');

            $movies = $this->movieService->getAllMoviesPaginated($page, $perPage);
            return response()->json($movies, 200);
        }
        return $this->movieService->getAllMovies();
    }

    public function searchMovies(SearchRequest $request)
    {
        $data = $request->validated();
        $page = (int)$data['page'];
        $perPage = (int)$data['perPage'];
        $searchParam = $data['title'];
        $movies = $this->movieService->searchMovies($searchParam, $page, $perPage);
        return response()->json($movies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->movieService->getById($id);
        return response()->json($movie, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
