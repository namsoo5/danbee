<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class USERINFO extends Model
{
	protected $table = 'userinfos';
	public $timestamps = false;
	protected $primaryKey = 'userid';
	public $incrementing = false;  #primaryKey return 0 제거 
	protected $fillable = ['userid', 'pw', 'phone', 'kickid', 'name', 'gender', 'birth'];

}
