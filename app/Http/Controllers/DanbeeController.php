<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\USERINFO;
class DanbeeController extends Controller
{
	const RESULT_SUCCESS=777;
	const RESULT_ERR=404;

	# User search
	public function search($userid)
	{
		$db = USERINFO::where('userid', $userid)->get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"message"=>"not exist user ID"
			);
		}
		return array(
			"result"=>self::RESULT_SUCCESS,
			"userid"=>$db[0]->userid,
			"phone"=>$db[0]->phone,
			"time"=>$db[0]->time,
			"kickid"=>$db[0]->kickid,
			"name"=>$db[0]->name,
			"gender"=>$db[0]->gender
		);
	}

	# Sign Up
	public function signup($userid, $pw, $phone, $name, $gender)
	{
		$db = USERINFO::where('userid', $userid)->get();
		if($db->isEmpty()){
			$user = new USERINFO;
			$user->userid = $userid;
			$user->pw = $pw;
			$user->phone = $phone;
			$user->name = $name;
			$user->gender = $gender;
			$user->save();

			return array(
				"result"=>self::RESULT_SUCCESS,
				"message"=>"new user"
			);
		}
		return array(
			"result"=>self::RESULT_ERR,
			"message"=>"exist user ID"
		);
	}

	# Modify User Info
	public function borrow($userid, $kickid)
	{
		$user = USERINFO::find($userid);
		$user->kickid = $kickid;
		$user->save();
		return array(
			"kickid"=>$kickid
		);
	}
}
