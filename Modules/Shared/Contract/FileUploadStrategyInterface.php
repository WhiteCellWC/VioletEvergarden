<?php

namespace Modules\Shared\Contract;

use Illuminate\Http\UploadedFile;

interface FileUploadStrategyInterface
{
    public function upload(UploadedFile $file, string $path = '/');
}
