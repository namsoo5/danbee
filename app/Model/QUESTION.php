<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QUESTION extends Model
{
	protected $table = 'questions';
	public $timestamps = false;
	protected $fillable = ['question_id', 'userid', 'time', 'content'];
}
