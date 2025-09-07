<?php

namespace Modules\Shared\Contract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface CoreImageServiceInterface
{
    public function get(string $id);

    /**
     * @param Model  $model
     * @param UploadedFile[]|UploadedFile $images
     */
    public function attachImages(Model $model, UploadedFile|array $images, ?string $path = '/'): void;


    /**
     * @param Model  $model
     */
    public function detachImages(Model $model): void;

    public function delete(string|array $ids): void;
}
