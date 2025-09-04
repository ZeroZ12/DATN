<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function search(Request $request)
    {
        $userInput = $request->input('message');

        // --- Parser giá trị ---
        $numbers = [];
        if (preg_match_all('/([\d\.\,]+)\s*(triệu|trăm triệu|chục triệu|nghìn|k|vnđ|đ)?/iu', $userInput, $matches)) {
            foreach ($matches[1] as $i => $num) {

                $cleanNum = str_replace(['.', ','], '', $num);

                $value = (float)$cleanNum;

                $unit = strtolower(trim($matches[2][$i] ?? ''));

                switch ($unit) {
                    case 'trăm triệu':
                        $value *= 100000000;
                        break;
                    case 'chục triệu':
                        $value *= 10000000;
                        break;
                    case 'triệu':
                        $value *= 1000000;
                        break;
                    case 'nghìn':
                    case 'k':
                        $value *= 1000;
                        break;
                    // vnđ, đ → giữ nguyên
                    default:
                        $value = $value;
                    
                }

                $numbers[] = (int)$value;
            }
        }

        $query = DB::table('san_phams')
            ->join('danh_mucs', 'san_phams.id_category', '=', 'danh_mucs.id')
            ->where('san_phams.hoat_dong', 1)
            ->where('san_phams.so_luong', '>', 0)
            ->whereNull('san_phams.deleted_at')
            ->whereNull('danh_mucs.deleted_at');

        // --- Áp dụng điều kiện giá ---
        if (count($numbers) == 1) {
            $price = $numbers[0];
            if (str_contains($userInput, 'trở lên') || str_contains($userInput, 'từ') || str_contains($userInput, 'trên') || str_contains($userInput, '>=')) {
                $query->where('san_phams.gia', '>=', $price);
            } elseif (str_contains($userInput, 'dưới') || str_contains($userInput, 'nhỏ hơn') || str_contains($userInput, '<=')) {
                $query->where('san_phams.gia', '<=', $price);
            } else {
                $query->where('san_phams.gia', $price);
            }
        } elseif (count($numbers) >= 2) {
            $min = min($numbers);
            $max = max($numbers);
            $query->whereBetween('san_phams.gia', [$min, $max]);
        }

        // --- Nếu có từ khóa sản phẩm ---
        if (preg_match('/(laptop|pc|máy tính|màn hình|ram|ssd|hdd|vga|card màn hình|chuột|bàn phím|tai nghe)/iu', $userInput, $match)) {
            $keyword = $match[1];
            $query->where('san_phams.ten', 'LIKE', "%$keyword%");
        }

        $results = $query->select(
            'san_phams.id',
            'san_phams.ten',
            'san_phams.gia',
            'danh_mucs.ten as ten_danh_muc'
        )
            ->orderBy('san_phams.gia', 'asc')
            ->limit(10)
            ->get();
        // --- Tạo phản hồi ---
        if ($results->isEmpty()) {
            $reply = "Không tìm thấy sản phẩm nào phù hợp.";
        } else {
            $reply = $results->map(function ($item, $index) {
                $stt = $index + 1;
                $gia = number_format($item->gia, 0, ',', '.');

                // Tạo link chi tiết sản phẩm
                $url = route('sanpham.show', $item->id);

                return "{$stt}. <a href=\"{$url}\" target=\"_blank\">{$item->ten}</a> - {$gia} VNĐ ({$item->ten_danh_muc})";
            })->implode("<br>");
        }

        return response()->json([
            'message' => $reply
        ]);
    }

    public function importHistory(Request $request)
    {
        $history = $request->input('history', []);
        foreach ($history as $item) {
            ChatHistory::create([
                'user_id' => Auth::id(),
                'user_message' => $item['user'],
                'bot_reply' => $item['bot'],
            ]);
        }
        return response()->json(['success' => true]);
    }
}
