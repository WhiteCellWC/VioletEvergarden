<?php

namespace Modules\Shared\Contract;

use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
    public function upload(UploadedFile $uploadedFile, string $path = '/'): string;

    public function delete(string $path): bool;
}
