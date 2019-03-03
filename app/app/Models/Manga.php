<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $table = 'mangas';

     /**
     * Get all of the video's comments.
     */
    public function chaters()
    {
        return $this->hasMany(Manga\Chater::class, 'manga_id');
    }
     /**
     * Get all of the video's comments.
     */
    public function image()
    {
        return $this->hasOne(Manga\Image::class, 'id', 'image_cover');
    }
}
