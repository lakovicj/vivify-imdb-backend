<?php

namespace App\Services;

use App\WatchlistItem;

class WatchlistServiceImpl implements WatchlistService
{

    public function getUsersWatchlistItems($userId)
    {
        return WatchlistItem::where('user_id', $userId)
                            ->with('movie')
                            ->get();
    }

    public function addWatchlistItem($userId, $movieId)
    {
        // ne moze dodati 2x isti film
        $item = WatchlistItem::where('user_id', $userId)
                    ->where('movie_id', $movieId)
                    ->first();

        if ($item === null)
        {
            return WatchlistItem::create([
                'user_id' => $userId,
                'movie_id' => $movieId
            ])->load('movie');
        }

        return null;
    }

    public function updateWatchlistItem($itemId, $watched, $userId)
    {
        $item = WatchlistItem::find($itemId);
        if ($item === null || $item->user_id != $userId) {
            return null;
        }

        $item->watched = $watched;
        $item->save();

        return $item->load('movie');
    }

    public function removeWatchlistItem($itemId, $userId)
    {
        $item = WatchlistItem::find($itemId);
        if ($item === null || $item->user_id != $userId) {
            return null;
        }

        return $item->delete();
    }
}
