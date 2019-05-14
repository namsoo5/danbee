<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HISTORY;

class HistoryController extends Controller
{
	const RESULT_SUCCESS = 777;
	const RESULT_ERR = 404;

	# all history
	public function allHistory(){
		$db = HISTORY::get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>""
			);
		}
		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);
	}

	# user history
	public function userHistory($userid){
		$db = HISTORY::where('userid', $userid)->get(); 
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}

		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);
	}
}
