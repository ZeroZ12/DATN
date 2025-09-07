<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use Illuminate\Http\Request;
use App\Services\OpenRouterService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function search(Request $request)
    {
        $userInput = $request->input('message');

        
        Log::info("Chat Input: $userInput");
        
        $openRouterService = new OpenRouterService();
        $result = $openRouterService->searchProducts($userInput);
        if (Auth::check()) {
        ChatHistory::create([
        'user_id' => Auth::id(),
        'user_message' => $userInput,
        'bot_reply' => $result,
        ]);
        }
        Log::info("Chat Result: $result");

        return response()->json([
            'message' => $result,
        ]);
    }

    public function importHistory(Request $request)
    {
        $history = $request->input('history',[]);
        foreach ($history as $item)
        {
            ChatHistory::create([
                'user_id' => Auth::id(),
                'user_message' => $item['user'],
                'bot_reply' => $item['bot'],
            ]);
        }
        return response()->json(['success' => true]);
    }
}   