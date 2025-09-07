<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreImage extends Model
{
    public const table = 'core_images';

    public const id = 'id';

    public const imagePath = 'image_path';

    protected $fillable = [
        'image_path'
    ];

    public function imagable()
    {
        return $this->morphTo();
    }
}
