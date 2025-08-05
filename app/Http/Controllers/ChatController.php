<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenRouterService;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function search(Request $request)
    {
        $userInput = $request->input('message');
        Log::info('Chat Input: ' . $userInput);

        $openRouterService = new OpenRouterService();
        $result = $openRouterService->searchProducts($userInput);

        Log::info('Chat Result: ' . $result);

        return response()->json([
            'message' => $result,
        ]);
    }
}