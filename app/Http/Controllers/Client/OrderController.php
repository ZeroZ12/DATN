<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function success($id)
    {
        $donHang = DonHang::where('id_user', Auth::id())
            ->where('id', $id)
            ->with([
                'maGiamGia',
                'phuongThucThanhToan',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->firstOrFail();

        return view('client.order-success', compact('donHang'));
    }

    public function index()
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $donHangs = $user->donHangs()
            ->with([
                'maGiamGia',
                'phuongThucThanhToan',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('client.profile.show', [
            'donHangs' => $donHangs,
            'user' => $user
        ]);
    }

    public function show($id)
    {
        $selectedDonHang = DonHang::where('id_user', Auth::id())
            ->where('id', $id)
            ->with([
                'maGiamGia',
                'phuongThucThanhToan',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->firstOrFail();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $donHangs = $user->donHangs()
            ->with([
                'maGiamGia',
                'phuongThucThanhToan',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('client.profile.show', [
            'donHangs' => $donHangs,
            'user' => $user,
            'selectedDonHang' => $selectedDonHang
        ]);
    }
}