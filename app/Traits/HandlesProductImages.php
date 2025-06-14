<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\AnhSanPham;
use App\Models\BienTheSanPham;
use App\Models\SanPham; // Import SanPham model for type hinting if needed

trait HandlesProductImages
{
    /**

     *
     * @param UploadedFile|null $file The uploaded file instance.
     * @param string $directory The storage directory (e.g., 'images/products').
     * @param string|null $oldPath The path of the old file to delete (optional).
     * @return string|null The new file path, or null if no file was uploaded.
     */
    protected function uploadImage(?UploadedFile $file, string $directory, ?string $oldPath = null): ?string
    {
        if (!$file) {
            return $oldPath; // If no new file, keep the old path (for update scenarios)
        }

        // Delete the old file if it exists
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // Store the new file and return its path
        return $file->store($directory, 'public');
    }

    /**
     * Deletes a file from storage.
     *
     * @param string|null $path The path of the file to delete.
     * @return void
     */
    protected function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Handles the main product image upload and update.
     *
     * @param SanPham $product The product model instance.
     * @param object $request The request object (can be Illuminate\Http\Request or a FormRequest).
     * @return void
     */
    protected function handleMainProductImage(SanPham $product, $request): void
    {
        if ($request->hasFile('anh_dai_dien')) {
            $newPath = $this->uploadImage(
                $request->file('anh_dai_dien'),
                'uploads/sanpham',
                $product->anh_dai_dien // Pass old path for deletion
            );
            $product->anh_dai_dien = $newPath;
            $product->save(); // Save immediately to update the image path
        }
    }

    /**
     * Handles the auxiliary product images (deleting old and adding new).
     *
     * @param SanPham $product The product model instance.
     * @param object $request The request object.
     * @param array $validatedData The validated request data.
     * @return void
     */
    protected function handleAuxiliaryImages(SanPham $product, $request, array $validatedData): void
    {
        // Delete marked auxiliary images
        if (isset($validatedData['xoa_anh_phu']) && is_array($validatedData['xoa_anh_phu'])) {
            foreach ($validatedData['xoa_anh_phu'] as $anhPhuId) {
                $anhPhu = AnhSanPham::find($anhPhuId);
                if ($anhPhu) {
                    $this->deleteImage($anhPhu->duong_dan);
                    $anhPhu->delete();
                }
            }
        }

        // Add new auxiliary images
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $file) {
                $path = $this->uploadImage($file, 'uploads/sanpham/anh_phu');
                AnhSanPham::create([
                    'id_product' => $product->id,
                    'duong_dan' => $path,
                ]);
            }
        }
    }

    /**
     * Handles image for a specific product variant.
     *
     * @param BienTheSanPham $variant The variant model instance.
     * @param UploadedFile|null $file The uploaded file for the variant.
     * @return void
     */
    protected function handleVariantImage(BienTheSanPham $variant, ?UploadedFile $file): void
    {
        // The uploadImage method handles deleting the old image if a new one is provided.
        $newPath = $this->uploadImage(
            $file,
            'uploads/bien_the_san_pham',
            $variant->anh_dai_dien
        );

        if ($newPath !== $variant->anh_dai_dien) {
            $variant->anh_dai_dien = $newPath;
        }
    }
}
