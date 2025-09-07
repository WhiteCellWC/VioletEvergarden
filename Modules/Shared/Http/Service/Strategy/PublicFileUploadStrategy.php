<?php

namespace Modules\Shared\Http\Service\Strategy;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Shared\Contract\FileUploadStrategyInterface;
use RuntimeException;

class PublicFileUploadStrategy implements FileUploadStrategyInterface
{
    public function upload(UploadedFile $uploadedFile, string $path = '/'): string
    {
        try {
            $path = trim($path, '/') . '/';

            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

            $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug($originalName);
            $filename = now()->unix() . '_' . $safeName . '.' . $uploadedFile->getClientOriginalExtension();

            if (Storage::disk('public')->exists("{$path}{$filename}")) {
                throw new RuntimeException("File already exists: {$filename}");
            }

            Storage::disk('public')->putFileAs($path, $uploadedFile, $filename);

            return Storage::url("{$path}{$filename}");
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(string $filePath): bool
    {
        try {
            $relativePath = str_replace(Storage::url(''), '', $filePath);

            if (Storage::disk('public')->exists($relativePath)) {
                return Storage::disk('public')->delete($relativePath);
            }

            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
