<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use Illuminate\Http\Request;
use App\Services\OpenRouterService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{   
    # hàm trả về kết quả của api cho view
    public function search(Request $request)
    {   
        # lấy truy vấn của user
        $userInput = $request->input('message');
        # log lại truy vấn của user
        Log::info("Chat Input: $userInput");
        # gọi hàm để thực thi truy vấn
        $openRouterService = new OpenRouterService();
        $result = $openRouterService->searchProducts($userInput);
        # kiểm tra nếu user đăng nhập thì lưu trò chuyện vào csdl
        if (Auth::check()) {
        ChatHistory::create([
        'user_id' => Auth::id(),
        'user_message' => $userInput,
        'bot_reply' => $result,
        ]);
        }
        # log kết quả trả về
        Log::info("Chat Result: $result");
        # trả về view
        return response()->json([
            'message' => $result,
        ]);
    }
    # ghi lại thông tin trò chuyện của khách và chatbot
    public function importHistory(Request $request)
    {   
        # lấy thông tin trò chuyện dưới dạng mảng
        $history = $request->input('history',[]);
        # tạo bản ghi
        foreach ($history as $item)
        {
            ChatHistory::create([
                'user_id' => Auth::id(),
                'user_message' => $item['user'],
                'bot_reply' => $item['bot'],
            ]);
        }
        # trả về thông báo thành công cho client
        return response()->json(['success' => true]);
    }
}   