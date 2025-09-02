<?php

namespace Modules\Shared\Http\Service\Strategy;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Shared\Contract\FileUploadStrategyInterface;
use RuntimeException;

class PublicFileUploadStrategy implements FileUploadStrategyInterface
{
    public function upload(UploadedFile $uploadedFile, string $path = '/')
    {
        $path = rtrim($path, '/') . '/';

        $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName);
        $filename = now()->unix() . '_' . $safeName . '.' . $uploadedFile->getClientOriginalExtension();

        if (Storage::disk('public')->exists("{$path}{$filename}")) {
            throw new RuntimeException("File already exists: {$filename}");
        }

        Storage::disk('public')->putFileAs($path, $uploadedFile, $filename);

        return Storage::url("{$path}{$filename}");
    }
}
