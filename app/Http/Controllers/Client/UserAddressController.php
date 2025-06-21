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
        // Kiểm tra quyền sở hữu
        if (!Auth::check()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $addresses = $user->diaChiNguoiDungs()->orderByDesc('mac_dinh')->get();

        return view('client.addresses.index', data: compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create(): View
    {
        // Kiểm tra quyền sở hữu
        if (!Auth::check()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isFirstAddress = !$user->diaChiNguoiDungs()->exists();
        return view('client.addresses.create', compact('isFirstAddress'));
    }

    public function edit(DiaChiNguoiDung $address)
    {
        // Kiểm tra quyền sở hữu
        if (!Auth::check() || $address->id_user !== Auth::id()) {
            abort(403);
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
        // Kiểm tra quyền sở hữu
        if (!Auth::check()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isFirstAddress = !$user->diaChiNguoiDungs()->exists();

        $validatedData = $request->validated();

        // Nếu là địa chỉ đầu tiên hoặc user chọn làm mặc định
        if ($isFirstAddress || (isset($validatedData['mac_dinh']) && $validatedData['mac_dinh'])) {
            // Đặt tất cả địa chỉ khác thành không mặc định
            $user->diaChiNguoiDungs()->update(['mac_dinh' => false]);
            $validatedData['mac_dinh'] = true;
        } else {
            $validatedData['mac_dinh'] = false;
        }

        $validatedData['id_user'] = $user->id;
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
        // Kiểm tra quyền sở hữu
        if (!Auth::check() || $address->id_user !== Auth::id()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validatedData = $request->validated();

        if (isset($validatedData['mac_dinh']) && $validatedData['mac_dinh']) {
            $user->diaChiNguoiDungs()->where('id', '!=', $address->id)->update(['mac_dinh' => false]);
            $validatedData['mac_dinh'] = true;
        } else {
            $validatedData['mac_dinh'] = false;
        }

        $address->update($validatedData);

        if (!$user->diaChiNguoiDungs()->where('mac_dinh', true)->exists() && $user->diaChiNguoiDungs()->exists()) {
            $user->diaChiNguoiDungs()->first()->update(['mac_dinh' => true]);
        }

        return redirect()->route('client.addresses.index')->with('success', 'Địa chỉ đã được cập nhật thành công!');
    }

    /**
     * Remove the specified address from storage.
     *
     * @param DiaChiNguoiDung $address
     */
    public function destroy(DiaChiNguoiDung $address): RedirectResponse
    {
        // Kiểm tra quyền sở hữu
        if (!Auth::check() || $address->id_user !== Auth::id()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Nếu đây là địa chỉ mặc định duy nhất, không cho phép xóa
        if ($address->mac_dinh && $user->diaChiNguoiDungs()->count() === 1) {
            return redirect()->route('client.addresses.index')
                ->with('error', 'Không thể xóa địa chỉ mặc định duy nhất!');
        }

        // Nếu đây là địa chỉ mặc định và có nhiều địa chỉ khác
        if ($address->mac_dinh && $user->diaChiNguoiDungs()->count() > 1) {
            $wasDefault = $address->mac_dinh;
            $address->delete();

            // Đặt địa chỉ đầu tiên còn lại làm mặc định
            $newDefault = $user->diaChiNguoiDungs()->first();
            $newDefault->update(['mac_dinh' => true]);

            return redirect()->route('client.addresses.index')
                ->with('success', 'Địa chỉ đã được xóa. Địa chỉ đầu tiên còn lại đã được đặt làm mặc định.');
        }

        $address->delete();

        return redirect()->route('client.addresses.index')
            ->with('success', 'Địa chỉ đã được xóa thành công!');
    }

    /**
     * Set the specified address as the default for the user.
     *
     * @param DiaChiNguoiDung $address
     */
    public function setDefault(DiaChiNguoiDung $address): RedirectResponse
    {
        // Kiểm tra quyền sở hữu
        if (!Auth::check() || $address->id_user !== Auth::id()) {
            abort(403);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->diaChiNguoiDungs()->update(['mac_dinh' => false]);
        $address->update(['mac_dinh' => true]);

        return redirect()->route('client.addresses.index')->with('success', 'Địa chỉ mặc định đã được cập nhật!');
    }
}
