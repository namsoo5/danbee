<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ANSWER extends Model
{
	protected $table = 'answers';
	public $timestamps = false;
	protected $fillable = ['question_id', 'userid', 'time', 'content'];
}
