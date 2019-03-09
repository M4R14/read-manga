<?php

namespace App\Models\Manga;

use Illuminate\Database\Eloquent\Model;

class Chater extends Model
{
    protected $table = 'manga_chaters';

    public function addImage(int $number, Image $image)
    {
        $newChaterImage = new Chater\Image;
        $newChaterImage->chater_id      = $this->id;
        $newChaterImage->image_id       = $image->id;
        $newChaterImage->page_number    = $number;
        $newChaterImage->save();

        return $newChaterImage;
    }

    public function images()
    {
        return $this->hasMany(Chater\Image::class, 'chater_id', 'id');
    }
}
