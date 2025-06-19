<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DiaChiNguoiDung; // Import Model DiaChiNguoiDung
use App\Models\User;
use App\Http\Requests\Client\DiaChiNguoiDungRequest; // Import Form Request
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class UserAddressController extends Controller
{
    /**
     * Display a listing of the user's addresses.
     */
    public function index(): View
    {
        /** @var \App\Models\User $user */ // <<< Thêm DocBlock này
        $user = Auth::user();
        $addresses = $user->diaChiNguoiDungs()->orderByDesc('la_mac_dinh')->get();

        return view('client.addresses.index', data: compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create(): View
    {
        /** @var \App\Models\User $user */ // <<< Thêm DocBlock này
        $user = Auth::user();
        $hasAddresses = $user->diaChiNguoiDungs()->exists();
        return view('client.addresses.create', compact('hasAddresses'));
    }

    public function edit(DiaChiNguoiDung $address)
    {
        // Đảm bảo chỉ người dùng sở hữu mới được chỉnh sửa địa chỉ
        if (Auth::id() !== $address->id_user) {
            abort(403); // Hoặc return back()->with('error', 'Bạn không có quyền chỉnh sửa địa chỉ này.');
        }

        return view('client.addresses.edit', compact('address'));
    }

    /**
     * Store a newly created address in storage.
     *
     * @param DiaChiNguoiDungRequest $request
     */
    public function store(DiaChiNguoiDungRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */ // <<< Thêm DocBlock này
        $user = Auth::user();
        $validatedData = $request->validated();

        $isFirstAddress = !$user->diaChiNguoiDungs()->exists();

        if (isset($validatedData['la_mac_dinh']) && $validatedData['la_mac_dinh'] || $isFirstAddress) {
            $user->diaChiNguoiDungs()->update(['la_mac_dinh' => false]);
            $validatedData['la_mac_dinh'] = true;
        } else {
            $validatedData['la_mac_dinh'] = false;
        }

        $user->diaChiNguoiDungs()->create($validatedData);

        return redirect()->route('client.addresses.index')->with('success', 'Địa chỉ đã được thêm thành công!');
    }

    // Các phương thức edit, update, destroy, setDefault cũng tương tự.
    // Bạn có thể thêm /** @var \App\Models\User $user */ ngay sau dòng $user = Auth::user();
    // hoặc bất cứ khi nào bạn muốn IDE hiểu rõ hơn về kiểu dữ liệu của biến $user.

    /**
     * Update the specified address in storage.
     *
     * @param DiaChiNguoiDungRequest $request
     * @param DiaChiNguoiDung $address
     */
    public function update(DiaChiNguoiDungRequest $request, DiaChiNguoiDung $address): RedirectResponse
    {
        /** @var \App\Models\User $user */ // Thêm DocBlock này
        $user = Auth::user();
        if ($user->id !== $address->id_user) { // Đảm bảo dùng $user->id
            abort(403, 'Bạn không có quyền cập nhật địa chỉ này.');
        }

        $validatedData = $request->validated();

        if (isset($validatedData['la_mac_dinh']) && $validatedData['la_mac_dinh']) {
            $user->diaChiNguoiDungs()->where('id', '!=', $address->id)->update(['la_mac_dinh' => false]);
            $validatedData['la_mac_dinh'] = true;
        } else {
            $validatedData['la_mac_dinh'] = false;
        }

        $address->update($validatedData);

        if (!$user->diaChiNguoiDungs()->where('la_mac_dinh', true)->exists() && $user->diaChiNguoiDungs()->exists()) {
            $user->diaChiNguoiDungs()->first()->update(['la_mac_dinh' => true]);
        }

        return redirect()->route('client.addresses.index')->with('success', 'Địa chỉ đã được cập nhật thành công!');
    }

    /**
     * Remove the specified address from storage.
     *
     * @param DiaChiNguoiDung $address
     */
    // ...
    public function destroy(DiaChiNguoiDung $address): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Kiểm tra quyền sở hữu (Đã sửa để hiển thị lỗi trên trang)
        if ($user->id !== $address->id_user) {
            return back()->with('error', 'Bạn không có quyền xóa địa chỉ này.');
        }

        // 2. Kiểm tra số lượng địa chỉ
        if ($user->diaChiNguoiDungs()->count() === 1) {
            return back()->with('error', 'Bạn phải có ít nhất một địa chỉ. Không thể xóa địa chỉ duy nhất!');
        }

        $wasDefault = $address->la_mac_dinh;
        $address->delete();

        if ($wasDefault) {
            $newDefault = $user->diaChiNguoiDungs()->first();
            if ($newDefault) {
                $newDefault->update(['la_mac_dinh' => true]);
            }
        }

        // 4. Điều hướng sau khi thành công (Đã sửa để luôn quay về trang profile)
        return redirect()->route('client.profile.show')->with('success', 'Địa chỉ đã được xóa thành công!');
    }
    /**
     * Set the specified address as the default for the user.
     *
     * @param DiaChiNguoiDung $address
     */
    public function setDefault(DiaChiNguoiDung $address): RedirectResponse
    {
        /** @var \App\Models\User $user */ // Thêm DocBlock này
        $user = Auth::user();
        if ($user->id !== $address->id_user) { // Đảm bảo dùng $user->id
            abort(403, 'Bạn không có quyền thiết lập địa chỉ này làm mặc định.');
        }

        $user->diaChiNguoiDungs()->update(['la_mac_dinh' => false]);
        $address->update(['la_mac_dinh' => true]);

        return redirect()->route('client.addresses.index')->with('success', 'Địa chỉ mặc định đã được cập nhật!');
    }
}
