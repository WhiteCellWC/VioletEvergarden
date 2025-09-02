<?php

namespace Modules\Shared\Contract;

use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
    public function singleUpload(UploadedFile $uploadedFile, string $path = '/'): string;

    /**
     * @param UploadedFile[] $uploadedFiles
     * @param string $path
     * @return string[]  List of uploaded file URLs
     */
    public function multiUpload(array $uploadedFiles, string $path = '/'): array;
}
