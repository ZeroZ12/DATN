<?php

namespace App\Services;

use App\Models\SanPham;
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
            //lấy sản phẩm có biến thể
            $variantProducts = SanPham::join('danh_mucs', 'san_phams.id_category', '=','danh_mucs.id')
            ->join('bien_the_san_phams','san_phams.id','=','bien_the_san_phams.id_product')
            ->where('san_phams.hoat_dong',1)
            ->whereNull('danh_mucs.deleted_at')
            ->where('bien_the_san_phams.ton_kho','>',0)
            ->select([
                'san_phams.id as id',
                'san_phams.ten',
                'san_phams.gia',
                'danh_mucs.ten as ten_danh_muc',
                'bien_the_san_phams.id as bien_the_id',
                'bien_the_san_phams.ton_kho as ton_kho'
            ]);
            // Lấy sản phẩm không có biến thể.
            $noVariantProducts = SanPham::join('danh_mucs','san_phams.id_category','=','danh_mucs.id')
            ->leftJoin('bien_the_san_phams','san_phams.id','=','bien_the_san_phams.id_product') #join để lấy id biến thể kiểm tra
            ->whereNull('bien_the_san_phams.id')
            ->where('san_phams.hoat_dong',1)
            ->whereNull('danh_mucs.deleted_at')
            ->where('san_phams.so_luong','>',0)
            ->select([
                'san_phams.id',
                'san_phams.ten',
                'san_phams.gia',
                'danh_mucs.ten as ten_danh_muc',
                DB::raw('NULL as bien_the_id'),
                'san_phams.so_luong as ton_kho',
            ]);
            $unionAll = $variantProducts->unionAll($noVariantProducts); // gộp lệnh để lấy cả sản phẩm có và không có biến thể.
            $products = DB::query()
            ->fromSub($unionAll,'p') // dùng subquery tạo bảng tạm 
            ->orderBy('gia','asc')
            ->limit(20)
            ->get()
            ->toArray();
           
            Log::info('User Input: ' . $userInput);
            Log::info('Products: ' . json_encode($products, JSON_UNESCAPED_UNICODE));

            // Danh sách sản phẩm
            $productList = json_encode($products, JSON_UNESCAPED_UNICODE);

        // Prompt Cho A.I ; giảm tải promtp nếu như không có sản phẩm phù hợp bằng toán tử 3 ngôi ?:
        $prompt = (empty($products)) ? <<<PROMP_EMPTY
Bạn là TopPC ChatBot, một A.I hỗ trợ khách hàng của một cửa hàng TOP PC bán PC.
Không tìm thấy sản phẩm phù hợp với yêu cầu: "$userInput".
Chỉ trả lời: 
"Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử các yêu cầu khác không?"
PROMP_EMPTY 
: <<<PROMP_LIST
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
- Ngắt cách sản phẩm với nhau bằng thẻ <br> ở cuối mỗi sản phẩm và ở đầu sản phẩm đầu tiên, dùng "*" để đánh đầu dòng của mỗi sản phẩm.
Lưu ý:
- gọi khách hàng là bạn.
- Trong ngữ cảnh này chỉ có bạn trò chuyện với prompt của khách hàng (userInput)
- Nếu khách hàng yêu cầu sản phẩm theo giá thì gửi link sản phẩm, 
và yêu cầu khách truy cập link sản phẩm để xem thông tin chi tiết và lựa chọn mẫu sản phẩm phù hợp.
- Tuyệt đối không được cung cấp thông tin ngoài lề, nhớ rõ bạn là chat bot của TOP PC.
- Tuyệt đối không hiển thị sản phẩm không liên quan đến yêu cầu.
- Ưu tiên tìm theo danh mục nếu khách hàng nêu tên danh mục.
PROMP_LIST;



            Log::info('Prompt: ' . $prompt);

            $response = Http::timeout(60)->withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => 'meta-llama/llama-3.3-8b-instruct:free',
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
            Log::error('Mã lỗi:' . $response->status());
        }
    }
    
