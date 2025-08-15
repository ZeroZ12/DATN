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
        // Lọc dữ liệu sản phẩm từ DB
        $products = DB::table('san_phams')
            ->join('danh_mucs', 'san_phams.id_category', '=', 'danh_mucs.id')
            ->select(
                'san_phams.id',
                'san_phams.ten',
                'san_phams.gia',
                'san_phams.so_luong',
                'danh_mucs.ten as ten_danh_muc'
            )
            ->where('san_phams.hoat_dong', 1)
            ->where('danh_mucs.deleted_at', null)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        Log::info('User Input: ' . $userInput);
        Log::info('Products: ' . json_encode($products, JSON_UNESCAPED_UNICODE));

        $productList = json_encode($products, JSON_UNESCAPED_UNICODE);

        // Prompt Cho A.I
$prompt = <<<EOD
Bạn là TopPC ChatBot, một A.I hỗ trợ khách hàng của một cửa hàng bán PC.


Dưới đây là danh sách sản phẩm hiện có (bao gồm tên sản phẩm, giá, và danh mục):
$productList .(productList - lưu ý đây là nội dung cung cấp riêng cho bạn)

Khách hàng yêu cầu (userInput - là yêu cầu từ khách hàng mỗi lần hỏi): "$userInput"

Ghi chú:
- Mỗi sản phẩm có cấu trúc (ứng với chú thích như ở productList đã cung cấp) :
  - Tên sản phẩm: {ten}
  - Danh mục: {ten_danh_muc}

Yêu cầu:
- userInput chỉ cần có từ khóa giống tên của sản phẩm hoặc danh mục là đủ, không yêu cầu gửi toàn bộ thông tin sản phẩm
- Phân tích yêu cầu của khách hàng (userInput) ứng với data đã cung cấp từ productList, tìm ra các sản phẩm phù hợp.
- Nếu yêu cầu có chứa từ khóa gần giống tên "Danh mục {ten_danh_muc} " hoặc "Tên sản phẩm {ten} ", hãy lọc và hiển thị các sản phẩm đó.
- Không phân biệt chữ hoa hay thường ở nội dung người dùng tìm kiếm với tên của danh mục hoặc sản phẩm
- Không yêu cầu trùng khớp chính xác 100%, có thể chọn các sản phẩm liên quan hoặc tương tự.
- Mỗi sản phẩm phù hợp hãy hiển thị dưới dạng:
  <a href="/sanpham/{id}">{ten}</a> 
- Ngắt cách sản phẩm với nhau bằng thẻ <br> ở cuối mỗi sản phẩm, dùng "*" để đánh đầu dòng của mỗi sản phẩm.
Nếu không có sản phẩm nào phù hợp, chỉ trả lời:
"Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử yêu cầu khác không?"

Lưu ý:
- Nếu khách hàng yêu cầu sản phẩm theo giá thì gửi link sản phẩm, 
  và yêu cầu khách truy cập link sản phẩm để xem thông tin chi tiết và lựa chọn mẫu sản phẩm phù hợp.
- Tuyệt đối không hiển thị sản phẩm không liên quan đến yêu cầu.
- Ưu tiên tìm theo danh mục nếu khách hàng nêu tên danh mục.
EOD;



        Log::info('Prompt: ' . $prompt);

        $response = Http::timeout(3600)->withHeaders([
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
