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
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}
		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);

	}

	# insert notice
	public function insertnotice($title, $content)
	{
		$data = new NOTICE;
		$data->title = $title;
		$data->content = $content;
		$data->save();

		return array(
			"result"=>self::RESULT_SUCCESS
		);
	}

	#insert notice post
	public function insertNoticePost(){

		$data = new NOTICE;
		$title = request('title', null);
		$content = request('content', null);

		$data->title = $title;
		$data->content = $content;
		$data->save();

		return array(
			"result"=>self::RESULT_SUCCESS
		);
	}

	#delete notice
	public function deleteNoticePost(){
		$id = request('id', null);

		$data = NOTICE::find($id);
		$data->delete();

		return array(
			"result"=>self::RESULT_SUCCESS
		);
	}
}
