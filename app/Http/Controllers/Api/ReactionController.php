<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReactionRequest;
use App\Services\ReactionService;

class ReactionController extends Controller
{

    protected $reactionService;

    public function __construct(ReactionService $rs)
    {
        $this->reactionService = $rs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReactionRequest $request)
    {
        $data = $request->validated();
        $resp = $this->reactionService->createReaction($data['movie_id'], $data['type']);

        return response()->json($resp, 200);
    }


}
