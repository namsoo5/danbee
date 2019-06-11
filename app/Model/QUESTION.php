<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QUESTION extends Model
{
	protected $table = 'questions';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $fillable = ['id', 'title', 'userid', 'time', 'content'];
}
