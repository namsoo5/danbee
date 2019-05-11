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
		    );
	    }

	    # already borrow
	    if($kick->status == 1){
		    return array(
			    "result"=>self::RESULT_REJECT,
		    );
	    }

	    # success
	    $kick->status = 1;
	    $user->kickid = $kickid;
	    $user->time = Carbon::now();
	    $user->save();
	    $kick->save();

	    return array(
		    "result"=>self::RESULT_SUCCESS
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
	    
	    $user->kickid = 0;
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

}
