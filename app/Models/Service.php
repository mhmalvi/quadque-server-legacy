<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientSpeak;
use App\Models\CaseStudy;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function clientspeaks(){
        return $this->hasMany(ClientSpeak::class);
    }

    public function casestudies(){
        return $this->hasMany(CaseStudy::class);
    }
}
