<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HISTORY extends Model
{
	protected $table = 'historys';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['id', 'start', 'end', 'kickid', 'userid'];

}
