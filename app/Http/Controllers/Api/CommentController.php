<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\GetCommentsRequest;
use App\Services\CommentService;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $cs)
    {
        $this->commentService = $cs;
    }

    public function addComment(CommentRequest $request)
    {
        $data = $request->validated();
        $ret = $this->commentService->addComment($data['text'], $data['movie_id']);
        return response()->json($ret, 200);
    }

    public function getMovieComments(GetCommentsRequest $request, $id)
    {
        $data = $request->validated();
        if (array_key_exists('page', $data) && array_key_exists('perPage', $data))
        {
            $page = (int)$data['page'];
            $perPage = (int)$data['perPage'];
            $comments = $this->commentService->getCommentsByMovieIdPaginated($id, $page, $perPage);
            return response()->json($comments, 200);
        }

        $comments = $this->commentService->getCommentsByMovieIdPaginated($id);
        return response()->json($comments, 200);


    }

}
