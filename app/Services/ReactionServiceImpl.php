<?php

namespace App\Services;

use App\Reaction;

class ReactionServiceImpl implements ReactionService
{
    public function createReaction($movieId, $type)
    {
        $user_id = auth()->user()->id;
        $foundReaction = Reaction::where('user_id', $user_id)
                                ->where('movie_id', $movieId)
                                ->first();

        if (!$foundReaction)
        {
            return Reaction::create([
                'movie_id' => $movieId,
                'user_id' => $user_id,
                'type' => $type
            ]);
        }

        abort(400, 'You can react to the same movie only once!');
    }
}
