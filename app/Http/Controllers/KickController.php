<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\USERINFO;
use App\Model\KICK;
use Carbon\Carbon;
use App\Model\HISTORY;

class KickController extends Controller
{
	const RESULT_SUCCESS=777;
	const RESULT_REJECT=804;
	const RESULT_ERR=404;

    # all kick board
    public function allkick()
    {

	    $kicks = KICK::get();
	    if($kicks->isEmpty()){
		    return array(
			    "result"=>self::RESULT_ERR
		    );
	    }
	    return array(
		    "result"=>self::RESULT_SUCCESS,
		    "data"=>$kicks
	    );
    }

    # borrow kick
    public function borrow($kickid, $userid){
	    $user = USERINFO::find($userid);
	    $kick = KICK::find($kickid);

	    # not exist kick
	    if(empty($kick)){
		    return array(
			    "result"=>self::RESULT_ERR,
			    "battery"=>0,
			    "time"=>""
		    );
	    }

	    # already borrow
	    if($kick->status == 1){
		    return array(
			    "result"=>self::RESULT_REJECT,
			    "battery"=>0,
			    "time"=>""
		    );
	    }

	    # success
	    $kick->status = 1;
	    $user->kickid = $kickid;
	    $now = Carbon::now();
	    $user->time = $now;


	    $user->save();
	    $kick->save();

	    return array(
		    "result"=>self::RESULT_SUCCESS,
		    "battery"=>$kick->battery,
		    "time"=>$now->format('Y-m-d H:i:s')
	    );

    }

    #lend kick
    public function lend($userid){
	    $user = USERINFO::find($userid);
	    $kickid = $user->kickid;

	    $kick = KICK::find($kickid);
	    if(empty($kick)){
                    return array(
                            "result"=>self::RESULT_ERR
                    );
            }
	    
	    $user->kickid = -1;
	    $user->save();

	    $kick->status = 0;
	    $kick->save();
	    
	    #history save
	    $history = new HISTORY;
	    $history->start = $user->time;
	    $history->end = Carbon::now();
	    $history->kickid = $kickid;
	    $history->userid = $userid;
	    $history->save();

	    return array(
		    "result"=>self::RESULT_SUCCESS
	    );
   
    }

    # set kick status
    public function setStatus($kickid){
	    $kick = KICK::find($kickid);

	    if(empty($kick)){
		    return array(
			    "result"=>self::RESULT_ERR
		    );
	    }

	    if($kick->status == 1){
	   	 $kick->status = 0;
	    }else{
		    $kick->status = 1;
	    }
	    $kick->save();

	    return array(
		    "result"=>self::RESULT_SUCCESS
	    );
    }

    # get kick battery
    public function getBattery($kickid){
	    $kick = KICK::find($kickid);

	    if(empty($kick)){
		    return array(
			    "result"=>self::RESULT_ERR,
			    "battery"=>0
		    );
	    }

	    return array(
		    "result"=>self::RESULT_SUCCESS,
		    "battery"=>$kick->battery
	    );
    }

    # set kick battery
    public function setBattery($kickid, $battery){
	    $kick = KICK::find($kickid);

	    if(empty($kick)){
		    return array(
			    "result"=>self::RESULT_ERR,
		    );
	    }

	    $kick->battery = $battery;
	    $kick->save();

	    return array(
		    "result"=>self::RESULT_SUCCESS
	    );
    }

    # get kick lock status
    public function getStatus($kickid) {

	    $kick = KICK::find($kickid);

            if(empty($kick)){
                    return array(
			    "result"=>self::RESULT_ERR,
			    "status"=>self::RESULT_ERR
                    );
	    }

	    return array(
		    "result"=>self::RESULT_SUCCESS,
		    "status"=>$kick->status
	    );
    }

    # set kick gps
    public function setGps($kickid, $lat, $lng){

	    $kick = KICK::find($kickid);

	    $kick->latitude = $lat;
	    $kick->longitude = $lng;
	    $kick->save();

	    return array(
		    "result"=>self::RESULT_SUCCESS
	    );
    }

    #get kick gps
    public function getGps(){

	    $kick = KICK::get();

	    if($kick->isEmpty()){
		    return array(
			    "result"=>self::RESULT_ERR,
			    "id"=>"",
			    "lat"=>"",
			    "lng"=>"",
			    "battery"=>""
		    );
	    }
	
	    $count = count($kick);
	    $i = 0;
	    $arr = [];
	    while($count > $i){
		    $kickid = $kick[$i]->kickid;
		    $lat = $kick[$i]->latitude;
		    $lng = $kick[$i]->longitude;
		    $battery = $kick[$i]->battery;
		    
		    $a = array(
			    "kickid"=>$kickid,
			    "lat"=>$lat,
			    "lng"=>$lng,
			    "battery"=>$battery
		    );

		    array_push($arr, $a);
		    $i++;
	    }

	    return array(
		    "result"=>self::RESULT_SUCCESS,
		    "data"=>$arr
	    );
    }
}

