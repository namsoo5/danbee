<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\USERINFO;
use App\Model\KICK;

class KickController extends Controller
{
    const RESULT_SUCCESS=777;
    const RESULT_ERR=404;

    # all kick board
    public function allkick()
    {

	    $kicks = KICK::get();
	    return $kicks;
	    
    }
}
