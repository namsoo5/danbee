<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class USERINFO extends Model
{
	protected $table = 'userinfos';
	public $timestamps = false;
	protected $primaryKey = 'userid';
	protected $fillable = ['userid', 'pw', 'phone', 'kickid', 'name', 'gender'];

}
