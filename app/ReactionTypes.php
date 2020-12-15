<?php

namespace App;

abstract class ReactionTypes
{
    const LIKE = 'like';
    const DISLIKE = 'dislike';

    public static $types = [
        self::LIKE,
        self::DISLIKE
    ];
}
