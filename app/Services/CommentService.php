<?php

namespace App\Services;

interface CommentService
{
    public function addComment($comment, $movieId);
    public function getCommentsByMovieIdPaginated($movieId, $page=1, $perPage=5);
}
