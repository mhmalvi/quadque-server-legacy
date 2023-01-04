<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class ClientSpeak extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function services(){
        return $this->belongsTo(Service::class);
    }
}
