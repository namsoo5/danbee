<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\USERINFO;
class DanbeeController extends Controller
{
	const RESULT_SUCCESS=777;
	const RESULT_ERR=404;

	# User search and overlap id check
	public function search($userid)
	{
		$db = USERINFO::where('userid', $userid)->get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
			);
		}
		return array(
			"result"=>self::RESULT_SUCCESS,
		);
	}

	# Sign Up
	public function signup($userid, $pw, $phone, $name, $gender, $birth)
	{
		$db = USERINFO::where('userid', $userid)->get();
		if($db->isEmpty()){
			$user = new USERINFO;
			$user->userid = $userid;
			$user->pw = $pw;
			$user->phone = $phone;
			$user->name = $name;
			$user->gender = $gender;
			$user->birth = $birth;
			$user->save();

			return array(
				"result"=>self::RESULT_SUCCESS,
			);
		}
		return array(
			"result"=>self::RESULT_ERR,
		);
	}

	# Modify User Info
	public function borrow($userid, $kickid)
	{
		$user = USERINFO::find($userid);
		#find 는 empty()로 확인
		if(empty($user)){
			return array(
				"result"=>self::RESULT_ERR,
				"kickid"=>""
			);
		}
		$user->kickid = $kickid;
		$user->save();
		return array(
			"result"=>self::RESULT_SUCCESS,
			"kickid"=>$kickid
		);
	}

	# Login
	public function login($userid, $pw)
	{
		$db = USERINFO::where('userid', $userid)->get();
		# no exist id
		if($db->isEmpty){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}

		# success
		if($db[0]->pw == $pw){
			return array(
				"result"=>self::RESULT_SUCCESS,
				"data"=>array(
				"userid"=>$userid,
				"phone"=>$db[0]->phone,
				"time"=>$db[0]->time,
				"kickid"=>$db[0]->kickid,
				"name"=>$db[0]->name,
				"gender"=>$db[0]->gender,
				"birth"=>$db[0]->birth
			)
		);
		}
		return array(
			"result"=>self::RESULT_ERR,
		);
	}

	# All User
	public function alluser(){

		$users = USERINFO::get();
		if($users->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR
			);
		}
		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$users
		); 
	}


}
