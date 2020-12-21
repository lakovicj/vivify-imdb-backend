<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GenreService;

class GenreController extends Controller
{

    protected $genreService;

    public function __construct(GenreService $gs)
    {
        $this->genreService = $gs;
    }

    public function getAllGenres()
    {
        return $this->genreService->getAllGenres();
    }
}
