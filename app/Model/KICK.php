<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KICK extends Model
{
    protected $table = 'kicks';
    public $timestamps = false;
    protected $primaryKey = 'kickid';
    public $incrementing = false;  #primaryKey return 0 제거
    protected $fillable = ['kickid', 'battery', 'latitude', 'longitude', 'status'];
}
