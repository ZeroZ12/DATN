<?php

namespace App\Services;

use App\Models\SanPham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OpenRouterService
{
    protected $apiKey; # openrouter api key
    protected $apiUrl = 'https://openrouter.ai/api/v1/chat/completions'; # api url để gửi request

    public function __construct() # khai báo biến thành viên của class để sử dụng cho các function phía dưới
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
                'san_phams.anh_dai_dien',
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
                'san_phams.anh_dai_dien',
                'danh_mucs.ten as ten_danh_muc',
                DB::raw('NULL as bien_the_id'),
                'san_phams.so_luong as ton_kho',
            ]);
            $unionAll = $variantProducts->unionAll($noVariantProducts); // gộp lệnh để lấy cả sản phẩm có và không có biến thể.
            $products = DB::query()
            ->fromSub($unionAll,'p') // dùng subquery tạo bảng tạm
            ->orderBy('gia','asc')
            ->get()
            ->toArray();
            #log lại thông tin trò chuyện của user và chatbot
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
Dưới đây là danh sách sản phẩm hiện có cung cấp cho bạn:
$productList .(productList - lưu ý đây là nội dung cung cấp riêng cho bạn)
Khách hàng yêu cầu (userInput - là yêu cầu từ khách hàng mỗi lần hỏi): "$userInput"
Ghi chú:
- Mỗi sản phẩm có cấu trúc (ứng với chú thích như ở productList đã cung cấp)
Yêu cầu:
- userInput chỉ cần có từ khóa giống tên của sản phẩm hoặc danh mục là đủ, không yêu cầu gửi toàn bộ thông tin sản phẩm
- Phân tích yêu cầu của khách hàng (userInput) ứng với data đã cung cấp từ productList, tìm ra các sản phẩm chính xác.
- Danh sách sản phẩm chính xác hãy hiển thị dưới dạng:
<div class="product-list">
  <div class="product-card border rounded p-3 mb-3 shadow-sm bg-white">
    <div class="d-flex align-items-center">
      <!-- Ảnh sản phẩm -->
      <div class="flex-shrink-0 me-3">
        <img src="http://localhost:8000/storage/images/{anh_dai_dien}"
             class="rounded"
             style="width: 120px; height: auto; object-fit: cover;"
             alt="{ten}">
      </div>
      <!-- Nội dung -->
      <div class="flex-grow-1">
        <p class="fw-semibold mb-2 text-dark">
          {ten}
        </p>
        <!-- Nút -->
        <a href="/sanpham/{id}" class="btn btn-danger btn-sm rounded-pill px-3">
          Xem chi tiết
        </a>
      </div>
    </div>
  </div>
</div>

Lưu ý:
- Lấy ra hiển thị tối đa 5 sản phẩm.
- gọi khách hàng là bạn.
- Trong ngữ cảnh này chỉ có bạn trò chuyện với prompt của khách hàng (userInput).
- Yêu cầu khách truy cập link sản  phẩm để xem thông tin chi tiết và lựa chọn mẫu sản phẩm phù hợp.
- Tuyệt đối không được cung cấp thông tin ngoài lề, nhớ rõ bạn là chat bot của TOP PC.
- Tuyệt đối không hiển thị sản phẩm không liên quan đến yêu cầu.
- Mỗi sản phẩm chỉ hiển thị 1 lần.
- Các phụ kiện, link kiện có thể ở trong danh mục linh kiện PC, thì tìm theo tên sản phẩm.
- Sản phẩm laptop khác PC (PC ở ngữ cảnh này được hiểu như máy tính để bàn), không hiển thị sản phẩm của 2 danh mục này cho nhau.
- Nếu không tìm thấy sản phẩm có {ten} phù hợp với yêu cầu: "$userInput" thì chỉ trả lời:
"Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử các yêu cầu khác không?".
- Ưu tiên tìm theo danh mục nếu khách hàng nêu tên danh mục.
- Trả lời đúng ngữ cảnh (userInput), đúng yêu cầu, ngắn gọn, súc tích.
- Những câu hỏi tiêu cực từ (userInput) sẽ không trả về sản phẩm.
PROMP_LIST;


            # log prompt
            Log::info('Prompt: ' . $prompt);
            # gửi prompt đến api của openrouter, model meta-llama
            $response = Http::timeout(60)->withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'model' => 'meta-llama/llama-4-maverick:free',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => '2000',
            ]);
            # Http được built trên Guzzle
            # Trả về body() nội dung dạng string
            Log::info('Guzzle Response: ' . $response->body());
            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['choices'][0]['message']['content'])) {
                    return $result['choices'][0]['message']['content'];
                } else {
                    # log lại nguyên nhân gây lỗi
                    Log::error('Không nhận được nội dung trả về từ API: ' . json_encode($result));
                    return "Không nhận được nội dung từ API.";
                }
            }else{
                 # log lại thông tin và mã lỗi.
                Log::error('Guzzle Error: ' . $response->body());
                Log::error('Mã lỗi:' . $response->status());
                return "Hệ thống đang bận, vui lòng thử lại sau ít phút.";
            }

        }
    }
