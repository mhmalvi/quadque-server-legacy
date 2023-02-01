<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GalleryImages;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function galleryImages(){
        return $this->hasMany(GalleryImages::class);
    }
}
