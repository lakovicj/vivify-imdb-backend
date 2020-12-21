<?php

namespace App\Services;

use App\Comment;

class CommentServiceImpl implements CommentService
{
    public function addComment($comment, $movieId)
    {
        $userId = auth()->user()->id;

        return Comment::create([
            'user_id' => $userId,
            'movie_id' => $movieId,
            'text' => $comment
        ])->load('user');
    }

    public function getCommentsByMovieIdPaginated($movieId, $page=1, $perPage=5)
    {
        $paginatedResults = Comment::where('movie_id', $movieId)
                                    ->with('user')
                                    ->latest()
                                    ->paginate($perPage, ['*'], 'page', $page);

        $retArray = array(
            'comments' => $paginatedResults->items(),
            'currentPage' => $paginatedResults->currentPage(),
            'perPage' => $paginatedResults->perPage(),
            'totalComments' => $paginatedResults->total()
        );

        return $retArray;
    }
}
