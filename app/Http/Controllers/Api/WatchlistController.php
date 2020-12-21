<?php

namespace App\Http\Controllers\Api;

use App\Services\WatchlistService;
use App\Http\Controllers\Controller;
use App\Http\Requests\WatchlistAddRequest;
use App\Http\Requests\WatchlistUpdateRequest;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{

    protected $watchlistService;

    public function __construct(WatchlistService $ws)
    {
        $this->watchlistService = $ws;
    }

    public function getUsersWatchlist()
    {
        $userId = auth()->user()->id;
        $watchlist = $this->watchlistService->getUsersWatchlistItems($userId);
        return response()->json($watchlist, 200);
    }

    public function addWatchlistItem(WatchlistAddRequest $request)
    {
        $data = $request->validated();
        $userId = auth()->user()->id;

        $added = $this->watchlistService->addWatchlistItem($userId, $data['movie_id']);
        if ($added === null)
        {
            abort(400, "You can't add same movie twice to the watchlist");
        }

        return response()->json($added, 200);

    }

    public function updateWatchlistItem(WatchlistUpdateRequest $request, $itemId)
    {
        $data = $request->validated();
        $userId = auth()->user()->id;

        $updated = $this->watchlistService->updateWatchListItem($itemId, $data['watched'], $userId);
        if ($updated === null)
        {
            abort(400, 'This movie is not in your watchlist');
        }

        return response()->json($updated, 200);
    }

    public function removeWatchlistItem($itemId)
    {
        $userId = auth()->user()->id;

        $deleted = $this->watchlistService->removeWatchlistItem($itemId, $userId);
        if ($deleted === null)
        {
            abort(400, 'This movie is not in your watchlist');
        }

        return response()->json($deleted, 200);
    }
}
