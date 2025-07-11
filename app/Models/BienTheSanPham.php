<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BienTheSanPham extends Model
{
    use HasFactory, SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'bien_the_san_phams';
    protected $fillable = [
        'id_product', 'id_ram', 'id_o_cung', 'gia', 'gia_so_sanh', 'ton_kho', 'ma_bien_the', 'anh_dai_dien', 'hoat_dong'
    ];

    // Quan hệ với bảng Sản Phẩm
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }

    public function saleEvents()
    {
        return $this->belongsToMany(SaleEvent::class, 'sale_event_product_variant')
                    ->withPivot('sale_price_override')
                    ->withTimestamps();
    }

     public function getEffectivePriceAttribute()
    {
        $currentPrice = $this->gia; // Giá mặc định là giá gốc của biến thể

        // Tìm các sự kiện sale đang hoạt động mà biến thể này tham gia
        $activeSaleEvents = $this->saleEvents()->active()->get();

        foreach ($activeSaleEvents as $event) {
            // Lấy giá sale từ pivot table nếu có, nếu không thì dùng giá mặc định của event (nếu event có giá mặc định)
            $eventSalePrice = $event->pivot->sale_price_override ?? null;

            // Nếu có giá sale cụ thể trong sự kiện và nó thấp hơn giá hiện tại
            if ($eventSalePrice !== null && $eventSalePrice < $currentPrice) {
                $currentPrice = $eventSalePrice;
            }
        }
        return $currentPrice;
    }

    // Quan hệ với bảng RAM
    public function ram()
    {
        return $this->belongsTo(Ram::class, 'id_ram');
    }

    // Quan hệ với bảng Ổ Cứng
    public function oCung()
    {
        return $this->belongsTo(OCung::class, 'id_o_cung');
    }
}
