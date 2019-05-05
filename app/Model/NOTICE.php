<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
	protected $table = 'notices';
	public $timestamps = false;
	protected $primarhKey = 'id';
	protected $fillable = ['id', 'time', 'title', 'content'];
}
