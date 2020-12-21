<?php

namespace App\Services;

interface WatchlistService
{
    public function getUsersWatchlistItems($userId);
    public function addWatchlistItem($userId, $movieId);
    public function updateWatchlistItem($itemId, $watched, $userId);
    public function removeWatchlistItem($itemId, $userId);
}
