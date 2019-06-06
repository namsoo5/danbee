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

	# Login
	public function login($userid, $pw)
	{
		$db = USERINFO::where('userid', $userid)->get();
		# no exist id
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}

		# success
		if($db[0]->pw == $pw){
			return array(
				"result"=>self::RESULT_SUCCESS,
				"data"=>array(array(
					"userid"=>$userid,
					"phone"=>$db[0]->phone,
					"name"=>$db[0]->name,
					"gender"=>$db[0]->gender,
					"birth"=>$db[0]->birth
				))
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

	# find id
	public function getId($name, $phone){
		$user = USERINFO::where('name', $name)
			->where('phone', $phone)
			->get();

		if($user->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>""
			);
		}

		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$user[0]->userid
		);
	}

	# find pw
	public function getPw($userid, $name, $phone, $birth){
		$user = USERINFO::find($userid);
		if(empty($user)){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>""
			);
		}

		if($user->name === $name && $user->phone === $phone && $user->birth === $birth){
			return array(
				"result"=>self::RESULT_SUCCESS,
				"data"=>"success"
			);
		}
		return array(
			"result"=>self::RESULT_ERR,
			"data"=>""
		);
	}

	# change pw
	public function changePw($userid, $pw){
		$user = USERINFO::find($userid);
		
		$user->pw = $pw;
		$user->save();
		return array(
			"result"=>self::RESULT_SUCCESS
		);	
	}

	# sns signup
	public function snsSignup($userid, $name, $gender, $birth){
		$db = USERINFO::find($userid);
		if(empty($db)){
			$user = new USERINFO;
			$user->userid = $userid;
			$user->name = $name;
			$user->gender = $gender;
			$user->birth = $birth;
			$user->save();

			return array(
				"result"=>self::RESULT_SUCCESS
			);

		}
		return array(
			"result"=>self::RESULT_ERR
		);
	}
	
	# user delete
	public function userDelete($userid){

		$user = USERINFO::find($userid);

		if(empty($user)){
			return array(
				"result"=>self::RESULT_ERR
			);
		}

		$user->delete();
		return array(
			"result"=>self::RESULT_SUCCESS
		);
	}

}
