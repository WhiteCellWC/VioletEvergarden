<?php

namespace Modules\Shared\Http\Service;

use App\Constant\Constant;
use Exception;
use Illuminate\Http\UploadedFile;
use Modules\Shared\Contract\FileServiceInterface;
use Throwable;

class FileService implements FileServiceInterface
{
    public function __construct(protected FileUploadStrategyResolver $fileUploadStrategyResolver) {}

    public function upload(UploadedFile $uploadedFile, string $path = '/'): string
    {
        try {
            /**
             * @todo Change uploadType Parameter to fetch upload option from database
             */
            $fileUploadStrategy = $this->fileUploadStrategyResolver->resolve(Constant::publicUpload);

            $url = $fileUploadStrategy->upload($uploadedFile, $path);

            return $url;
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function delete(string $path): bool
    {
        try {
            /**
             * @todo Change uploadType Parameter to fetch upload option from database
             */
            $fileUploadStrategy = $this->fileUploadStrategyResolver->resolve(Constant::publicUpload);

            return $fileUploadStrategy->delete($path);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
