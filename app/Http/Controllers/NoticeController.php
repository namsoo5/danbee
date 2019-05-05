<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\NOTICE;

class NoticeController extends Controller
{
	const RESULT_SUCCESS=777;
	const RESULT_ERR=404;

	# all notice
	public function allnotice()
	{
		$db = NOTICE::get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR
			);
		}
		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);

	}
}
