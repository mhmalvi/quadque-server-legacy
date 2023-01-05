<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class CaseStudy extends Model
{
    use HasFactory;

    // protected $fillable = ['com_name', 'com_image'];
    protected $guarded=[];

    public function services(){
        return $this->belongsTo(Service::class);
    }
}
