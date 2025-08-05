<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OpenRouterService
{
    protected $apiKey;
    protected $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = env('OPENROUTER_API_KEY');
        if (empty($this->apiKey)) {
            Log::error('OPENROUTER_API_KEY is not set in .env');
        }
    }

    public function searchProducts($userInput)
    {   
        $products = DB::table('san_phams')
        ->join('danh_mucs', 'san_phams.id_category', '=', 'danh_mucs.id' )
        ->select('san_phams.id',
                'san_phams.ten',
                'san_phams.gia',
            'san_phams.so_luong',
            'san_phams.hoat_dong',
            'danh_mucs.ten as ten_danh_muc')
        ->get()
        ->map(function($item)
    {
        return (array) $item;
    })
    ->toArray();
        
        Log::info('User Input: ' . $userInput);
        Log::info('Products: ' . json_encode($products, JSON_UNESCAPED_UNICODE));

        $productList = json_encode($products, JSON_UNESCAPED_UNICODE);
   
        $prompt = <<<EOD
Bạn là một A.I hỗ trợ khách hàng của một cửa hàng bán pc 
Với yêu cầu '$userInput' của khách hàng'.
Và dựa trên danh sách sản phẩm sau: $productList, trả về danh sách sản phẩm thuộc đúng danh mục được yêu cầu (ví dụ: nếu yêu cầu 'PC Gaming', chỉ liệt kê sản phẩm trong danh mục 'PC Gaming') bằng tiếng Việt.
Sử dụng định dạng gạch đầu dòng, mỗi sản phẩm trên một dòng, không xô lệch.
Mỗi sản phẩm phải bao gồm: 
- Tên sản phẩm trong thẻ <a href="/sanpham/{id}">Tên sản phẩm</a> - Giá: {giá} VNĐ.
Ví dụ: - <a href="/sanpham/1">PC Gaming</a> - Giá: 300,000 VNĐ.
Nếu không có sản phẩm phù hợp với yêu cầu của khách hàng thì không được trả lời sản phẩm của danh mục khác,
 trả lời: "Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử yêu cầu khác không?",
không đưa ra thông tin của các sản phẩm thuộc danh mục khác hoặc không có trong yêu cầu của khách hàng,
Trả lời nhanh, tập trung vào danh mục và định dạng chính xác với yêu cầu trên.
EOD;

        Log::info('Prompt: ' . $prompt);

        $response = Http::timeout(60)->withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => 'deepseek/deepseek-chat-v3-0324:free',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
        ]);

        Log::info('Guzzle Response: ' . $response->body());

        if ($response->successful()) {
            $result = $response->json();
            if (isset($result['choices'][0]['message']['content'])) {
                return $result['choices'][0]['message']['content'];
            } else {
                Log::error('No content in API response: ' . json_encode($result));
                return "Không nhận được nội dung từ API.";
            }
        }

        Log::error('Guzzle Error: ' . $response->body());
        return "Lỗi khi gọi API: " . $response->status();
    }
}