<?php

namespace Modules\Shared\Http\Service;

use App\Constant\Constant;
use InvalidArgumentException;
use Modules\Shared\Contract\FileUploadStrategyInterface;
use Modules\Shared\Http\Service\Strategy\PublicFileUploadStrategy;

class FileUploadStrategyResolver
{
    public function resolve(string $uploadType): FileUploadStrategyInterface
    {
        return match ($uploadType) {
            Constant::publicUpload => app(PublicFileUploadStrategy::class),
            default => throw new InvalidArgumentException("Unsupported File Upload Type: {$uploadType}"),
        };
    }
}
