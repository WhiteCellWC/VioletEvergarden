<?php

namespace Modules\Shared\Http\Service;

use App\Models\CoreImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Contract\CoreImageServiceInterface;
use Modules\Shared\Contract\FileServiceInterface;
use Throwable;

class CoreImageService implements CoreImageServiceInterface
{
    public function __construct(protected FileServiceInterface $fileService) {}

    public function get(string $id)
    {
        return CoreImage::findOrFail($id);
    }

    /**
     * @param Model  $model
     * @param UploadedFile[]|UploadedFile $images
     */
    public function attachImages(Model $model, UploadedFile|array $images, ?string $path = '/'): void
    {
        try {
            $records = [];

            foreach ((array) $images as $image) {
                $records[] = [CoreImage::imagePath => $this->fileService->upload($image, $path)];
            }

            if ($records) {
                $model->images()->createMany($records);
            }
        } catch (Throwable $e) {
            throw $e;
        }
    }

    /**
     * @param Model  $model
     */
    public function detachImages(Model $model): void
    {
        try {
            if (!isset($model->images)) {
                $model->load('images');
            }

            foreach ($model->images as $image) {
                $this->fileService->delete($image->{CoreImage::imagePath});
            }

            $model->images()->delete();
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function delete(string|array $ids): void
    {
        $ids = is_array($ids) ? $ids : [$ids];

        DB::transaction(function () use ($ids) {
            foreach ($ids as $id) {
                $image = $this->get($id);

                $this->fileService->delete($image->{CoreImage::imagePath});
                $image->delete();
            }
        });
    }
}
