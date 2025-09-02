<?php

namespace Modules\Shared\Http\Service;

use App\Constant\Constant;
use Illuminate\Http\UploadedFile;
use Modules\Shared\Contract\FileServiceInterface;

class FileService implements FileServiceInterface
{
    public function __construct(protected FileUploadStrategyResolver $fileUploadStrategyResolver) {}

    public function singleUpload(UploadedFile $uploadedFile, string $path = '/'): string
    {
        /**
         * @todo Change uploadType Parameter to fetch upload option from database
         */
        $fileUploadStrategy = $this->fileUploadStrategyResolver->resolve(Constant::publicUpload);

        $url = $fileUploadStrategy->upload($uploadedFile, $path);

        return $url;
    }

    /**
     * @param UploadedFile[] $uploadedFiles
     * @param string $path
     * @return string[]  List of uploaded file URLs
     */
    public function multiUpload(array $uploadedFiles, string $path = '/'): array
    {
        /**
         * @todo Change uploadType Parameter to fetch upload option from database
         */
        $fileUploadStrategy = $this->fileUploadStrategyResolver->resolve(Constant::publicUpload);

        $urls = [];

        foreach ($uploadedFiles as $uploadedFile) {
            if ($uploadedFile instanceof UploadedFile) {
                $urls[] = $fileUploadStrategy->upload($uploadedFile, $path);
            }
        }

        return $urls;
    }
}
