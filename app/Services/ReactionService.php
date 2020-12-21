<?php

namespace App\Services;

interface ReactionService
{
    public function createReaction($movieId, $type);
}
