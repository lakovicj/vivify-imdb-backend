<?php

namespace App\Services;

interface MovieService
{
    public function getAllMovies();
    public function getAllMoviesPaginated($page, $perPage = 10);
    public function getById($id);
    public function searchMovies($param, $page, $perPage);
}
