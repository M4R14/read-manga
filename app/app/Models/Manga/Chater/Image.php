<?php

namespace App\Models\Manga\Chater;

use Illuminate\Database\Eloquent\Model;
use App\Models\Manga\Image as MainImage;

class Image extends Model
{
    protected $table = 'manga_chater_images';

    public function image()
    {
        return $this->hasOne(MainImage::class, 'id', 'image_id');
    }
}
